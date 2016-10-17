<?php
namespace BK2K\BootstrapPackage\DataProcessing;

/*
  *  The MIT License (MIT)
  *
  *  Copyright (c) 2015 Benjamin Kott, http://www.bk2k.info
  *
  *  Permission is hereby granted, free of charge, to any person obtaining a copy
  *  of this software and associated documentation files (the "Software"), to deal
  *  in the Software without restriction, including without limitation the rights
  *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  *  copies of the Software, and to permit persons to whom the Software is
  *  furnished to do so, subject to the following conditions:
  *
  *  The above copyright notice and this permission notice shall be included in
  *  all copies or substantial portions of the Software.
  *
  *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  *  THE SOFTWARE.
*/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentDataProcessor;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
  * This menu processor utilizes HMENU to generate a json encoded menu
  * string that will be decoded again and assigned to FLUIDTEMPLATE as
  * variable. Additional DataProcessing is supported and will be applied
  * to each record.
  *
  * Options:
  * as - The variable to be used within the result
  *
  * Load file metadata to be able to get image sizes
  * and crop settings.
  * Precompute equal Height (inspired from CssStyledContentController)
  * include support for art direction.
  *
  * Example TypoScript configuration:
  *
  * 10 = BK2K\BootstrapPackage\DataProcessing\ImageMetadataProcessor
  * 10 {
  *   as = files
  *  }
  *
*/
class ImageMetadataProcessor implements DataProcessorInterface
{
  /**
    * The content object renderer
    *
    * @var ContentObjectRenderer
  */
  public $cObj;

  /**
    * @var array
  */
  protected $defaults = [
  'as' => 'files'
  ];

  /**
    * MetaData Repository
    *
    * @var TYPO3\CMS\Core\Resource\Index\MetaDataRepository $MetaDataRepository
    * @inject
  */
  protected $MetaDataRepository;

  /**
    * The processor configuration
    *
    * @var array
  */
  protected $processorConfiguration;

  /**
    * @var ContentDataProcessor
  */
  protected $contentDataProcessor;

  /**
    * Constructor
  */
  public function __construct()
  {
    $this->contentDataProcessor = GeneralUtility::makeInstance(ContentDataProcessor::class);
  }

  /**
    * Get configuration value from processorConfiguration
    *
    * @param string $key
    * @return string
  */
  protected function getConfigurationValue($key)
  {
    return $this->cObj->stdWrapValue($key, $this->processorConfiguration, $this->defaults[$key]);
  }
  /**
    * Update image metadata
    *
    * @param TYPO3\CMS\Core\Resource\File $originalFile
    * @return void
  */
  protected function updateMetadata(&$file)
  {
    $fileNameAndPath = $file->getForLocalProcessing(FALSE);
    $imageInfo = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Type\\File\\ImageInfo', $fileNameAndPath);
    $additionalMetaInformation = array(
      'width' => $imageInfo->getWidth(),
      'height' => $imageInfo->getHeight()
    );
    $this->MetaDataRepository->update($file->getUid(), $additionalMetaInformation);
  }


  /**
    * @param ContentObjectRenderer $cObj The data of the content element or page
    * @param array $contentObjectConfiguration The configuration of Content Object
    * @param array $processorConfiguration The configuration of this processor
    * @param array $processedData Key/value store of processed data (e.g. to be passed to a Fluid View)
    * @return array the processed data as key/value store
  */
  public function process(ContentObjectRenderer $cObj, array $contentObjectConfiguration, array $processorConfiguration, array $processedData)
  {
    $this->processorConfiguration = $processorConfiguration;
    $this->cObj = $cObj;

    // Get Configuration
    $as = $this->getConfigurationValue('as');

    // load / Generate metadata
    foreach ($processedData[$as] as $k=>$file){
      $width  = $file->getProperty('width');
      $height = $file->getProperty('height');
      if (!$height or !$width) {
        $this->updateMetadata($file);
      }
    }

    $imgCount = count($processedData[$as]);

    // art direction
    $breakpoints = 1;
    if (($this->cObj->data['image_rendering'] & 16) == 16) {
      $breakpoints = 5;
    }

    $imgCount = floor($imgCount/$breakpoints);
    // limit number of cols
    $cols = intval($this->cObj->data['imagecols']);
    $colCount = $cols > 1 ? $cols : 1;
    if ($colCount > $imgCount) {
      $colCount = $imgCount;
      $processedData['data']['imagecols'] = $colCount;
    }

    // disable variable columns count
    if ($this->cObj->data['imageheight'] and !$this->cObj->data['imagewidth']) {

      $equalHeight = intval($this->cObj->data['imageheight']);
      $processedData['data']['imageheight'] = '0';
      $rowCount = ceil($imgCount/$colCount);
      $relations_cols = array();
      $imgWidths = array();

      // compute columns relations with respect to crop settings
      // when we are in art direction mode compare columns between same breakpoint
      for ($j = 0; $j < $breakpoints; $j++){
        for ($k = 0; $k < $imgCount; $k++) {

          $file = $processedData[$as][$j+$k*$breakpoints];
          $width = $file->getProperty('width');
          $height= $file->getProperty('height');
          $crop =  $file->getProperty('crop');
          $crops[$j+$k*$breakpoints] = $crop;
          if ($crop) {
            $crop = json_decode($crop);
            $width = $crop->width;
            $height= $crop->height;
          }
          $rel = $height / $equalHeight;
          $imgWidths[$j+$k*$breakpoints] = $width / $rel;

          $relations_cols[$j][(int)floor($k / $colCount)] += $imgWidths[$j+$k*$breakpoints];
        }
      }
      ksort($imgWidths);
      ksort($crops);
      $processedData['data']['image_equalHeight'] = array(
        'equalHeight' => $equalHeight,
        'imgWidths' => $imgWidths,
        'relations_cols' => $relations_cols
      );

    }

    return $processedData;
  }

}
