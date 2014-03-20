<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}

$TCA['__bootstrappackage_form_style'] = array(
    'ctrl' => $TCA['__bootstrappackage_form_style']['ctrl'],
    'columns' => array(

    ),
    'types' => array(
        '1' => array('showitem' => '
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.basics,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.colorsystem;colorsystem,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.bodyscaffolding;bodyscaffolding,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.genericfontvariables;genericfontvariables,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.basetypestyles;basetypestyles,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.headingfontsizes;headingfontsizes,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.headings;headings,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.type;type,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.icons;icons,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.codeblocks;codeblocks,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.padding;padding,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.roundedcorners;roundedcorners,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.componentactivestate;componentactivestate,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.carets;carets,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.mediaqueriesbreakpoints;mediaqueriesbreakpoints,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.layoutandgridsystem;layoutandgridsystem,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.close;close,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.other;other,

            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttons,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonsbasic;buttonsbasic,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonsdefault;buttonsdefault,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonssuccess;buttonssuccess,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonsprimary;buttonsprimary,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonswarning;buttonswarning,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonsinfo;buttonsinfo,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.buttonsdanger;buttonsdanger,

            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.states,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.statesuccess;statesuccess,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.statedanger;statedanger,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.statewarning;statewarning,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.stateinfo;stateinfo,

            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alerts,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alertsbasestyles;alertsbasestyles,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alertswarning;alertswarning,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alertsdanger;alertsdanger,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alertssuccess;alertssuccess,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.alertsinfo;alertsinfo,
            
            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panels,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelsbasic;panelsbasic,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelsdefault;panelsdefault,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelsinfo;panelsinfo,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelsprimary;panelsprimary,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelswarning;panelswarning,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelssuccess;panelssuccess,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.panelsdanger;panelsdanger,

            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.components,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.tables;tables,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.inputs;inputs,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.inputstates;inputstates,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.inputgroups;inputgroups,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.legend;legend,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.dropdownmenu;dropdownmenu,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.dropdownitems;dropdownitems,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.wells;wells,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.badgestyles;badgestyles,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.badgestates;badgestates,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.jumbotron;jumbotron,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.modal;modal,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.carousel;carousel,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.listgroup;listgroup,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.thumbnail;thumbnail,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.progressbars;progressbars,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.labels;labels,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.tooltip;tooltip,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.popover;popover,

            --div--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navigation,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navbarbasic;navbarbasic,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navbardefault;navbardefault,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navbarinverted;navbarinverted,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navbasic;navbasic,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navpills;navpills,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.navtabs;navtabs,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.breadcrumbs;breadcrumbs,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.pagination;pagination,
            --palette--;LLL:EXT:bootstrap_package/Resources/Private/Language/ThemeSettings.xlf:theme.group.pager;pager,            
        '),
    ),
    'palettes' => array(               
        'colorsystem' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                brand-primary,
                brand-danger,
                --linebreak--,
                brand-success,
                brand-info,
                --linebreak--,
                brand-warning,
            '
        ),
        'bodyscaffolding' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                body-bg,
                link-color,
                --linebreak--,
                text-color,
                link-hover-color,
            '
        ),
        'genericfontvariables' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                font-family-sans-serif,--linebreak--,
                font-family-serif,--linebreak--,
                font-family-monospace,
            '
        ),
        'basetypestyles' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                font-family-base,--linebreak--,
                font-size-base,--linebreak--,
                line-height-base,--linebreak--,
                line-height-large,--linebreak--,
                line-height-small,
            '
        ),
        'headingfontsizes' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                font-size-h1,--linebreak--,
                font-size-h2,--linebreak--,
                font-size-h3,--linebreak--,
                font-size-h4,--linebreak--,
                font-size-h5,--linebreak--,
                font-size-h6,
            '
        ),
        'headings' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                headings-font-family,
                headings-line-height,--linebreak--,
                headings-font-weight,
                headings-color,
            '
        ),
        'codeblocks' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                pre-color,
                code-color,--linebreak--,
                pre-bg,
                code-bg,--linebreak--,
                pre-border-color,
            '
        ),
        'mediaqueriesbreakpoints' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                screen-xs,
                screen-sm,
                screen-md,
                screen-lg,
            '
        ),
        'layoutandgridsystem' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                container-tablet,
                container-desktop,
                container-large-desktop,--linebreak--,
                grid-columns,
                grid-gutter-width,
                grid-float-breakpoint,
            '
        ),
        'padding' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                padding-base-vertical,
                padding-base-horizontal,--linebreak--,
                padding-large-vertical,
                padding-large-horizontal,--linebreak--,
                padding-small-vertical,
                padding-small-horizontal,--linebreak--,
                padding-xs-vertical,
                padding-xs-horizontal,
            '
        ),
        'roundedcorners' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                border-radius-base,
                border-radius-large,
                border-radius-small,
            '
        ),
        'componentactivestate' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                component-active-color,
                component-active-bg,
            '
        ),
        'carets' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                caret-width-base,
                caret-width-large,
            '
        ),
        'buttonsbasic' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-font-weight,
                btn-link-disabled-color,                
            '
        ),
        'buttonsdefault' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-default-color,
                btn-default-bg,
                btn-default-border,               
            '
        ),
        'buttonssuccess' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-success-color,
                btn-success-bg,
                btn-success-border,             
            '
        ),
        'buttonsprimary' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-primary-color,
                btn-primary-bg,
                btn-primary-border,          
            '
        ),
        'buttonswarning' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-warning-color,
                btn-warning-bg,
                btn-warning-border,        
            '
        ),
        'buttonsinfo' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-info-color,
                btn-info-bg,
                btn-info-border,       
            '
        ),
        'buttonsdanger' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                btn-danger-color,
                btn-danger-bg,
                btn-danger-border,    
            '
        ),
        'statesuccess' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                state-success-text,
                state-success-bg,--linebreak--,
                state-success-border,
            '
        ),
        'statedanger' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                state-danger-text,
                state-danger-bg,--linebreak--,
                state-danger-border,
            '
        ),
        'statewarning' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                state-warning-text,
                state-warning-bg,--linebreak--,
                state-warning-border,
            '
        ),
        'stateinfo' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                state-info-text,
                state-info-bg,--linebreak--,
                state-info-border,
            '
        ),
        'alertsbasestyles' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                alert-padding,
                alert-border-radius,
                alert-link-font-weight,
            '
        ),
        'alertswarning' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                alert-warning-bg,
                alert-warning-text,
                alert-warning-border,
            '
        ),
        'alertsdanger' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                alert-danger-bg,
                alert-danger-text,
                alert-danger-border,
            '
        ),
        'alertssuccess' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                alert-success-bg,
                alert-success-text,
                alert-success-border,
            '
        ),
        'alertsinfo' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                alert-info-bg,
                alert-info-text,
                alert-info-border,
            '
        ),
        'tables' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                table-cell-padding,
                table-bg,
                table-bg-hover,--linebreak--,
                table-condensed-cell-padding,
                table-bg-accent,
                table-border-color,
            '
        ),
        'inputs' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                input-color,
                input-border,
                input-color-placeholder,--linebreak--,
                input-bg,
                input-border-radius,
            '
        ),
        'inputstates' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                input-border-focus,
                input-bg-disabled,
            '
        ),
        'inputgroups' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                input-group-addon-bg,
                input-group-addon-border-color,
            '
        ),
        'legend' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                legend-color,
                legend-border-color,
            '
        ),
        'dropdownmenu' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                dropdown-bg,--linebreak--,
                dropdown-border,
                dropdown-fallback-border,--linebreak--,
                dropdown-divider-bg,
                dropdown-header-color,                
            '
        ),
        'dropdownitems' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                dropdown-link-color,--linebreak--,
                dropdown-link-hover-color,
                dropdown-link-hover-bg,--linebreak--,
                dropdown-link-active-color,
                dropdown-link-active-bg,--linebreak--,
                dropdown-link-disabled-color,
            '
        ),
        'panelsbasic' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-bg,
                panel-body-padding,--linebreak--,
                panel-inner-border,
                panel-border-radius,--linebreak--,
                panel-footer-bg,
            '
        ),
        'panelsdefault' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-default-text,
                panel-default-border,
                panel-default-heading-bg,
            '
        ),
        'panelsinfo' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-info-text,
                panel-info-border,
                panel-info-heading-bg,
            '
        ),
        'panelsprimary' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-primary-text,
                panel-primary-border,
                panel-primary-heading-bg,
            '
        ),
        'panelswarning' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-warning-text,
                panel-warning-border,
                panel-warning-heading-bg,
            '
        ),
        'panelssuccess' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-success-text,
                panel-success-border,
                panel-success-heading-bg,
            '
        ),
        'panelsdanger' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                panel-danger-text,
                panel-danger-border,
                panel-danger-heading-bg,
            '
        ),
        'wells' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                well-bg,
                well-border,
            '
        ),
        'badgestyles' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                badge-font-weight,
                badge-bg,
                badge-border-radius,--linebreak--,
                badge-color,
            '
        ),
        'badgestates' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                badge-link-hover-color,
                badge-active-color,
                badge-active-bg,
            '
        ),
        'breadcrumbs' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                breadcrumb-padding-horizontal,
                breadcrumb-padding-vertical,--linebreak--,
                breadcrumb-bg,
                breadcrumb-color,--linebreak--,
                breadcrumb-active-color,
                breadcrumb-separator,
            '
        ),
        'jumbotron' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                jumbotron-padding,
                jumbotron-color,--linebreak--,
                jumbotron-bg,
                jumbotron-heading-color,--linebreak--,
                jumbotron-font-size,
            '
        ),
        'modal' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                modal-inner-padding,
                modal-backdrop-bg,--linebreak--,
                modal-title-padding,
                modal-title-line-height,--linebreak--,
                modal-header-border-color,
                modal-footer-border-color,--linebreak--,
                modal-content-bg,
                modal-content-border-color,--linebreak--,
                modal-content-fallback-border-color,--linebreak--,
                modal-backdrop-opacity,--linebreak--,
                modal-lg,
                modal-md,
                modal-sm,
            '
        ),
        'carousel' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                carousel-text-shadow,
                carousel-control-color,
                carousel-caption-color,--linebreak--,
                carousel-indicator-border-color,
                carousel-indicator-active-bg,--linebreak--,
                carousel-control-width,
                carousel-control-opacity,
                carousel-control-font-size,                
            '
        ),
        'listgroup' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                list-group-bg,
                list-group-border,
                list-group-border-radius,--linebreak--,
                list-group-hover-bg,--linebreak--,
                list-group-active-color,
                list-group-active-bg,
                list-group-active-border,--linebreak--,
                list-group-link-color,
                list-group-link-heading-color,
            '
        ),
        'thumbnail' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                thumbnail-padding,
                thumbnail-bg,--linebreak--,
                thumbnail-border,
                thumbnail-border-radius,--linebreak--,
                thumbnail-caption-color,
                thumbnail-caption-padding,
            '
        ),
        'progressbars' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                progress-bg,
                progress-bar-color,
                progress-bar-bg,--linebreak--,
                progress-bar-success-bg,
                progress-bar-warning-bg,--linebreak--,
                progress-bar-danger-bg,
                progress-bar-info-bg,
            '
        ),
        'pagination' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                pagination-color,
                pagination-bg,
                pagination-border,--linebreak--,
                pagination-hover-color,
                pagination-hover-bg,
                pagination-hover-border,--linebreak--,
                pagination-active-color,
                pagination-active-bg,
                pagination-active-border,--linebreak--,
                pagination-disabled-color,
                pagination-disabled-bg,
                pagination-disabled-border,
            '
        ),
        'pager' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                pager-bg,
                pager-border,
                pager-border-radius,--linebreak--,
                pager-hover-bg,
                pager-active-bg,
                pager-active-color,--linebreak--,
                pager-disabled-color,
            '
        ),
        'labels' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                label-color,
                label-link-hover-color,
                label-default-bg,--linebreak--,
                label-primary-bg,
                label-success-bg,
                label-info-bg,--linebreak--,
                label-warning-bg,
                label-danger-bg,                
            '
        ),
        'tooltip' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                tooltip-color,
                tooltip-arrow-width,
                tooltip-max-width,--linebreak--,
                tooltip-bg,
                tooltip-arrow-color,
            '
        ),
        'popover' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                popover-bg,
                popover-border-color,
                popover-title-bg,--linebreak--,
                popover-max-width,
                popover-fallback-border-color,--linebreak--,
                popover-arrow-width,
                popover-arrow-color,--linebreak--,
                popover-arrow-outer-width,
                popover-arrow-outer-color,
                popover-arrow-outer-fallback-color,
            '
        ),
        'icons' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                icon-font-path,
                icon-font-name,
            '
        ),
        'type' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                text-muted,
                abbr-border-color,--linebreak--,
                headings-small-color,
                blockquote-small-color,--linebreak--,
                blockquote-border-color,
                blockquote-font-size,--linebreak--,
                page-header-border-color,
            '
        ),
        'close' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                close-font-weight,
                close-color,
                close-text-shadow,
            '
        ),
        'other' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                hr-border,
                component-offset-horizontal,--linebreak--,
                kbd-color,
                kbd-bg,
            '
        ),
        'navbarbasic' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                navbar-height,
                navbar-padding-horizontal,--linebreak--,
                navbar-margin-bottom,
                navbar-padding-vertical,--linebreak--,
                navbar-border-radius,
                navbar-collapse-max-height,--linebreak--,
            '
        ),
        'navbardefault' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                navbar-default-color,
                navbar-default-bg,--linebreak--,
                navbar-default-border,--linebreak--,
                navbar-default-link-color,--linebreak--,
                navbar-default-link-hover-color,
                navbar-default-link-hover-bg,--linebreak--,
                navbar-default-link-active-color,
                navbar-default-link-active-bg,--linebreak--,
                navbar-default-link-disabled-color,
                navbar-default-link-disabled-bg,--linebreak--,
                navbar-default-brand-color,--linebreak--,
                navbar-default-brand-hover-color,
                navbar-default-brand-hover-bg,--linebreak--,
                navbar-default-toggle-hover-bg,--linebreak--,
                navbar-default-toggle-icon-bar-bg,--linebreak--,
                navbar-default-toggle-border-color,--linebreak--,
            '
        ),
        'navbarinverted' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                navbar-inverse-color,
                navbar-inverse-bg,--linebreak--,
                navbar-inverse-border,--linebreak--,
                navbar-inverse-link-color,--linebreak--,
                navbar-inverse-link-hover-color,
                navbar-inverse-link-hover-bg,--linebreak--,
                navbar-inverse-link-active-color,
                navbar-inverse-link-active-bg,--linebreak--,
                navbar-inverse-link-disabled-color,
                navbar-inverse-link-disabled-bg,--linebreak--,
                navbar-inverse-brand-color,--linebreak--,
                navbar-inverse-brand-hover-color,
                navbar-inverse-brand-hover-bg,--linebreak--,
                navbar-inverse-toggle-hover-bg,--linebreak--,
                navbar-inverse-toggle-icon-bar-bg,--linebreak--,
                navbar-inverse-toggle-border-color,--linebreak--,
            '
        ),
        'navbasic' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                nav-link-padding,
                nav-link-hover-bg,--linebreak--,
                nav-disabled-link-color,
                nav-disabled-link-hover-color,--linebreak--,
                nav-open-link-hover-color,
            '
        ),
        'navpills' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                nav-pills-border-radius,--linebreak--,
                nav-pills-active-link-hover-bg,
                nav-pills-active-link-hover-color,
            '
        ),
        'navtabs' => array(
            'canNotCollapse' => 1,
            'showitem' => '
                nav-tabs-border-color,--linebreak--,
                nav-tabs-link-hover-border-color,--linebreak--,
                nav-tabs-active-link-hover-bg,
                nav-tabs-active-link-hover-color,--linebreak--,
                nav-tabs-active-link-hover-border-color,--linebreak--,
                nav-tabs-justified-link-border-color,
                nav-tabs-justified-active-link-border-color,
            '
        ),
    ),
);


