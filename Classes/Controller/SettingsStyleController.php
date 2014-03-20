<?php
namespace BK2K\BootstrapPackage\Controller;

/***************************************************************
 * 
 *  The MIT License (MIT)
 *
 *  Copyright (c) 2014 Benjamin Kott, http://www.bk2k.info
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
 *
 ***************************************************************/

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class SettingsStyleController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * LESS compiler and parser.
     * @var \Less_Parser
     */
    protected $less; 
    
    /**
     * LESS compile options (not working yet)
     * @var array
     */
    protected $lessOptions = array(
        'compress'=> true
    );   
    
    /**
     * LESS files
     * @var array
     */
    protected $lessFiles = array(
        'EXT:bootstrap_package/Resources/Private/Less/Bootstrap-3-1-1/bootstrap.less',
        'EXT:bootstrap_package/Resources/Private/Less/Theme/theme.less'
    );
    
    /**
     * @var string
     */
    protected $lessDefaultVariablesFile = 'EXT:bootstrap_package/Resources/Private/Less/Bootstrap-3-1-1/Default/variables.less';
    
    /**
     * @var string
     */
    protected $lessSavedVariablesFile = 'EXT:bootstrap_package/Resources/Private/Less/Bootstrap-3-1-1/variables.less';
    
    /**
     * @var array
     */
    protected $defaultVariables;
    
    /**
     * @var array
     */
    protected $savedVariables;
    
    /**
     * @var array
     */
    protected $mergedVariables;
    
    /**
     * @var string
     */
    protected $formName = "__bootstrappackage_form_style";
    
    /**
     * @var string
     */
    protected $outputFile = 'EXT:bootstrap_package/Resources/Public/Css/theme.min.css';

    /**
     * Initializes the controller before invoking an action method.
     * @return void
     */
    protected function initializeAction() {
        if(!class_exists('Less_Parser')){
            $autoload = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Less_Autoloader');
            $autoload::register();
        }
        $this->less = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Less_Parser');
        $this->setBackendModuleTemplates();
        $this->injectDefaultLessVariables();
        $this->injectSavedLessVariables();
        $this->mergeDefaultAndSavedVariables();
    }
    
    /**
     * Set Backend Module Templates
     * @return void
     */
    private function setBackendModuleTemplates(){
        $frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $viewConfiguration = array(
            'view' => array(
                'templateRootPath' => 'EXT:bootstrap_package/Resources/Private/Templates/Modules/',
                'partialRootPath' => 'EXT:bootstrap_package/Resources/Private/Partials/Modules/',
                'layoutRootPath' => 'EXT:bootstrap_package/Resources/Private/Layouts/Modules/',
            )
        );
        $this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $viewConfiguration));        
    }
    
    /**
     * @return void
     */
    private function injectDefaultLessVariables(){
        $this->defaultVariables = $this->readLessVariablesFile($this->lessDefaultVariablesFile);
    }
    
    /**
     * @return void
     */
    private function injectSavedLessVariables(){
        $this->savedVariables = $this->readLessVariablesFile($this->lessSavedVariablesFile);
    }
    
    /**
     * Get Default Less Variables and Values
     * @return array
     */
    private function getDefaultLessVariables(){     
        return $this->defaultVariables;
    }
    
    /**
     * Get Saved Less Variables and Values
     * @return array
     */
    private function getSavedLessVariables(){     
        return $this->savedVariables;
    }
       
    /**
     * Merges default and saved variables
     * @return array
     */
    private function mergeDefaultAndSavedVariables(){
        $this->mergedVariables = array_merge($this->defaultVariables, $this->savedVariables);
    }
    
    /**
     * action settings
     * @return void
     */
    public function settingsAction(){
        $data = array();
        foreach($this->mergedVariables as $key => $value){
            $data[$key] = $value['value']; 
        }        
        $this->view->assign('formName', $this->formName);
        $this->view->assign('variables', $data);
    }
    
    /**
     * action save
     * @return void
     */
    public function saveAction(){
        $arguments = $this->request->getInternalArgument($this->formName);
        $variables = $arguments['none'];
        $this->writeLessFile($variables);
        $this->compileLessFile();
        $this->redirect('settings');
    }

    /**
     * Read less variables file
     * @param string $filename
     * @return array
     */
    private function readLessVariablesFile($filename){
        $file = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($filename);
        $variables = array();
        if(file_exists($file)){
            $contents = \file_get_contents($file);
            $contentsArray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(LF, $contents);
            foreach($contentsArray as $row){
                if(strpos($row,'@') === 0){
                    $split = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(':', $row);
                    $name = $split[0];
                    $splittwo = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode('//', $split[1]);
                    $value = $splittwo[0];
                    $comment = $splittwo[1];
                    $variable = array(
                        'name' => $name,
                        'value' => trim($value,";"),
                        'comment' => $comment
                    );
                    $variables[str_replace('@','',$name)] = $variable;
                }
            }
        }
        return $variables;
    }   
    
    /**
     * Write Less File
     * @param array $variables
     * @return void
     * @throws \RuntimeException
     */
    public function writeLessFile($variables){
        $output = "// Generated on ".date('d.m.Y - H:i',time());
        foreach($this->defaultVariables as $key => $values){
            $output .= "\n";
            $output .= $values['name'].": ";
            $v = trim($variables[$key],";");
            if($v){
                $output .= $v.";";
            }else{
                $output .= $values['value'].";";
            }
        }
        $file = fopen(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->lessSavedVariablesFile),"w");
        if(!fwrite($file, $output)){
            throw new \RuntimeException('Something went wrong check if you have permissions to write the '.\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->lessSavedVariablesFile).' file ', 1384966952);
        }
        fclose($file);
    }
    
    /**
     * Compiles and saves the css file
     * @throws \RuntimeException
     * @return void
     */
    public function compileLessFile(){
        try {
            foreach($this->lessFiles as $file){
                $this->less->parseFile(
                    \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($file)
                );
            }
            $output = $this->less->getCss();
            $fileName = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($this->outputFile);
            $file = fopen($fileName,"w");
            if(!fwrite($file, $output)){
                throw new \RuntimeException('Something went wrong check if you have permissions to write the '.$this->outputFile.' file ', 1385495429);
            }
            fclose($file);
        }
        catch (exception $e) {
            throw new \RuntimeException('Something went wrong: '.$e->getMessage(), 1384966952);
        }
    }    
    
}