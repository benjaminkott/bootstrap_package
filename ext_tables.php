<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}


/***************
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Bootstrap Package');


/***************
 * BackendLayoutDataProvider
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider'][$_EXTKEY] = 'BK2K\BootstrapPackage\Hooks\Options\BackendLayoutDataProvider';


/***************
 * DataHandler Hook
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][$_EXTKEY] = 'BK2K\BootstrapPackage\Hooks\DataHandler';


/***************
 * Adding tt_content menu - news content element specific tca
 */
$TCA['tt_content']['types']['menu']['subtypes_excludelist']['news'] = "selected_categories, category_field";


/***************
 * Bootstrap Palettes
 */
$TCA['tt_content']['palettes']['bootstrap_package_header'] = array(
    'canNotCollapse' => 1,
    'showitem' => '
        header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
        --linebreak--, 
        subheader;LLL:EXT:cms/locallang_ttc.xlf:subheader_formlabel,
        --linebreak--, 
        header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
        --linebreak--, 
        header_link;LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel
    '
);
$TCA['tt_content']['palettes']['bootstrap_package_headersimple'] = array(
    'canNotCollapse' => 1,
    'showitem' => '
        header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
        --linebreak--, 
        header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel
    '
);
$TCA['tt_content']['palettes']['bootstrap_package_icons'] = array(
    'canNotCollapse' => 1,
    'showitem' => '
        icon_position, icon_type, icon_size, --linebreak--,
        icon_color, icon_background, --linebreak--,
        icon
    '
);


/***************
 * Add Content Elements to List
 */
$backupCTypeItems = $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'];
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array(
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:theme_name',
        '--div--'
    ),
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:content_element.texticon',
        'bootstrap_package_texticon',
        'i/tt_content_header.gif'
    ),
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:content_element.carousel',
        'bootstrap_package_carousel',
        'i/tt_content_header.gif'
    ),
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:content_element.accordion',
        'bootstrap_package_accordion',
        'i/tt_content_header.gif'
    ),
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:content_element.panel',
        'bootstrap_package_panel',
        'i/tt_content_header.gif'
    ),
    array(
        'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:content_element.listgroup',
        'bootstrap_package_listgroup',
        'i/tt_content_header.gif'
    )
);
foreach($backupCTypeItems as $key => $value){
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = $value;
}
unset($key);
unset($value);
unset($backupCTypeItems);


/***************
 * Text Icon
 */