$defaultInputFields = '
    progress-bar-success-bg,
    progress-bar-warning-bg,
    progress-bar-danger-bg,
    progress-bar-info-bg,
    gray-darker,
    gray-dark,
    gray,
    gray-light,
    gray-lighter,
    brand-primary,
    brand-success,
    brand-warning,
    brand-danger,
    brand-info,
    body-bg,
    text-color,
    link-color,
    link-hover-color,
    font-family-sans-serif,
    font-family-serif,
    font-family-monospace,
    font-family-base,
    font-size-base,
    font-size-large,
    font-size-small,
    font-size-h1,
    font-size-h2,
    font-size-h3,
    font-size-h4,
    font-size-h5,
    font-size-h6,
    line-height-base,
    line-height-computed,
    headings-font-family,
    headings-font-weight,
    headings-line-height,
    headings-color,
    icon-font-path,
    icon-font-name,
    line-height-large,
    line-height-small,
    component-active-color,
    component-active-bg,
    caret-width-base,
    caret-width-large,
    dropdown-bg,
    dropdown-border,
    dropdown-fallback-border,
    dropdown-divider-bg,
    dropdown-link-color,
    dropdown-link-hover-color,
    dropdown-link-hover-bg,
    dropdown-link-active-color,
    dropdown-link-active-bg,
    dropdown-link-disabled-color,
    dropdown-header-color,
    zindex-navbar,
    zindex-dropdown,
    zindex-popover,
    zindex-tooltip,
    zindex-navbar-fixed,
    zindex-modal-background,
    zindex-modal,
    navbar-height,
    navbar-margin-bottom,
    navbar-border-radius,
    navbar-padding-horizontal,
    navbar-padding-vertical,
    navbar-collapse-max-height,
    navbar-default-color,
    navbar-default-bg,
    navbar-default-border,
    navbar-default-link-color,
    navbar-default-link-hover-color,
    navbar-default-link-hover-bg,
    navbar-default-link-active-color,
    navbar-default-link-active-bg,
    navbar-default-link-disabled-color,
    navbar-default-link-disabled-bg,
    navbar-default-brand-color,
    navbar-default-brand-hover-color,
    navbar-default-brand-hover-bg,
    navbar-default-toggle-hover-bg,
    navbar-default-toggle-icon-bar-bg,
    navbar-default-toggle-border-color,
    navbar-inverse-color,
    navbar-inverse-bg,
    navbar-inverse-border,
    navbar-inverse-link-color,
    navbar-inverse-link-hover-color,
    navbar-inverse-link-hover-bg,
    navbar-inverse-link-active-color,
    navbar-inverse-link-active-bg,
    navbar-inverse-link-disabled-color,
    navbar-inverse-link-disabled-bg,
    navbar-inverse-brand-color,
    navbar-inverse-brand-hover-color,
    navbar-inverse-brand-hover-bg,
    navbar-inverse-toggle-hover-bg,
    navbar-inverse-toggle-icon-bar-bg,
    navbar-inverse-toggle-border-color,
    nav-link-padding,
    nav-link-hover-bg,
    nav-disabled-link-color,
    nav-disabled-link-hover-color,
    nav-open-link-hover-color,
    nav-tabs-border-color,
    nav-tabs-link-hover-border-color,
    nav-tabs-active-link-hover-bg,
    nav-tabs-active-link-hover-color,
    nav-tabs-active-link-hover-border-color,
    nav-tabs-justified-link-border-color,
    nav-tabs-justified-active-link-border-color,
    nav-pills-border-radius,
    nav-pills-active-link-hover-bg,
    nav-pills-active-link-hover-color,
    jumbotron-padding,
    jumbotron-color,
    jumbotron-bg,
    jumbotron-heading-color,
    jumbotron-font-size,
    state-success-text,
    state-success-bg,
    state-success-border,
    state-info-text,
    state-info-bg,
    state-info-border,
    state-warning-text,
    state-warning-bg,
    state-warning-border,
    state-danger-text,
    state-danger-bg,
    state-danger-border,
    panel-bg,
    panel-body-padding,
    panel-inner-border,
    panel-border-radius,
    panel-footer-bg,
    thumbnail-padding,
    thumbnail-bg,
    thumbnail-border,
    thumbnail-border-radius,
    thumbnail-caption-color,
    thumbnail-caption-padding,
    breadcrumb-padding-horizontal,
    breadcrumb-padding-vertical,
    breadcrumb-bg,
    breadcrumb-color,
    breadcrumb-active-color,
    breadcrumb-separator,
    code-color,
    code-bg,
    kbd-color,
    kbd-bg,
    pre-bg,
    pre-color,
    pre-border-color,
    pre-scrollable-max-height,
    text-muted,
    abbr-border-color,
    headings-small-color,
    blockquote-small-color,
    blockquote-border-color,
    blockquote-font-size,
    page-header-border-color,
    hr-border,
    component-offset-horizontal,
