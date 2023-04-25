<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers;

use BK2K\BootstrapPackage\Utility\ImageVariantsUtility;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * FrameViewHelper
 */
class FrameViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @return void
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('id', 'string', 'identifier', true);
        $this->registerArgument('frameClass', 'string', '', false, 'default');
        $this->registerArgument('frameAttributes', 'array', 'Additional tag attributes. They will be added directly to the resulting HTML tag.', false, []);
        $this->registerArgument('type', 'string', '', false, 'default');
        $this->registerArgument('size', 'string', '', false, 'default');
        $this->registerArgument('height', 'string', '', false, 'default');
        $this->registerArgument('layout', 'string', '', false, 'default');
        $this->registerArgument('backgroundColor', 'string', '', false, 'none');
        $this->registerArgument('spaceBefore', 'string', '', false, 'none');
        $this->registerArgument('spaceAfter', 'string', '', false, 'none');
        $this->registerArgument('options', 'mixed', '', false, []);
        $this->registerArgument('variants', 'array', '', false, []);
        $this->registerArgument('backgroundImage', 'mixed', 'image object or src');
        $this->registerArgument('backgroundImageOptions', 'mixed', '');
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws \Exception
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $configuration = $arguments;
        $configuration['type'] = trim((string) $configuration['type']) !== '' ? trim($configuration['type']) : 'default';
        $configuration['frameClass'] = trim((string) $configuration['frameClass']) !== '' ? trim($configuration['frameClass']) : 'default';
        $configuration['frameAttributes'] = isset($configuration['frameAttributes']) && is_array($configuration['frameAttributes']) ? $configuration['frameAttributes'] : [];
        $configuration['size'] = trim((string) $configuration['size']) !== '' ? trim($configuration['size']) : 'default';
        $configuration['height'] = trim((string) $configuration['height']) !== '' ? trim($configuration['height']) : 'default';
        $configuration['layout'] = trim((string) $configuration['layout']) !== '' ? trim($configuration['layout']) : 'default';
        $configuration['backgroundColor'] = trim((string) $configuration['backgroundColor']) !== '' ? trim($configuration['backgroundColor']) : 'none';
        $configuration['spaceBefore'] = trim((string) $configuration['spaceBefore']) !== '' ? trim($configuration['spaceBefore']) : 'none';
        $configuration['spaceAfter'] = trim((string) $configuration['spaceAfter']) !== '' ? trim($configuration['spaceAfter']) : 'none';
        $configuration['displayFrame'] = $configuration['frameClass'] !== 'none' ? true : false;
        $configuration['variants'] = ImageVariantsUtility::getImageVariants($configuration['variants']);

        $identifier = $configuration['id'];

        $classes = [];
        $classes[] = 'frame';
        $classes[] = 'frame-' . $configuration['frameClass'];
        $classes[] = 'frame-type-' . $configuration['type'];
        $classes[] = 'frame-layout-' . $configuration['layout'];
        $classes[] = 'frame-size-' . $configuration['size'];
        $classes[] = 'frame-height-' . $configuration['height'];
        $classes[] = 'frame-background-' . $configuration['backgroundColor'];
        $classes[] = 'frame-space-before-' . $configuration['spaceBefore'];
        $classes[] = 'frame-space-after-' . $configuration['spaceAfter'];

        if (is_string($configuration['options']) || is_array($configuration['options'])) {
            $configuration['options'] = is_array($configuration['options']) ? $configuration['options'] : GeneralUtility::trimExplode(',', (string) $configuration['options']);
            foreach ($configuration['options'] as $option) {
                if (trim($option) !== '') {
                    $classes[] = 'frame-option-' . trim($option);
                }
            }
        }

        // Background Image Id
        $backgroundImageId = 'frame-backgroundimage-' . $identifier;

        // Background Image File
        $backgroundImageFile = null;
        if (is_object($configuration['backgroundImage']) && ($configuration['backgroundImage'] instanceof FileReference || $configuration['backgroundImage'] instanceof File)) {
            $backgroundImageFile = $configuration['backgroundImage'];
        } elseif (is_string($configuration['backgroundImage'])) {
            $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
            $backgroundImageAbsFilename = GeneralUtility::getFileAbsFileName($configuration['backgroundImage']);
            if (file_exists($backgroundImageAbsFilename)) {
                // Do not use absolute file name to ensure correct path resolution from ResourceFactory.
                $backgroundImageFile = $resourceFactory->retrieveFileOrFolderObject($configuration['backgroundImage']);
            }
        }
        if ($backgroundImageFile !== null) {
            $classes[] = 'frame-has-backgroundimage';
        } else {
            $classes[] = 'frame-no-backgroundimage';
        }

        // Background Image Options
        $backgroundImageOptions = [];
        $backgroundImageOptions['behaviour'] = isset($configuration['backgroundImageOptions']['behaviour']) ? $configuration['backgroundImageOptions']['behaviour'] : 'cover';
        $backgroundImageOptions['parallax'] = isset($configuration['backgroundImageOptions']['parallax']) ? (bool) $configuration['backgroundImageOptions']['parallax'] : false;
        $backgroundImageOptions['fade'] = isset($configuration['backgroundImageOptions']['fade']) ? (bool) $configuration['backgroundImageOptions']['fade'] : false;
        $backgroundImageOptions['filter'] = isset($configuration['backgroundImageOptions']['filter']) && trim($configuration['backgroundImageOptions']['filter']) !== '' ? $configuration['backgroundImageOptions']['filter'] : null;

        // Background Image Classes
        $backgroundImageClasses = [];
        $backgroundImageClasses[] = 'frame-backgroundimage';
        $backgroundImageClasses[] = 'frame-backgroundimage-behaviour-' . $backgroundImageOptions['behaviour'];
        if ($backgroundImageOptions['parallax']) {
            $backgroundImageClasses[] = 'frame-backgroundimage-parallax';
        }
        if ($backgroundImageOptions['fade']) {
            $backgroundImageClasses[] = 'frame-backgroundimage-fade';
        }
        if ($backgroundImageOptions['filter']) {
            $backgroundImageClasses[] = 'frame-backgroundimage-' . $backgroundImageOptions['filter'];
        }

        // Frame Attributes
        $configuration['frameAttributes']['id'] = $identifier;
        $configuration['frameAttributes']['class'] = implode(
            ' ',
            array_merge(
                GeneralUtility::trimExplode(
                    ' ',
                    isset($configuration['frameAttributes']['class']) && is_string($configuration['frameAttributes']['class']) ? $configuration['frameAttributes']['class'] : ''
                ),
                $classes
            )
        );

        // Template
        $view = self::getTemplateObject();
        $view->assignMultiple(
            [
                'id' => $identifier,
                'configuration' => $configuration,
                'classes' => $classes,
                'backgroundImage' => [
                    'id' => $backgroundImageId,
                    'file' => $backgroundImageFile,
                    'options' => $backgroundImageOptions,
                    'classes' => $backgroundImageClasses,
                ],
                'variants' => $configuration['variants'],
                'content' => $renderChildrenClosure(),
                'frameAttributes' => GeneralUtility::implodeAttributes($configuration['frameAttributes'], true)
            ]
        );

        return $view->render();
    }

    protected static function getTemplateObject(): StandaloneView
    {
        $setup = static::getConfigurationManager()->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        $layoutRootPaths = [];
        $layoutRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Layouts/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['layoutRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['layoutRootPaths.'] as $layoutRootPath) {
                $layoutRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($layoutRootPath, '/') . '/ViewHelpers/');
            }
        }
        $partialRootPaths = [];
        $partialRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Partials/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['partialRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['partialRootPaths.'] as $partialRootPath) {
                $partialRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($partialRootPath, '/') . '/ViewHelpers/');
            }
        }
        $templateRootPaths = [];
        $templateRootPaths[] = GeneralUtility::getFileAbsFileName('EXT:bootstrap_package/Resources/Private/Templates/ViewHelpers/');
        if (isset($setup['plugin.']['tx_bootstrappackage.']['view.']['templateRootPaths.'])) {
            foreach ($setup['plugin.']['tx_bootstrappackage.']['view.']['templateRootPaths.'] as $templateRootPath) {
                $templateRootPaths[] = GeneralUtility::getFileAbsFileName(rtrim($templateRootPath, '/') . '/ViewHelpers/');
            }
        }

        /** @var StandaloneView $view */
        $view = GeneralUtility::makeInstance(StandaloneView::class);
        $view->setLayoutRootPaths($layoutRootPaths);
        $view->setPartialRootPaths($partialRootPaths);
        $view->setTemplateRootPaths($templateRootPaths);
        $view->setTemplate('Frame/Index');

        return $view;
    }

    protected static function getConfigurationManager(): ConfigurationManagerInterface
    {
        /** @var ConfigurationManager $configurationManager  */
        $configurationManager = GeneralUtility::getContainer()->get(ConfigurationManager::class);

        return $configurationManager;
    }
}
