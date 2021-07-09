<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Controller;

use BK2K\BootstrapPackage\SiteCreator\Service\SiteCreatorService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BackendController extends ActionController
{
    protected ?ModuleTemplate $moduleTemplate = null;
    protected ModuleTemplateFactory $moduleTemplateFactory;
    protected SiteCreatorService $siteCreatorService;

    public function __construct(
        ModuleTemplateFactory $moduleTemplateFactory,
        SiteCreatorService $siteCreatorService
    ) {
        $this->moduleTemplateFactory = $moduleTemplateFactory;
        $this->siteCreatorService = $siteCreatorService;
    }

    public function initializeAction(): void
    {
        $this->moduleTemplate = $this->moduleTemplateFactory->create($this->getRequest());
        $this->moduleTemplate->setTitle('DEMO');
    }

    public function indexAction(): ResponseInterface
    {
        $this->siteCreatorService->createSiteSetup();

        return $this->htmlResponse();
    }

    protected function getRequest(): ServerRequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}
