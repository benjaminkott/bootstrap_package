<?php
declare(strict_types = 1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Form\FieldInformation;

use TYPO3\CMS\Backend\Form\AbstractNode;
use TYPO3\CMS\Core\Localization\LanguageService;

/**
 * Provides field information texts for form engine fields concerning site configuration module
 */
class AdditionalFieldInformation extends AbstractNode
{
    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render()
    {
        $resultArray = $this->initializeResultArray();
        if (isset($this->data['parameterArray']['fieldConf']['description'])) {
            $fieldInformationText = $this->getLanguageService()->sL($this->data['parameterArray']['fieldConf']['description']);
            if (trim($fieldInformationText) !== '') {
                $resultArray['html'] = '<p>' . htmlspecialchars($fieldInformationText, ENT_QUOTES | ENT_HTML5) . '</p>';
            }
        }
        return $resultArray;
    }

    /**
     * Returns the LanguageService
     *
     * @return LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}
