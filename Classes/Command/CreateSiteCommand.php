<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Command;

use BK2K\BootstrapPackage\SiteCreator\Service\SiteCreatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Core\Bootstrap;

class CreateSiteCommand extends Command
{
    protected SiteCreatorService $siteCreatorService;

    public function __construct(
        SiteCreatorService $siteCreatorService,
        string $name = null
    ) {
        $this->siteCreatorService = $siteCreatorService;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Bootstrap::initializeBackendAuthentication();
        Bootstrap::initializeLanguageObject();

        $this->siteCreatorService->createSiteSetup();

        return 0;
    }
}
