mod.wizards {
    newContentElement {
        wizardItems {
            bootstrap {
                header = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:theme_name
                elements {
                    bootstrap_package_carousel {
                        icon = gfx/c_wiz/regular_header.gif
                        title = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.carousel
                        description = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.carousel.description
                        tt_content_defValues {
                            CType = bootstrap_package_carousel
                        }
                    }
                    bootstrap_package_accordion {
                        icon = gfx/c_wiz/regular_header.gif
                        title = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.accordion
                        description = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.accordion.description
                        tt_content_defValues {
                            CType = bootstrap_package_accordion
                        }
                    }
                    bootstrap_package_panel {
                        icon = gfx/c_wiz/regular_header.gif
                        title = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.panel
                        description = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.panel.description
                        tt_content_defValues {
                            CType = bootstrap_package_panel
                        }
                    }
                    bootstrap_package_listgroup {
                        icon = gfx/c_wiz/regular_header.gif
                        title = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.listgroup
                        description = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:content_element.listgroup.description
                        tt_content_defValues {
                            CType = bootstrap_package_listgroup
                        }
                    }
                }
                show = *
            }
        }
    }
}