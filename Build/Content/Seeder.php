<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Builds a bilingual page tree through DataHandler in three passes:
 *  1. pages, content, inline children and file references, default language
 *  2. every value that names another record by uid (links, menu pages, records)
 *  3. connected translations (localize) and the German field values
 */
final class Seeder
{
    private array $pages = [];      // key => ['new' => NEWid, 'parent' => key|null, 'en' => [], 'de' => []]
    private array $elements = [];   // key => ['new' => NEWid, 'page' => key, 'en' => [], 'de' => [], 'children' => [...]]
    private array $categories = []; // key => ['new' => NEWid, 'en' => [], 'de' => []]
    private array $fileUids = [];
    private array $ids = [];        // key => real uid (pages, elements, categories)
    private array $childIds = [];   // elementKey => [index => real uid]
    private array $deferred = [];   // [table, keyOrNew, field, closure]
    private array $fileRefs = [];   // [NEWid => spec]
    private const TEXT_FIELDS = ['header', 'subheader', 'bodytext', 'teaser', 'quote_source', 'readmore_label', 'external_media_title', 'button_text', 'nav_title', 'link_title', 'header_link', 'table_caption'];
    private $storage;

    public function __construct()
    {
        $this->storage = GeneralUtility::makeInstance(StorageRepository::class)->findByUid(1);
    }

    public function page(string $key, ?string $parent, array $en, array $de, array $extra = []): void
    {
        $this->pages[$key] = ['new' => StringUtility::getUniqueId('NEW'), 'parent' => $parent, 'en' => $en + $extra, 'de' => $de];
    }

    public function category(string $key, array $en, array $de): void
    {
        $this->categories[$key] = ['new' => StringUtility::getUniqueId('NEW'), 'en' => $en, 'de' => $de];
    }

    /**
     * @param array $children each ['en' => [], 'de' => [], 'files' => [field => [fileSpec, ...]]]
     * @param array $files    field => [fileSpec, ...]; fileSpec = ['file' => 'path/in/images', 'alt' => '', 'title' => '', 'crop' => '']
     */
    public function el(string $key, string $page, int $colPos, string $ctype, array $en, array $de = [], array $children = [], array $files = []): void
    {
        $this->elements[$key] = [
            'new' => StringUtility::getUniqueId('NEW'),
            'page' => $page,
            'en' => ['CType' => $ctype, 'colPos' => $colPos] + $en,
            'de' => $de,
            'children' => $children,
            'files' => $files,
        ];
    }

    /** A value that needs real uids: resolved in pass 2 with fn(array $ids, array $childIds) */
    public function later(\Closure $fn): \Closure
    {
        return $fn;
    }

    public function fileUid(string $path): int
    {
        if (!isset($this->fileUids[$path])) {
            $this->fileUids[$path] = $this->storage->getFile('/bootstrap_package/' . $path)->getUid();
        }
        return $this->fileUids[$path];
    }

    public function run(): void
    {
        $this->pass1();
        $this->pass2();
        $this->pass3();
    }

    public function id(string $key): int
    {
        return $this->ids[$key];
    }

    public function ids(): array
    {
        return $this->ids;
    }

    /** key => ['en' => fields, 'de' => fields] of every page defined so far */
    public function pages(): array
    {
        return array_map(fn ($p) => ['en' => $p['en'], 'de' => $p['de']], $this->pages);
    }

    private function dh(array $data, array $cmd = []): DataHandler
    {
        $dh = GeneralUtility::makeInstance(DataHandler::class);
        $dh->start($data, $cmd);
        if ($data !== []) {
            $dh->process_datamap();
        }
        if ($cmd !== []) {
            $dh->process_cmdmap();
        }
        if ($dh->errorLog !== []) {
            fwrite(STDERR, "DataHandler errors:\n" . implode("\n", $dh->errorLog) . "\n");
            exit(1);
        }
        return $dh;
    }

    private function childTable(string $ctype): string
    {
        return match ($ctype) {
            'accordion' => 'tx_bootstrappackage_accordion_item',
            'card_group' => 'tx_bootstrappackage_card_group_item',
            'carousel', 'carousel_small', 'carousel_fullscreen' => 'tx_bootstrappackage_carousel_item',
            'icon_group' => 'tx_bootstrappackage_icon_group_item',
            'tab' => 'tx_bootstrappackage_tab_item',
            'timeline' => 'tx_bootstrappackage_timeline_item',
        };
    }