$TCA['tt_content']['ctrl']['requestUpdate'] .= ',icon_type';
$TCA['tt_content']['ctrl']['typeicons']['bootstrap_package_texticon'] = 'tt_content_header.gif';
$TCA['tt_content']['types']['bootstrap_package_texticon'] = $TCA['tt_content']['types']['text'];
$texticon_columns = array(
    'icon' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon',
        'config' => array(
            'type' => 'select',
            'selicon_cols' => 14,
            'items' => array(
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.none',0,'EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/none.jpg'),
                array('asterisk','asterisk','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0000_asterisk.jpg'),
                array('plus','plus','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0001_plus.jpg'),
                array('euro','euro','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0002_euro.jpg'),
                array('minus','minus','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0003_minus.jpg'),
                array('cloud','cloud','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0004_cloud.jpg'),
                array('envelope','envelope','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0005_envelope.jpg'),
                array('pencil','pencil','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0006_pencil.jpg'),
                array('glass','glass','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0007_glass.jpg'),
                array('music','music','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0008_music.jpg'),
                array('search','search','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0009_search.jpg'),
                array('heart','heart','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0010_heart.jpg'),
                array('star','star','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0011_star.jpg'),
                array('star-empty','star-empty','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0012_star-empty.jpg'),
                array('user','user','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0013_user.jpg'),
                array('film','film','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0014_film.jpg'),
                array('th-large','th-large','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0015_th-large.jpg'),
                array('th','th','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0016_th.jpg'),
                array('th-list','th-list','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0017_th-list.jpg'),
                array('ok','ok','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0018_ok.jpg'),
                array('remove','remove','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0019_remove.jpg'),
                array('zoom-in','zoom-in','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0020_zoom-in.jpg'),
                array('zoom-out','zoom-out','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0021_zoom-out.jpg'),
                array('off','off','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0022_off.jpg'),
                array('signal','signal','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0023_signal.jpg'),
                array('cog','cog','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0024_cog.jpg'),
                array('trash','trash','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0025_trash.jpg'),
                array('home','home','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0026_home.jpg'),
                array('file','file','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0027_file.jpg'),
                array('time','time','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0028_time.jpg'),
                array('road','road','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0029_road.jpg'),
                array('download-alt','download-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0030_download-alt.jpg'),
                array('download','download','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0031_download.jpg'),
                array('upload','upload','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0032_upload.jpg'),
                array('inbox','inbox','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0033_inbox.jpg'),
                array('play-circle','play-circle','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0034_play-circle.jpg'),
                array('repeat','repeat','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0035_repeat.jpg'),
                array('refresh','refresh','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0036_refresh.jpg'),
                array('list-alt','list-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0037_list-alt.jpg'),
                array('lock','lock','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0038_lock.jpg'),
                array('flag','flag','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0039_flag.jpg'),
                array('headphones','headphones','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0040_headphones.jpg'),
                array('volume-off','volume-off','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0041_volume-off.jpg'),
                array('volume-down','volume-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0042_volume-down.jpg'),
                array('volume-up','volume-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0043_volume-up.jpg'),
                array('qrcode','qrcode','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0044_qrcode.jpg'),
                array('barcode','barcode','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0045_barcode.jpg'),
                array('tag','tag','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0046_tag.jpg'),
                array('tags','tags','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0047_tags.jpg'),
                array('book','book','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0048_book.jpg'),
                array('bookmark','bookmark','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0049_bookmark.jpg'),
                array('print','print','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0050_print.jpg'),
                array('camera','camera','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0051_camera.jpg'),
                array('font','font','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0052_font.jpg'),
                array('bold','bold','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0053_bold.jpg'),
                array('italic','italic','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0054_italic.jpg'),
                array('text-height','text-height','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0055_text-height.jpg'),
                array('text-width','text-width','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0056_text-width.jpg'),
                array('align-left','align-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0057_align-left.jpg'),
                array('align-center','align-center','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0058_align-center.jpg'),
                array('align-right','align-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0059_align-right.jpg'),
                array('align-justify','align-justify','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0060_align-justify.jpg'),
                array('list','list','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0061_list.jpg'),
                array('indent-left','indent-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0062_indent-left.jpg'),
                array('indent-right','indent-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0063_indent-right.jpg'),
                array('facetime-video','facetime-video','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0064_facetime-video.jpg'),
                array('picture','picture','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0065_picture.jpg'),
                array('map-marker','map-marker','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0066_map-marker.jpg'),
                array('adjust','adjust','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0067_adjust.jpg'),
                array('tint','tint','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0068_tint.jpg'),
                array('edit','edit','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0069_edit.jpg'),
                array('share','share','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0070_share.jpg'),
                array('check','check','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0071_check.jpg'),
                array('move','move','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0072_move.jpg'),
                array('step-backward','step-backward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0073_step-backward.jpg'),
                array('fast-backward','fast-backward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0074_fast-backward.jpg'),
                array('backward','backward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0075_backward.jpg'),
                array('play','play','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0076_play.jpg'),
                array('pause','pause','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0077_pause.jpg'),
                array('stop','stop','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0078_stop.jpg'),
                array('forward','forward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0079_forward.jpg'),
                array('fast-forward','fast-forward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0080_fast-forward.jpg'),
                array('step-forward','step-forward','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0081_step-forward.jpg'),
                array('eject','eject','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0082_eject.jpg'),
                array('chevron-left','chevron-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0083_chevron-left.jpg'),
                array('chevron-right','chevron-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0084_chevron-right.jpg'),
                array('plus-sign','plus-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0085_plus-sign.jpg'),
                array('minus-sign','minus-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0086_minus-sign.jpg'),
                array('remove-sign','remove-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0087_remove-sign.jpg'),
                array('ok-sign','ok-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0088_ok-sign.jpg'),
                array('question-sign','question-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0089_question-sign.jpg'),
                array('info-sign','info-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0090_info-sign.jpg'),
                array('screenshot','screenshot','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0091_screenshot.jpg'),
                array('remove-circle','remove-circle','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0092_remove-circle.jpg'),
                array('ok-circle','ok-circle','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0093_ok-circle.jpg'),
                array('ban-circle','ban-circle','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0094_ban-circle.jpg'),
                array('arrow-left','arrow-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0095_arrow-left.jpg'),
                array('arrow-right','arrow-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0096_arrow-right.jpg'),
                array('arrow-up','arrow-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0097_arrow-up.jpg'),
                array('arrow-down','arrow-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0098_arrow-down.jpg'),
                array('share-alt','share-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0099_share-alt.jpg'),
                array('resize-full','resize-full','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0100_resize-full.jpg'),
                array('resize-small','resize-small','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0101_resize-small.jpg'),
                array('exclamation-sign','exclamation-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0102_exclamation-sign.jpg'),
                array('gift','gift','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0103_gift.jpg'),
                array('leaf','leaf','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0104_leaf.jpg'),
                array('fire','fire','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0105_fire.jpg'),
                array('eye-open','eye-open','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0106_eye-open.jpg'),
                array('eye-close','eye-close','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0107_eye-close.jpg'),
                array('warning-sign','warning-sign','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0108_warning-sign.jpg'),
                array('plane','plane','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0109_plane.jpg'),
                array('calendar','calendar','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0110_calendar.jpg'),
                array('random','random','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0111_random.jpg'),
                array('comment','comment','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0112_comment.jpg'),
                array('magnet','magnet','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0113_magnet.jpg'),
                array('chevron-up','chevron-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0114_chevron-up.jpg'),
                array('chevron-down','chevron-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0115_chevron-down.jpg'),
                array('retweet','retweet','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0116_retweet.jpg'),
                array('shopping-cart','shopping-cart','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0117_shopping-cart.jpg'),
                array('folder-close','folder-close','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0118_folder-close.jpg'),
                array('folder-open','folder-open','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0119_folder-open.jpg'),
                array('resize-vertical','resize-vertical','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0120_resize-vertical.jpg'),
                array('resize-horizontal','resize-horizontal','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0121_resize-horizontal.jpg'),
                array('hdd','hdd','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0122_hdd.jpg'),
                array('bullhorn','bullhorn','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0123_bullhorn.jpg'),
                array('bell','bell','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0124_bell.jpg'),
                array('certificate','certificate','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0125_certificate.jpg'),
                array('thumbs-up','thumbs-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0126_thumbs-up.jpg'),
                array('thumbs-down','thumbs-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0127_thumbs-down.jpg'),
                array('hand-right','hand-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0128_hand-right.jpg'),
                array('hand-left','hand-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0129_hand-left.jpg'),
                array('hand-up','hand-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0130_hand-up.jpg'),
                array('hand-down','hand-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0131_hand-down.jpg'),
                array('circle-arrow-right','circle-arrow-right','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0132_circle-arrow-right.jpg'),
                array('circle-arrow-left','circle-arrow-left','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0133_circle-arrow-left.jpg'),
                array('circle-arrow-up','circle-arrow-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0134_circle-arrow-up.jpg'),
                array('circle-arrow-down','circle-arrow-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0135_circle-arrow-down.jpg'),
                array('globe','globe','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0136_globe.jpg'),
                array('wrench','wrench','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0137_wrench.jpg'),
                array('tasks','tasks','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0138_tasks.jpg'),
                array('filter','filter','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0139_filter.jpg'),
                array('briefcase','briefcase','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0140_briefcase.jpg'),
                array('fullscreen','fullscreen','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0141_fullscreen.jpg'),
                array('dashboard','dashboard','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0142_dashboard.jpg'),
                array('paperclip','paperclip','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0143_paperclip.jpg'),
                array('heart-empty','heart-empty','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0144_heart-empty.jpg'),
                array('link','link','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0145_link.jpg'),
                array('phone','phone','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0146_phone.jpg'),
                array('pushpin','pushpin','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0147_pushpin.jpg'),
                array('usd','usd','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0148_usd.jpg'),
                array('gbp','gbp','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0149_gbp.jpg'),
                array('sort','sort','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0150_sort.jpg'),
                array('sort-by-alphabet','sort-by-alphabet','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0151_sort-by-alphabet.jpg'),
                array('sort-by-alphabet-alt','sort-by-alphabet-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0152_sort-by-alphabet-alt.jpg'),
                array('sort-by-order','sort-by-order','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0153_sort-by-order.jpg'),
                array('sort-by-order-alt','sort-by-order-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0154_sort-by-order-alt.jpg'),
                array('sort-by-attributes','sort-by-attributes','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0155_sort-by-attributes.jpg'),
                array('sort-by-attributes-alt','sort-by-attributes-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0156_sort-by-attributes-alt.jpg'),
                array('unchecked','unchecked','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0157_unchecked.jpg'),
                array('expand','expand','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0158_expand.jpg'),
                array('collapse-down','collapse-down','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0159_collapse-down.jpg'),
                array('collapse-up','collapse-up','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0160_collapse-up.jpg'),
                array('log-in','log-in','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0161_log-in.jpg'),
                array('flash','flash','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0162_flash.jpg'),
                array('log-out','log-out','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0163_log-out.jpg'),
                array('new-window','new-window','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0164_new-window.jpg'),
                array('record','record','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0165_record.jpg'),
                array('save','save','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0166_save.jpg'),
                array('open','open','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0167_open.jpg'),
                array('saved','saved','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0168_saved.jpg'),
                array('import','import','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0169_import.jpg'),
                array('export','export','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0170_export.jpg'),
                array('send','send','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0171_send.jpg'),
                array('floppy-disk','floppy-disk','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0172_floppy-disk.jpg'),
                array('floppy-saved','floppy-saved','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0173_floppy-saved.jpg'),
                array('floppy-remove','floppy-remove','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0174_floppy-remove.jpg'),
                array('floppy-save','floppy-save','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0175_floppy-save.jpg'),
                array('floppy-open','floppy-open','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0176_floppy-open.jpg'),
                array('credit-card','credit-card','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0177_credit-card.jpg'),
                array('transfer','transfer','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0178_transfer.jpg'),
                array('cutlery','cutlery','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0179_cutlery.jpg'),
                array('header','header','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0180_header.jpg'),
                array('compressed','compressed','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0181_compressed.jpg'),
                array('earphone','earphone','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0182_earphone.jpg'),
                array('phone-alt','phone-alt','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0183_phone-alt.jpg'),
                array('tower','tower','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0184_tower.jpg'),
                array('stats','stats','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0185_stats.jpg'),
                array('sd-video','sd-video','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0186_sd-video.jpg'),
                array('hd-video','hd-video','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0187_hd-video.jpg'),
                array('subtitles','subtitles','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0188_subtitles.jpg'),
                array('sound-stereo','sound-stereo','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0189_sound-stereo.jpg'),
                array('sound-dolby','sound-dolby','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0190_sound-dolby.jpg'),
                array('sound-5-1','sound-5-1','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0191_sound-5-1.jpg'),
                array('sound-6-1','sound-6-1','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0192_sound-6-1.jpg'),
                array('sound-7-1','sound-7-1','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0193_sound-7-1.jpg'),
                array('copyright-mark','copyright-mark','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0194_copyright-mark.jpg'),
                array('registration-mark','registration-mark','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0195_registration-mark.jpg'),
                array('cloud-download','cloud-download','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0196_cloud-download.jpg'),
                array('cloud-upload','cloud-upload','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0197_cloud-upload.jpg'),
                array('tree-conifer','tree-conifer','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0198_tree-conifer.jpg'),
                array('tree-deciduous','tree-deciduous','EXT:'.$_EXTKEY.'/Resources/Public/Images/Icons/icon-shapes_0199_tree-deciduous.jpg'),
            ),
        ),
    ),
    'icon_position' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon_position',
        'config' => array(
            'type' => 'select',
            'items' => array(
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.left', 'left'),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.right', 'right'),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.top', 'top'),
            ),
        ),
    ),
    'icon_type' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon_type',
        'config' => array(
            'type' => 'select',
            'default' => '0',
            'items' => array(
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.default', 0),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.square', 1),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.circle', 2),
            ),
        ),
    ),
    'icon_size' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon_size',
        'config' => array(
            'type' => 'select',
            'items' => array(
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.default', 0),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.medium', 1),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.large', 2),
                array('LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:option.awesome', 3),
            ),
        ),
    ),
    'icon_color' => array(
        'displayCond' => 'FIELD:icon_type:!=:0',
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon_color',
        'config' => array(
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim',
            'default' => '#FFFFFF',
            'wizards' => array(
                'colorChoice' => array(
                     'type' => 'colorbox',
                     'title' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:colorpicker',
                     'script' => 'wizard_colorpicker.php',
                     'dim' => '20x20',
                     'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                 ),
            ),
        ),
    ),
    'icon_background' => array(
        'displayCond' => 'FIELD:icon_type:!=:0',
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon_background',
        'config' => array(
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim',
            'default' => '#333333',
            'wizards' => array(
                'colorChoice' => array(
                     'type' => 'colorbox',
                     'title' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:colorpicker',
                     'script' => 'wizard_colorpicker.php',
                     'dim' => '20x20',
                     'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                 ),
            ),
        ),
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$texticon_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--palette--;LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:field.icon;bootstrap_package_icons,',
    'bootstrap_package_texticon',
    'after:header'
);
unset($texticon_columns);


/***************
 * Panel
 */
$TCA['tt_content']['ctrl']['typeicons']['bootstrap_package_panel'] = 'tt_content_header.gif';
$TCA['tt_content']['types']['bootstrap_package_panel']['showitem'] = "
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;bootstrap_package_headersimple,
    bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext_formlabel;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], 
    rte_enabled;LLL:EXT:cms/locallang_ttc.xlf:rte_enabled_formlabel,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
    --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
    categories
";

/***************
 * List Group
 */
$TCA['tt_content']['ctrl']['typeicons']['bootstrap_package_listgroup'] = 'tt_content_header.gif';
$TCA['tt_content']['types']['bootstrap_package_listgroup']['showitem'] = "
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;bootstrap_package_header,
    bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.bulletlist_formlabel;;nowrap,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
    --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
    categories
";


/***************
 * Carousel and Carousel Item
 */
$carousel_columns = array(
    'tx_bootstrappackage_carousel_item' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:carousel_item',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_bootstrappackage_carousel_item',
            'foreign_field' => 'tt_content',
            'appearance' => array(
                'useSortable' => TRUE,
                'showSynchronizationLink' => TRUE,
                'showAllLocalizationLink' => TRUE,
                'showPossibleLocalizationRecords' => TRUE,
                'showRemovedLocalizationRecords' => FALSE,
                'expandSingle' => TRUE,
                'enabledControls' => array (
                    'localize' => TRUE,
                ),
            ),
            'behaviour' => array(
                'localizationMode' => 'select',
                'mode' => 'select',
                'localizeChildrenAtParentLocalization' => TRUE,
            ),
        ),
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$carousel_columns);
unset($carousel_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_carousel_item');
$TCA['tx_bootstrappackage_carousel_item'] = array(
    'ctrl' => array(
        'label' => 'header',
        'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
        'title'	=> 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:carousel_item',
        'type' => 'item_type',
		'delete' => 'deleted',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'hideAtCopy' => FALSE,
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xlf:LGL.prependAtCopy',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'languageField' => 'sys_language_uid',
        'dividers2tabs' => TRUE,
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'typeicons' => array(
            'header' => 'tt_content_header.gif',
            'html' => 'tt_content_html.gif',
            'textandimage' => 'tt_content_textpic.gif',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/CarouselItem.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/bootstrap_package_item_teaser.gif'
    ),
);
$TCA['tt_content']['types']['bootstrap_package_carousel']['showitem'] = "
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;bootstrap_package_header,
    tx_bootstrappackage_carousel_item,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
    --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
    categories
";


/***************
 * Accordion and Accordion Item
 */
$accordion_columns = array(
    'tx_bootstrappackage_accordion_item' => array(
        'label' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:accordion_item',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_bootstrappackage_accordion_item',
            'foreign_field' => 'tt_content',
            'appearance' => array(
                'useSortable' => TRUE,
                'showSynchronizationLink' => TRUE,
                'showAllLocalizationLink' => TRUE,
                'showPossibleLocalizationRecords' => TRUE,
                'showRemovedLocalizationRecords' => FALSE,
                'expandSingle' => TRUE,
                'enabledControls' => array (
                    'localize' => TRUE,
                ),
            ),
            'behaviour' => array(
                'localizationMode' => 'select',
                'mode' => 'select',
                'localizeChildrenAtParentLocalization' => TRUE,
            ),
        ),
    ),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content',$accordion_columns);
unset($accordion_columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_bootstrappackage_accordion_item');
$TCA['tx_bootstrappackage_accordion_item'] = array(
    'ctrl' => array(  
        'label' => 'header',
		'label_alt' => 'bodytext',
		'sortby' => 'sorting',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'title' => 'LLL:EXT:'.$_EXTKEY.'/Resources/Private/Language/Backend.xlf:accordion_item',
		'delete' => 'deleted',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'hideAtCopy' => FALSE,
		'prependAtCopy' => 'LLL:EXT:lang/locallang_general.xlf:LGL.prependAtCopy',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'languageField' => 'sys_language_uid',
        'dividers2tabs' => TRUE,
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/AccordionItem.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/bootstrap_package_item_accordion.gif'
    ),
);
$TCA['tt_content']['types']['bootstrap_package_accordion']['showitem'] = "
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.headers;bootstrap_package_header,
    tx_bootstrappackage_accordion_item,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
    --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
    --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
    categories
";


/***************
 * Backend Module
 */
if (TYPO3_MODE === 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {

    $mainModuleName = 'bootstrappackage';

    /***************
     * Register Main Module
     */
    if (!isset($TBE_MODULES[$mainModuleName])) {
        $temp_TBE_MODULES = array();
        foreach ($TBE_MODULES as $key => $val) {
            if ($key == 'web') {
                $temp_TBE_MODULES[$key] = $val;
                $temp_TBE_MODULES[$mainModuleName] = '';
            } else {
                $temp_TBE_MODULES[$key] = $val;
            }
        }
        $TBE_MODULES = $temp_TBE_MODULES;
    }
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'BK2K.'.$_EXTKEY,
        $mainModuleName,
        '',
        '',
        array()
    );
    $TBE_MODULES['_configuration'][$mainModuleName]['access'] = 'user,group';
    $TBE_MODULES['_configuration'][$mainModuleName]['icon'] = 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/bootstrap_package_module_style.gif';
    $TBE_MODULES['_configuration'][$mainModuleName]['labels'] = 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/MainModule.xlf';

    /***************
     * Register Settings Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'BK2K.'.$_EXTKEY,
        $mainModuleName,
        'SettingsStyle',
        '',
        array(
            'SettingsStyle' => 'settings,save',
        ),
        array(
            'access' => 'user,group',
            'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/bootstrap_package_module_style.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/ModSettings.xlf',
        )
    );

    /***************
     * Backend Forms Style
     */
    $TCA['__bootstrappackage_form_style'] = array(
        'ctrl' => array(
            'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/ThemeSettings.xlf:theme.settings.style',
            'hideTable' => true,
            'canNotCollapse' => true,
            'dividers2tabs' => true,
            'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/Forms/SettingsStyle.php',
            'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
        ),
    );

}


/***************
 * Backend Styling
 */
if (TYPO3_MODE == 'BE') {
    $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
    if(!isset($settings['Logo'])){
        $settings['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/TopBarLogo@2x.png';
    }
    if(!isset($settings['LoginLogo'])){
        $settings['LoginLogo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/LoginLogo.png';
    }
    $GLOBALS['TBE_STYLES']['logo'] = $settings['Logo'];
    $GLOBALS['TBE_STYLES']['logo_login'] = $settings['LoginLogo'];
    $GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = 'EXT:bootstrap_package/Resources/Private/Templates/Backend/Login.html';
    unset($settings);
}