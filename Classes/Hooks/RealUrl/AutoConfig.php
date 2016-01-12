<?php
namespace BK2K\BootstrapPackage\Hooks\RealUrl;

/*
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
 */

/**
 * @author Benjamin Kott <info@bk2k.info>
 */
class AutoConfig
{
	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;
	
    /**
	 * @var bool
	 */
	protected $hasStaticInfoTables;

    /**
     * Function for RealUrl version < 2.0.0 from Dmitry Dulepov
     * http://typo3.org/extensions/repository/view/realurl
     *
     * @param array $params
     * @param \tx_realurl_autoconfgen $pObj
     * @return array
     */
    public function addConfigVersion1x(array $params, \tx_realurl_autoconfgen $pObj)
    {
        $params = $this->addConfigToParams($params);
        return $params['config'];
    }

    /**
     * Function for RealUrl version >= 2.0.0 from Helmut Hummel
     * https://github.com/helhum/realurl
     *
     * @param array $params
     * @param \Tx\Realurl\Configuration\ConfigurationGenerator $pObj
     * @return array
     */
    public function addConfigVersion2x(array $params, \Tx\Realurl\Configuration\ConfigurationGenerator $pObj)
    {
        $params = $this->addConfigToParams($params);
        return $params['config'];
    }

    /**
     * @param array $params
     * @return array
     */
    protected function addConfigToParams(array $params)
    {
        $this->databaseConnection = $GLOBALS['TYPO3_DB'];

        $this->hasStaticInfoTables = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('static_info_tables');

        $params['config']['preVars'] = array(
            '0' => array(
                'GETvar' => 'no_cache',
                'valueMap' => array(
                    'nc' => '1',
                ),
                'noMatch' => 'bypass'
            ),
            '1' => array(
                'GETvar' => 'L',
                'valueMap' => array(
                ),
                'noMatch' => 'bypass',
            )
        );
        $params['config']['postVarSets']['_DEFAULT']['page'] = array(
            0 => array(
                'GETvar' => 'page',
            )
        );
        
        $this->addLanguages($params);
        
        return $params;
    }
    /**
	 * Adds languages to configuration
	 * Function for RealUrl version >= 2.0.0 from Helmut Hummel
     * https://github.com/helhum/realurl
	 * @param	array		$params	Configuration (passed as reference)
	 * @return	void
	 */
    protected function addLanguages(&$params) {
		if ($this->hasStaticInfoTables) {
			$languages = $this->databaseConnection->exec_SELECTgetRows('t1.uid AS uid,t2.lg_iso_2 AS lg_iso_2', 'sys_language t1, static_languages t2', 't2.uid=t1.static_lang_isocode AND t1.hidden=0');
		}
		else {
			$languages = $this->databaseConnection->exec_SELECTgetRows('t1.uid AS uid,t1.flag AS lg_iso_2', 'sys_language t1', 't1.hidden=0');
		}
		if (count($languages) > 0) {
			foreach ($languages as $lang) {
				$params['preVars'][1]['valueMap'][strtolower($lang['lg_iso_2'])] = $lang['uid'];
			}
		}
	}
}