    /** Splits closures out of a field array and registers them for pass 2 */
    private function stripDeferred(string $table, string $newId, array $fields): array
    {
        foreach ($fields as $field => $value) {
            if ($value instanceof \Closure) {
                // "field@later" carries a second, deferred value for a field that also has a pass-1 value
                $this->deferred[] = [$table, $newId, str_replace('@later', '', $field), $value];
                unset($fields[$field]);
            }
        }
        return $fields;
    }

    private function fileRows(array &$data, string $pagePid, array $files): array
    {
        $fieldValues = [];
        foreach ($files as $field => $specs) {
            $refs = [];
            foreach ($specs as $spec) {
                $refId = StringUtility::getUniqueId('NEW');
                $row = ['pid' => $pagePid, 'uid_local' => $this->fileUid($spec['file'])];
                foreach (['alternative', 'title', 'description', 'crop', 'link'] as $f) {
                    if (isset($spec[$f])) {
                        $row[$f] = $spec[$f];
                    }
                }
                $data['sys_file_reference'][$refId] = $row;
                $this->fileRefs[$refId] = $spec;
                $refs[] = $refId;
            }
            $fieldValues[$field] = implode(',', $refs);
        }
        return $fieldValues;
    }

    private function pass1(): void
    {
        $data = [];
        foreach ($this->pages as $key => $p) {
            $pid = $p['parent'] === null ? 0 : $this->pages[$p['parent']]['new'];
            $fields = $this->stripDeferred('pages', $p['new'], $p['en']) + ['pid' => $pid, 'hidden' => 0, 'doktype' => 1];
            unset($fields['_hero'], $fields['_hero_color'], $fields['_hero_position']);
            if (isset($fields['files'])) {
                $fields += $this->fileRows($data, $p['new'], $fields['files']);
                unset($fields['files']);
            }
            $data['pages'][$p['new']] = $fields;
        }
        foreach ($this->categories as $key => $c) {
            $data['sys_category'][$c['new']] = ['pid' => $this->pages['root']['new']] + $c['en'];
        }
        foreach ($this->elements as $key => $e) {
            $pagePid = $this->pages[$e['page']]['new'];
            $fields = ['pid' => $pagePid] + $this->stripDeferred('tt_content', $e['new'], $e['en']);
            $fields += $this->fileRows($data, $pagePid, $e['files']);
            if ($e['children'] !== []) {
                $table = $this->childTable($e['en']['CType']);
                $childIds = [];
                foreach ($e['children'] as $i => $child) {
                    $childId = StringUtility::getUniqueId('NEW');
                    $childFields = ['pid' => $pagePid] + $this->stripDeferred($table, $childId, $child['en']);
                    $childFields += $this->fileRows($data, $pagePid, $child['files'] ?? []);
                    $data[$table][$childId] = $childFields;
                    $childIds[] = $childId;
                    $this->elements[$key]['children'][$i]['new'] = $childId;
                }
                $fields[$table] = implode(',', $childIds);
            }
            $data['tt_content'][$e['new']] = $fields;
        }
        $dh = $this->dh($data);
        foreach ($this->pages as $key => $p) {
            $this->ids[$key] = (int)$dh->substNEWwithIDs[$p['new']];
        }
        foreach ($this->categories as $key => $c) {
            $this->ids[$key] = (int)$dh->substNEWwithIDs[$c['new']];
        }
        foreach ($this->elements as $key => $e) {
            $this->ids[$key] = (int)$dh->substNEWwithIDs[$e['new']];
            foreach ($e['children'] as $i => $child) {
                $this->childIds[$key][$i] = (int)$dh->substNEWwithIDs[$child['new']];
            }
        }
        $this->newToId = $dh->substNEWwithIDs;
        $this->restoreOrder();
        printf("pass 1: %d pages, %d elements\n", count($this->pages), count($this->elements));
    }

    private array $newToId = [];

