<?php

/***************
 * Add Content Element: Bootstrap Package Texticon
 */
if (!is_array($GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'])) {
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'] = [];
}

/***************
 * Add content element to seletor list
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.texticon',
        'bootstrap_package_texticon',
        'content-bootstrappackage-texticon'
    ],
    'bootstrap_package_tab',
    'after'
);

/***************
 * Assign Icon
 */
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['bootstrap_package_texticon'] = 'content-bootstrappackage-texticon';

/***************
 * Register palettes
 */
$GLOBALS['TCA']['tt_content']['palettes']['bootstrap_package_icons'] = [
    'canNotCollapse' => 1,
    'showitem' => '
        icon_position, icon_type, icon_size, --linebreak--,
        icon_color, icon_background, --linebreak--,
        icon
    '
];

/***************
 * Register request update
 */
 $GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',icon_type';

/***************
 * Configure element type
 */
$GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['types']['bootstrap_package_texticon'],
    [
        'showitem' => '
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon;bootstrap_package_icons,
            bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
            rte_enabled;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:rte_enabled_formlabel,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
            --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
            --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
            --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
            categories
        ',
        'columnsOverrides' => [
            'bodytext' => [
                'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
            ]
        ]
    ]
);

/***************
 * Register fields
 */
$GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns'],
    [
        'icon' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'showIconTable' => true,
                'selicon_cols' => 14,
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.none', 0, 'EXT:bootstrap_package/Resources/Public/Images/Icons/none.jpg'],
                    ['asterisk', 'asterisk', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0000_asterisk.jpg'],
                    ['plus', 'plus', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0001_plus.jpg'],
                    ['euro', 'euro', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0002_euro.jpg'],
                    ['minus', 'minus', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0003_minus.jpg'],
                    ['cloud', 'cloud', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0004_cloud.jpg'],
                    ['envelope', 'envelope', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0005_envelope.jpg'],
                    ['pencil', 'pencil', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0006_pencil.jpg'],
                    ['glass', 'glass', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0007_glass.jpg'],
                    ['music', 'music', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0008_music.jpg'],
                    ['search', 'search', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0009_search.jpg'],
                    ['heart', 'heart', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0010_heart.jpg'],
                    ['star', 'star', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0011_star.jpg'],
                    ['star-empty', 'star-empty', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0012_star-empty.jpg'],
                    ['user', 'user', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0013_user.jpg'],
                    ['film', 'film', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0014_film.jpg'],
                    ['th-large', 'th-large', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0015_th-large.jpg'],
                    ['th', 'th', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0016_th.jpg'],
                    ['th-list', 'th-list', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0017_th-list.jpg'],
                    ['ok', 'ok', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0018_ok.jpg'],
                    ['remove', 'remove', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0019_remove.jpg'],
                    ['zoom-in', 'zoom-in', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0020_zoom-in.jpg'],
                    ['zoom-out', 'zoom-out', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0021_zoom-out.jpg'],
                    ['off', 'off', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0022_off.jpg'],
                    ['signal', 'signal', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0023_signal.jpg'],
                    ['cog', 'cog', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0024_cog.jpg'],
                    ['trash', 'trash', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0025_trash.jpg'],
                    ['home', 'home', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0026_home.jpg'],
                    ['file', 'file', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0027_file.jpg'],
                    ['time', 'time', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0028_time.jpg'],
                    ['road', 'road', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0029_road.jpg'],
                    ['download-alt', 'download-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0030_download-alt.jpg'],
                    ['download', 'download', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0031_download.jpg'],
                    ['upload', 'upload', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0032_upload.jpg'],
                    ['inbox', 'inbox', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0033_inbox.jpg'],
                    ['play-circle', 'play-circle', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0034_play-circle.jpg'],
                    ['repeat', 'repeat', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0035_repeat.jpg'],
                    ['refresh', 'refresh', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0036_refresh.jpg'],
                    ['list-alt', 'list-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0037_list-alt.jpg'],
                    ['lock', 'lock', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0038_lock.jpg'],
                    ['flag', 'flag', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0039_flag.jpg'],
                    ['headphones', 'headphones', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0040_headphones.jpg'],
                    ['volume-off', 'volume-off', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0041_volume-off.jpg'],
                    ['volume-down', 'volume-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0042_volume-down.jpg'],
                    ['volume-up', 'volume-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0043_volume-up.jpg'],
                    ['qrcode', 'qrcode', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0044_qrcode.jpg'],
                    ['barcode', 'barcode', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0045_barcode.jpg'],
                    ['tag', 'tag', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0046_tag.jpg'],
                    ['tags', 'tags', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0047_tags.jpg'],
                    ['book', 'book', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0048_book.jpg'],
                    ['bookmark', 'bookmark', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0049_bookmark.jpg'],
                    ['print', 'print', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0050_print.jpg'],
                    ['camera', 'camera', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0051_camera.jpg'],
                    ['font', 'font', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0052_font.jpg'],
                    ['bold', 'bold', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0053_bold.jpg'],
                    ['italic', 'italic', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0054_italic.jpg'],
                    ['text-height', 'text-height', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0055_text-height.jpg'],
                    ['text-width', 'text-width', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0056_text-width.jpg'],
                    ['align-left', 'align-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0057_align-left.jpg'],
                    ['align-center', 'align-center', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0058_align-center.jpg'],
                    ['align-right', 'align-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0059_align-right.jpg'],
                    ['align-justify', 'align-justify', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0060_align-justify.jpg'],
                    ['list', 'list', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0061_list.jpg'],
                    ['indent-left', 'indent-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0062_indent-left.jpg'],
                    ['indent-right', 'indent-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0063_indent-right.jpg'],
                    ['facetime-video', 'facetime-video', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0064_facetime-video.jpg'],
                    ['picture', 'picture', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0065_picture.jpg'],
                    ['map-marker', 'map-marker', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0066_map-marker.jpg'],
                    ['adjust', 'adjust', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0067_adjust.jpg'],
                    ['tint', 'tint', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0068_tint.jpg'],
                    ['edit', 'edit', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0069_edit.jpg'],
                    ['share', 'share', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0070_share.jpg'],
                    ['check', 'check', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0071_check.jpg'],
                    ['move', 'move', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0072_move.jpg'],
                    ['step-backward', 'step-backward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0073_step-backward.jpg'],
                    ['fast-backward', 'fast-backward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0074_fast-backward.jpg'],
                    ['backward', 'backward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0075_backward.jpg'],
                    ['play', 'play', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0076_play.jpg'],
                    ['pause', 'pause', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0077_pause.jpg'],
                    ['stop', 'stop', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0078_stop.jpg'],
                    ['forward', 'forward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0079_forward.jpg'],
                    ['fast-forward', 'fast-forward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0080_fast-forward.jpg'],
                    ['step-forward', 'step-forward', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0081_step-forward.jpg'],
                    ['eject', 'eject', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0082_eject.jpg'],
                    ['chevron-left', 'chevron-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0083_chevron-left.jpg'],
                    ['chevron-right', 'chevron-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0084_chevron-right.jpg'],
                    ['plus-sign', 'plus-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0085_plus-sign.jpg'],
                    ['minus-sign', 'minus-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0086_minus-sign.jpg'],
                    ['remove-sign', 'remove-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0087_remove-sign.jpg'],
                    ['ok-sign', 'ok-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0088_ok-sign.jpg'],
                    ['question-sign', 'question-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0089_question-sign.jpg'],
                    ['info-sign', 'info-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0090_info-sign.jpg'],
                    ['screenshot', 'screenshot', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0091_screenshot.jpg'],
                    ['remove-circle', 'remove-circle', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0092_remove-circle.jpg'],
                    ['ok-circle', 'ok-circle', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0093_ok-circle.jpg'],
                    ['ban-circle', 'ban-circle', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0094_ban-circle.jpg'],
                    ['arrow-left', 'arrow-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0095_arrow-left.jpg'],
                    ['arrow-right', 'arrow-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0096_arrow-right.jpg'],
                    ['arrow-up', 'arrow-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0097_arrow-up.jpg'],
                    ['arrow-down', 'arrow-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0098_arrow-down.jpg'],
                    ['share-alt', 'share-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0099_share-alt.jpg'],
                    ['resize-full', 'resize-full', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0100_resize-full.jpg'],
                    ['resize-small', 'resize-small', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0101_resize-small.jpg'],
                    ['exclamation-sign', 'exclamation-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0102_exclamation-sign.jpg'],
                    ['gift', 'gift', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0103_gift.jpg'],
                    ['leaf', 'leaf', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0104_leaf.jpg'],
                    ['fire', 'fire', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0105_fire.jpg'],
                    ['eye-open', 'eye-open', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0106_eye-open.jpg'],
                    ['eye-close', 'eye-close', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0107_eye-close.jpg'],
                    ['warning-sign', 'warning-sign', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0108_warning-sign.jpg'],
                    ['plane', 'plane', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0109_plane.jpg'],
                    ['calendar', 'calendar', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0110_calendar.jpg'],
                    ['random', 'random', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0111_random.jpg'],
                    ['comment', 'comment', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0112_comment.jpg'],
                    ['magnet', 'magnet', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0113_magnet.jpg'],
                    ['chevron-up', 'chevron-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0114_chevron-up.jpg'],
                    ['chevron-down', 'chevron-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0115_chevron-down.jpg'],
                    ['retweet', 'retweet', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0116_retweet.jpg'],
                    ['shopping-cart', 'shopping-cart', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0117_shopping-cart.jpg'],
                    ['folder-close', 'folder-close', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0118_folder-close.jpg'],
                    ['folder-open', 'folder-open', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0119_folder-open.jpg'],
                    ['resize-vertical', 'resize-vertical', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0120_resize-vertical.jpg'],
                    ['resize-horizontal', 'resize-horizontal', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0121_resize-horizontal.jpg'],
                    ['hdd', 'hdd', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0122_hdd.jpg'],
                    ['bullhorn', 'bullhorn', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0123_bullhorn.jpg'],
                    ['bell', 'bell', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0124_bell.jpg'],
                    ['certificate', 'certificate', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0125_certificate.jpg'],
                    ['thumbs-up', 'thumbs-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0126_thumbs-up.jpg'],
                    ['thumbs-down', 'thumbs-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0127_thumbs-down.jpg'],
                    ['hand-right', 'hand-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0128_hand-right.jpg'],
                    ['hand-left', 'hand-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0129_hand-left.jpg'],
                    ['hand-up', 'hand-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0130_hand-up.jpg'],
                    ['hand-down', 'hand-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0131_hand-down.jpg'],
                    ['circle-arrow-right', 'circle-arrow-right', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0132_circle-arrow-right.jpg'],
                    ['circle-arrow-left', 'circle-arrow-left', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0133_circle-arrow-left.jpg'],
                    ['circle-arrow-up', 'circle-arrow-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0134_circle-arrow-up.jpg'],
                    ['circle-arrow-down', 'circle-arrow-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0135_circle-arrow-down.jpg'],
                    ['globe', 'globe', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0136_globe.jpg'],
                    ['wrench', 'wrench', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0137_wrench.jpg'],
                    ['tasks', 'tasks', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0138_tasks.jpg'],
                    ['filter', 'filter', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0139_filter.jpg'],
                    ['briefcase', 'briefcase', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0140_briefcase.jpg'],
                    ['fullscreen', 'fullscreen', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0141_fullscreen.jpg'],
                    ['dashboard', 'dashboard', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0142_dashboard.jpg'],
                    ['paperclip', 'paperclip', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0143_paperclip.jpg'],
                    ['heart-empty', 'heart-empty', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0144_heart-empty.jpg'],
                    ['link', 'link', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0145_link.jpg'],
                    ['phone', 'phone', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0146_phone.jpg'],
                    ['pushpin', 'pushpin', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0147_pushpin.jpg'],
                    ['usd', 'usd', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0148_usd.jpg'],
                    ['gbp', 'gbp', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0149_gbp.jpg'],
                    ['sort', 'sort', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0150_sort.jpg'],
                    ['sort-by-alphabet', 'sort-by-alphabet', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0151_sort-by-alphabet.jpg'],
                    ['sort-by-alphabet-alt', 'sort-by-alphabet-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0152_sort-by-alphabet-alt.jpg'],
                    ['sort-by-order', 'sort-by-order', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0153_sort-by-order.jpg'],
                    ['sort-by-order-alt', 'sort-by-order-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0154_sort-by-order-alt.jpg'],
                    ['sort-by-attributes', 'sort-by-attributes', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0155_sort-by-attributes.jpg'],
                    ['sort-by-attributes-alt', 'sort-by-attributes-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0156_sort-by-attributes-alt.jpg'],
                    ['unchecked', 'unchecked', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0157_unchecked.jpg'],
                    ['expand', 'expand', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0158_expand.jpg'],
                    ['collapse-down', 'collapse-down', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0159_collapse-down.jpg'],
                    ['collapse-up', 'collapse-up', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0160_collapse-up.jpg'],
                    ['log-in', 'log-in', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0161_log-in.jpg'],
                    ['flash', 'flash', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0162_flash.jpg'],
                    ['log-out', 'log-out', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0163_log-out.jpg'],
                    ['new-window', 'new-window', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0164_new-window.jpg'],
                    ['record', 'record', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0165_record.jpg'],
                    ['save', 'save', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0166_save.jpg'],
                    ['open', 'open', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0167_open.jpg'],
                    ['saved', 'saved', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0168_saved.jpg'],
                    ['import', 'import', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0169_import.jpg'],
                    ['export', 'export', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0170_export.jpg'],
                    ['send', 'send', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0171_send.jpg'],
                    ['floppy-disk', 'floppy-disk', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0172_floppy-disk.jpg'],
                    ['floppy-saved', 'floppy-saved', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0173_floppy-saved.jpg'],
                    ['floppy-remove', 'floppy-remove', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0174_floppy-remove.jpg'],
                    ['floppy-save', 'floppy-save', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0175_floppy-save.jpg'],
                    ['floppy-open', 'floppy-open', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0176_floppy-open.jpg'],
                    ['credit-card', 'credit-card', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0177_credit-card.jpg'],
                    ['transfer', 'transfer', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0178_transfer.jpg'],
                    ['cutlery', 'cutlery', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0179_cutlery.jpg'],
                    ['header', 'header', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0180_header.jpg'],
                    ['compressed', 'compressed', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0181_compressed.jpg'],
                    ['earphone', 'earphone', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0182_earphone.jpg'],
                    ['phone-alt', 'phone-alt', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0183_phone-alt.jpg'],
                    ['tower', 'tower', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0184_tower.jpg'],
                    ['stats', 'stats', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0185_stats.jpg'],
                    ['sd-video', 'sd-video', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0186_sd-video.jpg'],
                    ['hd-video', 'hd-video', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0187_hd-video.jpg'],
                    ['subtitles', 'subtitles', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0188_subtitles.jpg'],
                    ['sound-stereo', 'sound-stereo', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0189_sound-stereo.jpg'],
                    ['sound-dolby', 'sound-dolby', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0190_sound-dolby.jpg'],
                    ['sound-5-1', 'sound-5-1', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0191_sound-5-1.jpg'],
                    ['sound-6-1', 'sound-6-1', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0192_sound-6-1.jpg'],
                    ['sound-7-1', 'sound-7-1', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0193_sound-7-1.jpg'],
                    ['copyright-mark', 'copyright-mark', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0194_copyright-mark.jpg'],
                    ['registration-mark', 'registration-mark', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0195_registration-mark.jpg'],
                    ['cloud-download', 'cloud-download', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0196_cloud-download.jpg'],
                    ['cloud-upload', 'cloud-upload', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0197_cloud-upload.jpg'],
                    ['tree-conifer', 'tree-conifer', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0198_tree-conifer.jpg'],
                    ['tree-deciduous', 'tree-deciduous', 'EXT:bootstrap_package/Resources/Public/Images/Icons/icon-shapes_0199_tree-deciduous.jpg'],
                ],
            ],
        ],
        'icon_position' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_position',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.left', 'left'],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.right', 'right'],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.top', 'top'],
                ],
            ],
        ],
        'icon_type' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => '0',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default', 0],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.square', 1],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.circle', 2],
                ],
            ],
        ],
        'icon_size' => [
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_size',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.default', 0],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.medium', 1],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.large', 2],
                    ['LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:option.awesome', 3],
                ],
            ],
        ],
        'icon_color' => [
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_color',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#FFFFFF',
                'wizards' => [
                    'colorChoice' => [
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => [
                            'name' => 'wizard_colorpicker'
                        ],
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
        'icon_background' => [
            'displayCond' => 'FIELD:icon_type:!=:0',
            'label' => 'LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:field.icon_background',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim',
                'default' => '#333333',
                'wizards' => [
                    'colorChoice' => [
                        'type' => 'colorbox',
                        'title' => 'LLL:EXT:lang/locallang_wizards:colorpicker_title',
                        'module' => [
                            'name' => 'wizard_colorpicker'
                        ],
                        'dim' => '20x20',
                        'JSopenParams' => 'height=600,width=380,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ],
        ],
    ]
);