';
$defaultInputFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $defaultInputFields);
foreach($defaultInputFields as $field){
    $TCA['__bootstrappackage_form_style']['columns'][$field] = array(
        'exclude' => 0,
        'label' => '@'.$field,
        'config' => array(
            'type' => 'input',
            'size' => 32,
            'eval' => 'trim,required'
        ),
    );
}


$defaultMediumInputFields = '
    close-font-weight,
    close-color,
    close-text-shadow,
    tooltip-max-width,
    tooltip-color,
    tooltip-bg,
    tooltip-arrow-width,
    tooltip-arrow-color,
    popover-bg,
    popover-max-width,
    popover-border-color,
    popover-fallback-border-color,
    popover-title-bg,
    popover-arrow-width,
    popover-arrow-color,
    popover-arrow-outer-width,
    popover-arrow-outer-color,
    popover-arrow-outer-fallback-color,
    label-default-bg,
    label-primary-bg,
    label-success-bg,
    label-info-bg,
    label-warning-bg,
    label-danger-bg,
    label-color,
    label-link-hover-color,
    pagination-color,
    pagination-bg,
    pagination-border,
    pagination-hover-color,
    pagination-hover-bg,
    pagination-hover-border,
    pagination-active-color,
    pagination-active-bg,
    pagination-active-border,
    pagination-disabled-color,
    pagination-disabled-bg,
    pagination-disabled-border,
    pager-bg,
    pager-border,
    pager-border-radius,
    pager-hover-bg,
    pager-active-bg,
    pager-active-color,
    pager-disabled-color,
    progress-bg,
    progress-bar-color,
    progress-bar-bg,
    list-group-bg,
    list-group-border,
    list-group-border-radius,
    list-group-hover-bg,
    list-group-active-color,
    list-group-active-bg,
    list-group-active-border,
    list-group-link-color,
    list-group-link-heading-color,
    carousel-text-shadow,
    carousel-control-color,
    carousel-control-width,
    carousel-control-opacity,
    carousel-control-font-size,
    carousel-indicator-active-bg,
    carousel-indicator-border-color,
    carousel-caption-color,
    modal-inner-padding,
    modal-title-padding,
    modal-title-line-height,
    modal-content-bg,
    modal-content-border-color,
    modal-content-fallback-border-color,
    modal-backdrop-bg,
    modal-header-border-color,
    modal-footer-border-color,
    modal-backdrop-opacity,
    modal-lg,
    modal-md,
    modal-sm,
    well-bg,
    well-border,
    badge-color,
    badge-link-hover-color,
    badge-bg,
    badge-active-color,
    badge-active-bg,
    badge-font-weight,
    badge-line-height,
    badge-border-radius,
    alert-padding,
    alert-border-radius,
    alert-link-font-weight,
    alert-success-bg,
    alert-success-text,
    alert-success-border,
    alert-info-bg,
    alert-info-text,
    alert-info-border,
    alert-warning-bg,
    alert-warning-text,
    alert-warning-border,
    alert-danger-bg,
    alert-danger-text,
    alert-danger-border,
    panel-default-text,
    panel-default-border,
    panel-default-heading-bg,
    panel-primary-text,
    panel-primary-border,
    panel-primary-heading-bg,
    panel-success-text,
    panel-success-border,
    panel-success-heading-bg,
    panel-warning-text,
    panel-warning-border,
    panel-warning-heading-bg,
    panel-danger-text,
    panel-danger-border,
    panel-danger-heading-bg,
    panel-info-text,
    panel-info-border,
    panel-info-heading-bg,
    padding-base-vertical,
    padding-base-horizontal,
    padding-large-vertical,
    padding-large-horizontal,
    padding-small-vertical,
    padding-small-horizontal,
    padding-xs-vertical,
    padding-xs-horizontal,
    border-radius-base,
    border-radius-large,
    border-radius-small,
    container-tablet,
    container-sm,
    container-desktop,
    container-md,
    container-large-desktop,
    container-lg,
    grid-columns,
    grid-gutter-width,
    grid-float-breakpoint,
    btn-font-weight,
    btn-default-color,
    btn-default-bg,
    btn-default-border,
    btn-primary-color,
    btn-primary-bg,
    btn-primary-border,
    btn-success-color,
    btn-success-bg,
    btn-success-border,
    btn-warning-color,
    btn-warning-bg,
    btn-warning-border,
    btn-danger-color,
    btn-danger-bg,
    btn-danger-border,
    btn-info-color,
    btn-info-bg,
    btn-info-border,
    btn-link-disabled-color,
    table-cell-padding,
    table-condensed-cell-padding,
    table-bg,
    table-bg-accent,
    table-bg-hover,
    table-bg-active,
    table-border-color,
    input-bg,
    input-bg-disabled,
    input-color,
    input-border,
    input-border-radius,
    input-border-focus,
    input-color-placeholder,
    input-height-base,
    input-height-large,
    input-height-small,
    legend-color,
    legend-border-color,
    input-group-addon-bg,
    input-group-addon-border-color,
';
$defaultMediumInputFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $defaultMediumInputFields);
foreach($defaultMediumInputFields as $field){
    $TCA['__bootstrappackage_form_style']['columns'][$field] = array(
        'exclude' => 0,
        'label' => '@'.$field,
        'config' => array(
            'type' => 'input',
            'size' => 19,
            'eval' => 'trim,required'
        ),
    );
}


$defaultSmallInputFields = '
    screen-xs,
    screen-xs-min,
    screen-phone,
    screen-sm,
    screen-sm-min,
    screen-tablet,
    screen-md,
    screen-md-min,
    screen-desktop,
    screen-lg,
    screen-lg-min,
    screen-lg-desktop,
    screen-xs-max,
    screen-sm-max,
    screen-md-max,
';
$defaultSmallInputFields = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $defaultSmallInputFields);
foreach($defaultSmallInputFields as $field){
    $TCA['__bootstrappackage_form_style']['columns'][$field] = array(
        'exclude' => 0,
        'label' => '@'.$field,
        'config' => array(
            'type' => 'input',
            'size' => 12,
            'eval' => 'trim,required'
        ),
    );
}