    /** DataHandler inserts every new record at the top of its page; definition order is the intended order */
    private function restoreOrder(): void
    {
        $pool = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class);
        $position = [];
        foreach ($this->pages as $key => $p) {
            $group = 'pages:' . ($p['parent'] ?? '');
            $position[$group] = ($position[$group] ?? 0) + 1;
            $pool->getConnectionForTable('pages')->update('pages', ['sorting' => $position[$group] * 256], ['uid' => $this->ids[$key]]);
        }
        foreach ($this->elements as $key => $e) {
            $group = 'tt_content:' . $e['page'] . ':' . $e['en']['colPos'];
            $position[$group] = ($position[$group] ?? 0) + 1;
            $pool->getConnectionForTable('tt_content')->update('tt_content', ['sorting' => $position[$group] * 256], ['uid' => $this->ids[$key]]);
        }
    }

    private function translatedReference(int $enUid): ?int
    {
        $uid = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
            ->getConnectionForTable('sys_file_reference')
            ->select(['uid'], 'sys_file_reference', ['l10n_parent' => $enUid, 'sys_language_uid' => 1])
            ->fetchOne();
        return $uid === false ? null : (int)$uid;
    }

    /** German values may name records too; by pass 3 every uid is known */
    private function resolveNow(array $fields): array
    {
        foreach ($fields as $field => $value) {
            if ($value instanceof \Closure) {
                $fields[$field] = $value($this->ids, $this->childIds);
            }
        }
        return $fields;
    }

    private function pass2(): void
    {
        if ($this->deferred === []) {
            return;
        }
        $data = [];
        foreach ($this->deferred as [$table, $newId, $field, $fn]) {
            $uid = $this->newToId[$newId];
            $data[$table][$uid][$field] = $fn($this->ids, $this->childIds);
        }
        $this->dh($data);
        printf("pass 2: %d deferred values\n", count($this->deferred));
    }

    private function pass3(): void
    {
        // Pages first: a content element can only be localized below a translated page
        $cmd = [];
        foreach ($this->pages as $key => $p) {
            $cmd['pages'][$this->ids[$key]]['localize'] = 1;
        }
        $pageDh = $dh = $this->dh([], $cmd);
        $data = [];
        foreach ($this->pages as $key => $p) {
            $deUid = $dh->copyMappingArray_merged['pages'][$this->ids[$key]];
            $this->ids[$key . ':de'] = (int)$deUid;
            $data['pages'][$deUid] = ['slug' => '', 'hidden' => 0] + $this->resolveNow($p['de']) + array_intersect_key($p['en'], array_flip(['subtitle', 'nav_title', 'abstract', 'description', 'keywords']));
        }
        $this->dh($data);

        $cmd = [];
        foreach ($this->elements as $key => $e) {
            $cmd['tt_content'][$this->ids[$key]]['localize'] = 1;
        }
        foreach ($this->categories as $key => $c) {
            $cmd['sys_category'][$this->ids[$key]]['localize'] = 1;
        }
        $dh = $this->dh([], $cmd);
        $data = [];
        foreach ($this->categories as $key => $c) {
            $data['sys_category'][$dh->copyMappingArray_merged['sys_category'][$this->ids[$key]]] = ['hidden' => 0] + $c['de'];
        }
        foreach ($this->elements as $key => $e) {
            $deUid = $dh->copyMappingArray_merged['tt_content'][$this->ids[$key]];
            $this->ids[$key . ':de'] = (int)$deUid;
            $data['tt_content'][$deUid] = ['hidden' => 0] + $this->resolveNow($e['de']) + $this->resolveNow(array_intersect_key($e['en'], array_flip(self::TEXT_FIELDS)));
            if ($e['children'] !== []) {
                $table = $this->childTable($e['en']['CType']);
                foreach ($e['children'] as $i => $child) {
                    $childDe = $dh->copyMappingArray_merged[$table][$this->childIds[$key][$i]] ?? null;
                    if ($childDe === null) {
                        fwrite(STDERR, "no translation for child $i of $key\n");
                        continue;
                    }
                    $data[$table][$childDe] = ['hidden' => 0] + $this->resolveNow($child['de'] ?? []) + $this->resolveNow(array_intersect_key($child['en'], array_flip(self::TEXT_FIELDS)));
                }
            }
        }
        foreach ($this->fileRefs as $newId => $spec) {
            $enUid = $this->newToId[$newId] ?? null;
            $deUid = $this->translatedReference((int)$enUid);
            if ($deUid === null) {
                continue;
            }
            $row = [];
            foreach (['alternative', 'title', 'description'] as $f) {
                if (isset($spec[$f])) {
                    $row[$f] = $spec[$f . '_de'] ?? $spec[$f];
                }
            }
            if ($row !== []) {
                $data['sys_file_reference'][$deUid] = $row;
            }
        }
        $this->dh($data);
        printf("pass 3: translated %d pages, %d elements\n", count($this->pages), count($this->elements));
    }
}
