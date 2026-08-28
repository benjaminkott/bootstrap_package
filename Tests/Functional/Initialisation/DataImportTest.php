<?php

declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Tests\Functional\Initialisation;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Yaml\Yaml;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Impexp\Import;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Testcase for the shipped demo content
 *
 * The artifact is imported once per installation and the registry remembers
 * it, so the installation it was exported from cannot show whether it still
 * imports. This test is the cheap form of that proof.
 *
 * @see Initialisation/data.xml
 */
final class DataImportTest extends FunctionalTestCase
{
    protected array $coreExtensionsToLoad = [
        'seo',
        'rte_ckeditor',
        'extensionmanager',
        'install',
        'impexp',
        'filemetadata',
    ];

    protected array $testExtensionsToLoad = [
        'typo3conf/ext/bootstrap_package',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->importCSVDataSet(__DIR__ . '/Fixtures/be_users.csv');
        $backendUser = $this->setUpBackendUser(1);
        $GLOBALS['LANG'] = $this->get(LanguageServiceFactory::class)->createFromUserPreferences($backendUser);
    }

    #[Test]
    public function artifactImportsCompletely(): void
    {
        $artifact = 'EXT:bootstrap_package/Initialisation/data.xml';
        $subject = $this->get(Import::class);
        $subject->setPid(0);
        $subject->loadFile($artifact);
        $subject->importData();

        // Every table the artifact carries arrives with the same number of rows
        $document = simplexml_load_file($this->instancePath . '/typo3conf/ext/bootstrap_package/Initialisation/data.xml');
        self::assertNotFalse($document);
        $expected = [];
        foreach ($document->header->records->table as $table) {
            $expected[(string)$table['index']] = count($table->rec);
        }
        self::assertNotEmpty($expected);
        foreach ($expected as $tableName => $count) {
            self::assertSame(
                $count,
                $this->countRows($tableName),
                sprintf('%s: %d rows expected', $tableName, $count)
            );
        }

        // One site root, and no page fell back to the root level (the root's own translation belongs there)
        $rootPages = $this->getConnectionPool()->getConnectionForTable('pages')
            ->select(['uid', 'is_siteroot'], 'pages', ['pid' => 0, 'deleted' => 0, 'sys_language_uid' => 0])
            ->fetchAllAssociative();
        self::assertCount(1, $rootPages);
        self::assertSame(1, (int)$rootPages[0]['is_siteroot']);

        // The site configuration names the root page the artifact holds
        $siteConfiguration = Yaml::parseFile(
            $this->instancePath . '/typo3conf/ext/bootstrap_package/Initialisation/Site/bootstrap-package/config.yaml'
        );
        $importedRootPageId = $subject->getImportMapId()['pages'][$siteConfiguration['rootPageId']] ?? null;
        self::assertSame((int)$rootPages[0]['uid'], $importedRootPageId);

        // A translated page sits below its parent, not on the root level
        $translations = $this->getConnectionPool()->getConnectionForTable('pages')
            ->select(['uid', 'pid', 'l10n_parent'], 'pages', ['deleted' => 0])
            ->fetchAllAssociative();
        $pidByUid = array_column($translations, 'pid', 'uid');
        foreach ($translations as $page) {
            if ((int)$page['l10n_parent'] > 0) {
                self::assertSame(
                    $pidByUid[$page['l10n_parent']],
                    $page['pid'],
                    sprintf('translated page %d is not below the page of its parent', $page['uid'])
                );
            }
        }

        // Every file arrived as a file, not only as a row
        $files = $this->getConnectionPool()->getConnectionForTable('sys_file')
            ->select(['identifier'], 'sys_file')
            ->fetchFirstColumn();
        self::assertCount($expected['sys_file'], $files);
        foreach ($files as $identifier) {
            self::assertFileExists($this->instancePath . '/fileadmin' . $identifier);
        }
    }

    private function countRows(string $table): int
    {
        $queryBuilder = $this->getConnectionPool()->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        return (int)$queryBuilder->count('*')->from($table)->executeQuery()->fetchOne();
    }
}
