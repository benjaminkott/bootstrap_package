##################
#### ADMPANEL ####
##################
admPanel {
    enable {
        preview = 1
        cache = 1
        publish = 1
        edit = 1
        info = 1
    }
    hide = 1
}


#################
#### TCEMAIN ####
#################
TCEMAIN {
    permissions {
        groupid = 1
        user = show, editcontent, edit, new, delete
        group = show, editcontent, edit, new, delete
        everybody = 
    }
    translateToHidden = 1
    clearCacheCmd = all
}


#################
#### TCEFORM ####
#################
TCEFORM {
    pages {
        layout.disabled = 1
    }
    tt_content {
        header_layout {
            altLabels {
                1 = H1
                2 = H2
                3 = H3
                4 = H4
                5 = H5
            }
        }
        layout {
            removeItems = 1,2,3
            disableNoMatchingValueElement = 1
            types {
                bullets {
                    removeItems = 0,1,2,3
                    addItems {
                        100 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:listlayout.unordered
                        110 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:listlayout.ordered
                        120 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:listlayout.unstyled
                        130 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:listlayout.inline
                    }
                }
                table {
                    removeItems = 0,1,2,3
                    addItems {
                        100 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.default
                        110 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.basic
                        120 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.striped
                        130 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.bordered
                        140 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.hover
                        150 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:tablelayout.condensed
                    }
                }
                uploads {
                    removeItems = 3
                    altLabels {
                        0 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:uploadslayout.default
                        1 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:uploadslayout.icons
                        2 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:uploadslayout.iconsandpreview
                    }
                }
                bootstrap_package_carousel {
                    removeItems = 0,1,2,3
                    addItems {
                        100 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousellayout.default
                        110 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:carousellayout.small
                    }
                }
                bootstrap_package_panel {
                    removeItems = 0,1,2,3
                    addItems {
                        100 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.default
                        110 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.primary
                        120 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.success
                        130 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.info
                        140 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.warning
                        150 = LLL:EXT:bootstrap_package/Resources/Private/Language/Backend.xlf:contextualalternatives.danger
                    }
                }
            }
        }
        imagecols {
            removeItems = 5,7,8
        }
        menu_type {
            addItems {
                news = Display Subpages as News Entries
            }
        }
        section_frame {
            removeItems = 1
            addItems {
            }
            altLabels {
                20 = Well 
                21 = Jumbotron
            }
            types {
                bootstrap_package_carousel {
                    removeItems = 1,5,6,10,11,12,20,21
                }
            }
            disableNoMatchingValueElement = 1
        }

        // NOBODY wants or should edit this - really, let them disappear
        table_bgColor.disabled = 1
        table_border.disabled = 1
        table_cellspacing.disabled = 1
        table_cellpadding.disabled = 1
        pi_flexform {
            table {
                sDEF {
                    acctables_nostyles.disabled = 1
                    acctables_tableclass.disabled = 1
                }
            }
        }
    }
}


#############
#### RTE ####
#############
RTE {

    // Default RTE configuration (all tables)
    default {

        // Default target for links
        defaultLinkTarget = _top

        // Buttons to show
        showButtons = *

        // Toolbar order
        toolbarOrder = formatblock, blockstyle, textstyle, linebreak, bold, italic, underline, strikethrough, bar, orderedlist, unorderedlist, bar, left, center, right, copy, cut, paste, bar, undo, redo, removeformat, bar, link, unlink, linkcreator, bar, imageeditor, bar, line, insertparagraphbefore, insertparagraphafter, bar, chMode

        RTEHeightOverride = 700
        RTEWidthOverride = 700

        //hide / show HTML tag
        buttons.formatblock.orderItems = h1, h2, h3, h4, h5, h6, p, quotation
        buttons.textstyle.tags.span.allowedClasses >
        buttons.textstyle.tags.REInlineTags >
        buttons.textstyle.REInlineTags >
        buttons.blockstyle.tags.table.allowedClasses >
        buttons.left.useClass = text-left
        buttons.center.useClass = text-center
        buttons.right.useClass = text-right

        // Disable contextual menu
        contextMenu.disabled = 1
        showStatusBar = 1
        contentCSS = typo3conf/ext/bootstrap_package/Resources/Public/Css/rte.css
        removeTagsAndContents =
        useCSS = 1

        // Processing rules
        proc {

            allowedClasses  < RTE.default.classesCharacter
            overruleMode = ts_css
            dontConvBRtoParagraph = 1
            remapParagraphTag = p
            allowTags = a, abbr, acronym, address, blockquote, b, br, caption, cite, code, div, em, font, h1, h2, h3, h4, h5, h6, hr, i, img, li, link, ol, p, pre, q, sdfield, span, strike, strong, sub, sup, u, ul
            denyTags >
            keepPDIVattribs = xml:lang,class,style,align
            allowTagsOutside = img,hr,h1,h2,h3,h4,h5,h6,br,ul,ol,li,pre,address,span,blockquote
            allowTagsInTypolists = br,font,b,i,u,a,img,span
            dontRemoveUnknownTags_db = 1
            preserveTables = 0

            entryHTMLparser_db = 1
            entryHTMLparser_db {
                allowTags < RTE.default.proc.allowTags
                denyTags >
                htmlSpecialChars = 0
                tags.img >
                tags.div.allowedAttribs = class,style,align
                tags.p.allowedAttribs = class,style,align
                removeTags = center, font, o:p, sdfield, strike, u
                keepNonMatchedTags = protect
            }
            HTMLparser_db {
                noAttrib = br
                xhtml_cleaning = 1
            }
            exitHTMLparser_db = 1
            exitHTMLparser_db {
                tags.b.remap = strong
                tags.i.remap = em
                keepNonMatchedTags = 1
                htmlSpecialChars = 0
            }

        }
    }
}

// Frontend RTE configuration
RTE.default.FE < RTE.default