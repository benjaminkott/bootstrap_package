<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Controller;

use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

class ContentController extends ActionController
{
    public function galleryAction(int $currentPage = 1): void
    {
        $paginator = new QueryResultPaginator($extensions, $currentPage);
        $pagination = new SimplePagination($paginator);
        $this->view->assign('extensions', $extensions)
                ->assign('paginator', $paginator)
                ->assign('pagination', $pagination)
                ->assign('search', $search)
                ->assign('availableAndInstalled', $availableAndInstalledExtensions)
                ->assign('actionName', 'ter')
                ->assign('tableId', $tableId)
        ;
    }
}
