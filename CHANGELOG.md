# 7.1.1

## TASK
- [TASK] Update Less Parser 5947c041
- [TASK] Update bootstrap to 3.4.0 64ecbb66
- [TASK] Streamline changelog 39031e1e
- [TASK] Update npm dependencies 95698d5c
- [TASK] Disable php5.6 build, seems to be buggy on travis in combination with composer install 5609b751
- [TASK] Remove preferred install for typo3/cms a9a415a6
- [TASK] Downgrade php-cs-fixer version 880fff26
- [TASK] Update php-cs-fixer config 938db0b3
- [TASK] Update travis configuration d0d7f50c
- [TASK] Use youtube-nocookie url in external media utility c3a1b05b

## BUGFIX
- [BUGFIX] Replace codesniffer with php-cs-fixer 1dfc3c9a
- [BUGFIX] Correct texticon preview paths on windows 47743c63
- [BUGFIX] Correct less variable: @icon-font-path (#450) 3072d15b
- [BUGFIX] Add type to linkVars language parameter 5597daa4

# 7.1.0

## BREAKING
- [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356 d2b23d1f
- [!!!][TASK] Reintroduce "no frame" option - fixes #319 f2b06d7d
- [!!!][FEATURE] Add sections to visually group elements eedb60dc
- [!!!][FEATURE] Adjust make footer color configurable 9001189d
- [!!!][FEATURE] Add support for google webfonts - fixes #115 7d58ac63
- [!!!][FEATURE] Add support for spacer in menu processor - fixes #335 5d0a76cd

## FEATURE
- [FEATURE] Make language uids for menu configurable d07e219a
- [FEATURE] Add audio content element - fixes #399 c7ac13dd
- [FEATURE] Add preview for quote content element add8bc0d
- [FEATURE] rearrange settings for images and media assets (#395) 3c2ddf2c
- [FEATURE] Add signal to compile service - fixes #371 2b0e5772
- [FEATURE] Add quotation content element 1b528c48
- [FEATURE] Provide generated link and target from hmenu in menu resultset - fixes #380 0f206e87
- [FEATURE] Add smothscrolling and back to top link d5218b19
- [FEATURE] Add content element text with teaser 477a83e1
- [FEATURE] Add constant for absolute favicon path 41f2413a
- [FEATURE] Add subheader to carousel item header 9d54f211
- [FEATURE] Add stickyheader to overlay carousel ceaa9695
- [FEATURE] Add fullscreen variant of carousel b6518150
- [FEATURE] Add support for additional iconsets and ionicons - fixes #357 c5c6f615
- [FEATURE] Add header_link to the icon of text widh icon content element - fixes #154 b34960fa
- [FEATURE] Add meta navigation support 66c76500
- [FEATURE] Add marker for frontendurl 8f23e439
- [FEATURE] Add content element to display regular text in columns ef7bcf09
- [FEATURE] Allow html entities in carousel header f043d601
- [FEATURE] Colorize text selection in primary color 9430c1e9
- [FEATURE] Make imported font weights of google webfonts editable 37658b84
- [FEATURE] Add transition option to switch from fade to slide - #356 #347 7da14da1
- [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356 d2b23d1f
- [!!!][FEATURE] Add sections to visually group elements eedb60dc
- [!!!][FEATURE] Adjust make footer color configurable 9001189d
- [!!!][FEATURE] Add support for google webfonts - fixes #115 7d58ac63
- [!!!][FEATURE] Add support for spacer in menu processor - fixes #335 5d0a76cd
- [FEATURE] Add content element for vimeo and youtube videos d36a8b22
- [FEATURE] Clear less cache when all caches are cleared ad695e01

## TASK
- [TASK] Optimize html output 63fa499f
- [TASK] Update dependencies bcfd9ef1
- [TASK] Add instruction to clear initial TypoScript (#420) 5cd45254
- [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 93e55e84
- [TASK] Update changelog schema 82be428f
- [TASK] Optimize travis and composer configuration for automatic ter uploading ad98cd53
- [TASK] Add TYPO3 8 dev-master to issue template 6deb2785
- [TASK] Add GitHub pull request template 0bb032e0
- [TASK] Add GitHub issue template 722b4426
- [TASK] remove uniqueLinkVars (#407) 7e79b774
- [REVERT][TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 4921d82a
- [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 7537983c
- [TASK] Streamline php_cs fixer configuration with TYPO3 core fb6467b2
- [TASK] Add checks for TYPO3_MODE to all tca override files configuration files 60beeb92
- [TASK] Throw exception if invalid arguments are passed to menu processor 8979cb4c
- [TASK] Drop IE8 and IE9 support for background images in carousel 53ea6d26
- [TASK] Always trim assigned variables in var viewhelper 62e88701
- [TASK] Streamline position of columns for images and media to match textpic and textmedia af899668
- [TASK] Use shorthand array syntax in custom record tca b74db027
- [TASK] Do not set links bold in navigation bar 25797b05
- [TASK] Remove obsolete use statement 82e3c2a0
- [TASK] Update menu templates to use the generated links and targets from menuDataProcessor 9cfb3659
- [TASK] Replace f:link.page with static link (#370) 1ce0019d
- [TASK] Exclude fixed navbar from scrolling to anchor eae382e0
- [TASK] Add border between same sections 0946712d
- [TASK] Allow html entities for content element header f9920241
- [TASK] Remove obsolete constants b7b67d5a
- [TASK] Update modernizr to 3.3.1 15a6926d
- [TASK] Adjust section size 1fa43ee8
- [TASK] Move icon selector to new tab to have enough space for large icon sets - relates #357 19d15904
- [TASK] Move icon registration for text with icon to itemsProcFunc - relates #357 c43ab1ea
- [TASK] Remove unnessesary margin for last element in texticon content 1cb56ab9
- [TASK] Remove dependency to glyphicons in carousel control - relates #356 8b1ae0a3
- [TASK] Move carousel controls to partials - relates #356 9a573c1e
- [TASK] Adjust indentions 145e1645
- [TASK] Enable default and rename current to normal to ensure it can be overridden without removing the normal template 83baee48
- [!!!][TASK] Reintroduce "no frame" option - fixes #319 f2b06d7d
- [TASK] Correct indention according to PSR2 89cb1f8f
- [TASK] Do not exclude composer.json from export 7827744b
- [TASK] Add CType as class to outer content element frame 86306a43
- [TASK] Add scaling for text-icon 8f982e48
- [TASK] Scale headlines on smaller devices 2fff83a0
- [TASK] Use dataprocessors instead of viewhelpers for carousel rendering 468c5ad3
- [TASK] Scale margin of frames 148b159a
- [TASK] Move page class and id from section to bodytag 1740c475
- [TASK] Remove override for hover link decoration and use bootstrap variables instead - fixes #321 b714e05c
- [TASK] Split tt_content overrides cde7cf04
- [TASK] Optimize images 9ae55e7a
- [TASK] Use correct icons for tt_content imageorient palette - fixes #352 10c8ce0c
- [TASK] Remove bower from travis tests eb7036dd
- [TASK] Include photoswipe via npm instead of bower 96c2a40a
- [TASK] Include hammerjs via npm instead of bower 283fce82
- [TASK] Include bootstrap via npm instead of bower 9f8820d2
- [TASK] Update jquery to 2.2.4 389afc83
- [TASK] Update hammer.js to 2.0.8 cda5f1ee
- [TASK] Update grunt 6af9bbaa
- [TASK] Correct composer requirements for TYPO3 9a43942a
- [TASK] Remove unit tests from travis d5c20452
- [TASK] Fix Travis 2 374250e8
- [TASK] Add color option to phpunit for travis 000d0d83
- [TASK] Add typo3 unit tests to travis ad0828b1
- [TASK] Remove version from composer.json to prefer git tags dfe05c93
- [TASK] Adjust editorconfig b58e6299
- [TASK] Add changelog for release 7.0.0 b8fe3c75
- [TASK] Add missing changelog entries for 7.1.0 3ceaaf1e
- [TASK] Enable basic frontend editing 00d42a06
- [TASK] Add missing css fixes for #325 c49042da
- [TASK] Accessibility - fix of landmark error added role and aria- labelledby attribute c733ffdd
- [TASK] Accessabiliy - added role navigation to breadcrumb bef517e2
- [TASK] Accessibility - delete role contentinfo because you cant nest the same landmark in itself 9a5a6a8c
- [TASK] Accessibility - correction of landmark a2810cb2
- [TASK] Accessibility - Add link title attributes to logo constants, setup and html 2c9ee0e2
- [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options bf80fe37

## BUGFIX
- [BUGFIX] Add missing icon for text & media missing - fixes #417 ec643241
- [BUGFIX] Adapt link tag parsing for RTE fields 46697bdc
- [BUGFIX] Move class alias for menu processor to localconf to ensure correct loading a04a6c7f
- [BUGFIX] Ensure that variables are not converted to strings by variable viewhelper cdd2005d
- [BUGFIX] Use correct layout (#408) 72bb577c
- [BUGFIX] Correct position of carousel with fixed transparent header c0c3cc55
- [BUGFIX] Ensure that navbar-collapse has a maxheight if menu is fixed b698328f
- [BUGFIX] Enforce checkout with linux lf consistent over all plattforms 6886bc8e
- [BUGFIX] Respect show in section menus option for pages in section index menu 0dff0700
- [BUGFIX] Use smooth scroll only on elements that have an hash... (#398) a91373e8
- [BUGFIX] Move temp folder back to root of typo3 temp dd66961d
- [BUGFIX] Remove double imagecols field in showitem configuration 485ab966
- [BUGFIX] Workaround variable name cut off in CMS8 - fixes #388 b27d0173
- [BUGFIX] Use string to identify bootstrap_package for adding static template ed63827f
- [BUGFIX] Allow non ID values for language fields to avoid errors on mysql strict mode f46a6317
- [BUGFIX] Correct sql definitions for bodytextfields for carousel, accordion and tab content element item 4b855079
- [BUGFIX] Correct indention of sql definition 0645bb31
- [BUGFIX] Correct teaser sql field definition f1b42b47
- [BUGFIX] Move TCA change in ext_tables.php to Configuration/TCA/Overrides (#389) e0892160
- [BUGFIX] Avoid specific DBMS literals in database queries (#384) c0ba7863
- [BUGFIX] Fix inline documentation of MenuProcessor (#369) 64f98070
- [BUGFIX] Correct dependency for namelesscoder/typo3-repository-client bcddcaf5
- [BUGFIX] Correct positioning of carousel when header is fixed cc39afcc
- [BUGFIX] Correct case error in ionicons template 8ac31002
- [BUGFIX] Use correct less variable in font-family-base 9553484d
- [BUGFIX] Correct position of carousels on sticky header 566d1352
- [BUGFIX] Add missing active state to stickyheader 90fb0b24
- [BUGFIX] Correct navbar z-index in combination with fullscreen carousel in border column e6cc5ab5
- [BUGFIX] Ensure color for headlines is correclty inherited in footer sections 446435fe
- [BUGFIX] Correct output of texticon if no icon is selected aa388a27
- [BUGFIX] Ensure carousel headline color is inherited eb894e19
- [BUGFIX] Remove duplicate case in content element layout c2db0763
- [BUGFIX] Correct paragraph rte classes c04e2b02
- [BUGFIX] Fix tab elements missing on slided content ac12a519
- [BUGFIX] Fix carousel elements missing on slided content a994f777
- [BUGFIX] Fix accordion elements missing on slided content ddaab8b8
- [BUGFIX] Correct texticon content element rendering with default layout - fixes #336 5fb24e9d
- [BUGFIX] Correct PSR-2 issues 08f69947
- [BUGFIX] Tabs, Accordion, and Carousel Items not referencing files on sys_file_reference and sys_refindex - fixes #349 a39c6bb5
- [BUGFIX] Bugfix/menuprocessor (#354) 9413d781
- [BUGFIX] Prevent double escaping of menu titles 58824f97
- [BUGFIX] Remove vendor dir from php lint tests 63909ec4
- [BUGFIX] Load form configuration only if ext:form is installed e39df3fc
- [BUGFIX] Respect padding in equalheight script a8bb806f
- [BUGFIX] Correct overlapping of content elements with indention - fixes #325 9b16ef3f
- [BUGFIX] Corrected label for attribute 17bf663e
- [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options bf80fe37

## MISC
- "usind" is wrong 0459bd33
- Correct php-cs-fixer command 0a22336a

# 7.0.0

## BREAKING
- [!!!][TASK] Send cache headers per default 9b9f9452
- [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other 5ecadef4
- [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor 22d60c8b
- [!!!][TASK] Disable link to top bd62ef80
- [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts 1761622a
- [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default fe5b5b88
- [!!!][TASK] Drop IE8 support c9a9ffb5
- [!!!][FEATURE] Register optional PageTS config files e9caa18c
- [!!!][TASK] Remove some 6.2 specific fallbacks 8ade18a3
- [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4 569df457
- [!!!][TASK] Drop TemplateFileResolver fallback for 6.2 d70ee66d
- [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now dd81e0c1
- [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev 0bc14990

## FEATURE
- [FEATURE] Remaining PageTS templates are configurable 7806d37a
- [FEATURE] Allow to disable footer-section with Typoscript constant. 561cb0ed
- [FEATURE] Allow photoswipe to be opened by url params 317032be
- [FEATURE] Add PhotoSwipe as lightbox a00e0117
- [FEATURE] Thumbnail Menu b6bdc425
- [FEATURE] Include records without default translation in content select 9ffce33a
- [FEATURE] Allow media content in accordion a16b6255
- [FEATURE] Allow media content in tabs 9ccf082c
- [!!!][FEATURE] Register optional PageTS config files e9caa18c

## TASK
- [TASK] Set defaults for backend configuration 42001a96
- [TASK] Remove backend_layout upgrade wizard bdd51ada
- [TASK] Update hammerjs to 2.0.6 a2f2e591
- [TASK] Update jQuery to 2.2.1 977a9977
- [TASK] Update bootstrap to 3.3.6 fa1f19f3
- [TASK] Update oyejorge/less.php to 1.7.0.10 4a28bad3
- [TASK] Remove unneeded rte_transform options 070ad6cf
- [TASK] Optimize export b7012da5
- [TASK] Correct accordion rendering 444df863
- [TASK] Correct tab rendering when no media is selected f3a4be1d
- [TASK] Remove realurl autoconfiguration in preparation for realurl 2 b44a7983
- [TASK] Add TYPO3 branch for 7.6 and exclude php versions < 7 on master 34640fd5
- [TASK] Add php7 to travis 9f51a7e1
- [TASK] Fix typo 89906d1a
- [TASK] RTE: Classes for links, see benjaminkott#281 55c4a1e6
- [TASK] Add note to vagrant box 5ddf090a
- [!!!][TASK] Send cache headers per default 9b9f9452
- [TASK] Update jQuery to 2.2.0 bee69553
- [TASK] Test asset pipe on travis 91496d3d
- [TASK] Fix Code according to CGL 9a20304c
- [TASK] Add php cs fixer config a334f7fb
- [TASK] Add TYPO3 CMS 8 as compatible version ccbbd11d
- [TASK] Split source and distribution javascript files and use static paths 291e83bc
- [TASK] Adjust frontend login configuration 4182473c
- [TASK] Add basic configuration and template overrides for indexed_search 9bb70a91
- [TASK] Add notice about content rendering extensions 1a479e19
- [TASK] Add header palette to cType list 7d4cb61a
- [TASK] Use default layout as identifier when not backend_layout is selected fc228b00
- [TASK] Use use titlefield instead of raw data in menus - fixes #273 36b9428f
- [TASK] Add escaped class to example in lib.dynamicContent 0217d687
- [TASK] Use fluidtemplate for languagemenu rendering 35c2cedc
- [TASK] Use fluidtemplate for breadcrumb rendering 51b40492
- [TASK] Use fluidtemplate for mainnavigation rendering f3998640
- [TASK] Use fluidtemplate for subnavigation rendering a6b62f1d
- [TASK] Add configuration for felogin 57e2acc7
- [TASK] Remove unneeded typo3_mode check b772f398
- [TASK] Add textmedia content element aa91cb09
- [TASK] Add typoscript parse functions 7cb7fa1f
- [TASK] Add basic FluidTemplate for mailform and set paths abae4dc9
- [TASK] Add FluidTemplate for list 540e7df8
- [TASK] Add typoscript setup as content rendering template 9b06797e
- [TASK] Add FluidTemplate for shortcut bade03ab
- [TASK] Add description to menu processor d417401f
- [TASK] Add FluidTemplate for menus 37676d76
- [TASK] Move uploads to typical page content tab 0e4fe0b2
- [TASK] Remove unnessesary adjustment of the header palette 34483ee8
- [TASK] Remove leftover mention of css_styled_content cc096ca1
- [TASK] Add FluidTemplate for uploads content element 06f96ad3
- [TASK] Add TCA and wizard for content element div 40ceba9c
- [TASK] Add TCA and wizard for content element html 5e20f7f4
- [TASK] Add content element wizard items for table a2a3a120
- [TASK] Add FluidTemplate for table content element eee3c634
- [TASK] Add TCA for content element bullet list 47396322
- [TASK] Enable header position again 1257178d
- [TASK] Enable section frame again feaf2e3b
- [TASK] Add TCA for content element header fb6ba2aa
- [TASK] Add TCA for content element image dc99388d
- [TASK] Add content element wizard items for header, text, textpic 455cbdbe
- [TASK] Add TCA for content element textpic bd201a54
- [TASK] Add TCA for content element text 863c9fd9
- [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other 5ecadef4
- [TASK] Add case for tt_content rendering 2f6db377
- [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor 22d60c8b
- [TASK] Drop experimental OnePage setup b8281971
- [TASK] Flatten content element setup and add layouts and sections a110a615
- [TASK] Several adjustments ce1abd1b
- [TASK] Make css adjustments b9f023bb
- [TASK] Remove unnessesary column classes a7f894e5
- [TASK] Move section frames to fluid d5c1071d
- [!!!][TASK] Disable link to top bd62ef80
- [TASK] Add FluidTemplate for image content element ba7d160c
- [TASK] Flatten content element rendering b418c7fc
- [TASK] Steamline header usage templates 6e0a8823
- [TASK]  Add FluidTemplate for image content element bc5183e9
- [TASK]  Add FluidTemplate for textpic content element df93601d
- [TASK]  Add FluidTemplate for text content element c032f2c0
- [TASK]  Add FluidTemplate for header content element a43eb908
- [TASK]  Add FluidTemplate for bullets content element c39d30bb
- [TASK] Add FluidTemplate for html content element 5bbc988b
- [TASK] Remove dependency to styles.content.get definition 8aa6302a
- [TASK] Add FluidTemplate for divider content element c13ffdd2
- [TASK] Migrate reference to "wizard_element_browser" to new "wizard_link" - fixes #258 7f11f4d6
- [TASK] Harden template names for page module previews 3db17119
- [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts 1761622a
- [TASK] Use dataprocessing in listgroup content element 4fcbcbf1
- [TASK] Use fluid template name for panel content element 737797d3
- [TASK] Use fluid template name for list group content element f5c02601
- [TASK] Use fluid template name for external media content element 3fd77ae9
- [TASK] Use fluid template name for default content element 64142fc8
- [TASK] Use fluid template name for tab content element d370a037
- [TASK] Use fluid template name for carousel content element f3e9c385
- [TASK] Use fluid template name for accordion content element 5e2836f0
- [TASK] Move css_styled_content typoscript configuration 2c6bde2d
- [TASK] Extract lib.dynamicContent from Base.ts 174fa1be
- [TASK] Remove iconInOptionTags and noIconsBelowSelect - fixes #243 4c39c52e
- [TASK] Add preview for content element list-group 50242215
- [TASK] Reduce size of external media preview 729d4a8f
- [TASK] Update less.php to 1.7.0.9 4adf3956
- [TASK] Update jQuery to 2.1.4 f93cb034
- [TASK] Add recommended apache modules e42c4e60
- [TASK] Enable async loading for modernizr and windowsphone-fix 823460f9
- [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default fe5b5b88
- [!!!][TASK] Drop IE8 support c9a9ffb5
- [TASK] Harden expression in PreProcessHook 2f0d6693
- [TASK] Register content element listgroup icon f7954151
- [TASK] Register content element external-media icon 72c29292
- [TASK] Register icon for element accordion-item 500bf8e6
- [TASK] Adjust icons for element carousel-item types 73145e59
- [TASK] Register icons for element carousel-item types 13eb28dd
- [TASK] Register content element carousel icon 37c46b2b
- [TASK] Register content element accordion f66d935d
- [TASK] Register content element panel 3db5c2a4
- [TASK] Register content element texticon b4734d93
- [TASK] Register content element tab-item icon 92e017a3
- [TASK] Register content element tab icon 286d4418
- [TASK] Harden expression in ExternalMediaUtility bffb89b6
- [!!!][TASK] Remove some 6.2 specific fallbacks 8ade18a3
- [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4 569df457
- [!!!][TASK] Drop TemplateFileResolver fallback for 6.2 d70ee66d
- [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now dd81e0c1
- [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev 0bc14990
- [TASK] Add preview for external media content element in page module - CMS7 only e4bbd6ce
- [TASK] Keep additional params for youtube urls 8c96100a
- [TASK] Add psr-4 autoload config to ext_emconf 2a4aa973
- [TASK] add classes to containers useful to better select them with CSS and Javascript 8ef1ecdd
- [TASK] fix tag closure for HTML5 head meta and link 1a007489
- [TASK] breadcrumb: include the homepage link at the beginning of the breadcrumb. b7511944
- [TASK] breadcrumb: for the content of the links use alternative navigation title if it is set, else use page title. 4e01a9e4

## BUGFIX
- [BUGFIX] Remove skin setting from RTE configuration to ensure correct file is loaded in cms 8 3a6d10a6
- [BUGFIX] Disable output escaping for viewhelpers c8b881a0
- [BUGFIX] Remove spaceless viewhelper cd18e0ee
- [BUGFIX] gallery in 2 cols also for devices >= 768px and < 992px be974578
- [BUGFIX] use the correct Typoscript constant in setup 3a5c5a79
- [BUGFIX] Correct grunt watch tasks 49abd2e5
- [BUGFIX] Add header to cType List 5c64e395
- [BUGFIX] Respect sorting for tab items 2f4d942f
- [BUGFIX] Respect sorting for accordion items 4e1895c3
- [BUGFIX] Correct PSR2  issue d2f3858f
- [BUGFIX] Add missing column overrides for text and textpic content elements 0e750f0f
- [BUGFIX] Check if content element type exists before merging f59acadd
- [BUGFIX] Merge type configuration in TCA instead of overriding fef0fc6e
- [BUGFIX] Add missing comma in uploads field selection 9a6506c1
- [BUGFIX] Correct accordion content element markup 3e87fca5
- [BUGFIX] Add missing showIconTable setting for field icon 142a0400
- [BUGFIX] Adjust imagepath and wizard settings for carousel links 003489f6
- [BUGFIX] Adapt moved language file b44bcf36
- [BUGFIX] Add missing renderTypes to tt_content fields 2bd94955
- [BUGFIX] Add missing renderTypes to tab item f460fa78
- [BUGFIX] Add missing renderTypes to accordion item 553f48f7
- [BUGFIX] Add missing renderTypes to carousel item 39ec0279
- [BUGFIX] Correct typoscript paths 534fa91e
- [BUGFIX] Add missing link for media type image in tabs 3ddad628
- [BUGFIX] Add missing link for media type image in accordion a9bf6dff
- [BUGFIX] Correct composer branch-alias 353e3b50
- [BUGFIX] Make links visible in jumbotron - fixes #248 9bf49a18
- [BUGFIX] Fix behaviour of strictly allowed RTE classes 3bef8e04
- [BUGFIX] Add the table colspan and rowspan attributes to allowed attributes in RTE configuration 46f24a1c
- [BUGFIX] Correct height operator for opengraph image - fixes #227 0da305fc

## MISC
- Fix more typos / grammar issues ce3f8df6
- Fix typos found by codespell 3b25d805
- Followup: Use spaces instead of tabs a50ed6e4
- Fix grammar 62ade32e
- Removed duplicate "List Group" entry 2edeebce
- add static to getVariablesFromConstants() because of deprecation notice b917eaef
- Add crop to carousel background image fbbe0cf9
- Use settings instead of variables for configuration in FLUIDTEMPLATE f0966b5a
- [WIP] Image rendering c596fd73
- [WIP] Adjust Tab Rendering 663af6aa
- [CLEANUP] Bootstrap Package external media item 01a006c8
- [CLEANUP] Bootstrap Package list group item 66e3090d
- [CLEANUP] Rendering definition for default content element ea5db05c
- [CLEANUP] Remove unused header partial bec55b68
- Add namespace to ext_update class 1c2db8b7
- Update constants.txt 6c19cf4b
- Update CssStyledContent.txt 57a6a177
- Add data-preload to force image preload fddd5e23
- Merge remote-tracking branch 'upstream/master' 3205507e
- [CLEANUP] Remove unused file 12e6e6e6
- [CLEANUP] Correct email in bower setup 09711654
- Merge remote-tracking branch 'upstream/master' into disable-meta-section e1df0753
- Add mod_filter to apache recommendations 7998c5bd
- [CLEANUP] Correct Readme 7cc4feee
- [CLEANUP] PSR-2 stuff f8475694
- [CLEANUP] Remove unused use statements in install service 1cb8469e
- [TROLL] Update copyright text fba18057
- [CLEANUP] Initialize fieldsToUpdate in ext_update 020bf697
- Merge remote-tracking branch 'upstream/master' into disable-meta-section b91e71d1
- [CLEANUP] Remove unused Hooks and Xclass 7f2b9d7a
- [CLEANUP] Remove TYPO3 6.2 and PHP5.3 and PHP5.4 from Travis CI 7897a86e
- [CLEANUP] Remove unused use statements in realurl autoconfig a75a0278
- bring metaSection enable setting to constants 83088bba
- Update setup.txt with default meta section enabled fb68e002
- change Footer.html to disable meta output 100a1084
- Fixed typos 2cf4e9ba
- Fixed typos aa88fbbc
- Correction of minor typo db95d9ab
- Force preload images to allow print 1b5581d8
- Add useful RTE buttons fbb6fa12

# 6.2.15

## TASK
- [TASK] Add travis-ci build status image 3e5f00f2
- [TASK] Remove unused coverage from travis f0ef2c5f
- [TASK] Add phpcs as dev dependency to composer.json 50d372c3
- [TASK] Remove TYPO3 dependencies and conflicts from composer.json 3dc0c1df
- [TASK] Add travis-ci support b103871a
- [TASK] Unify license comment 1737339c
- [TASK] Static declaration should come after the visibility declaration aaad7a4f
- [TASK] Apply PSR-2 a8a589e4
- [TASK] Add scrutinizer code style fixer for psr-2 023b9859
- [TASK] Convert tabs to spaces 2 42381a08
- [TASK] Convert tabs to spaces 82ee78a6
- [TASK] Add scrutinizer psr-2 settings 4dac59ff
- [TASK] Add braces in condition ab4dcafe
- [TASK] Add code quality section to readme e4e3e9b0
- [TASK] Add YML to editorconfig 82bae492
- [TASK] Add scrutinizer configuration 756f96ab
- [TASK] Change TYPO3 composer dependency to typo3-cms 6c9570f0
- [TASK] Update less.php to 1.7.0.5 d359261c

## BUGFIX
- [BUGFIX] Ignore PSR-2 check for legacy core classes aa587827
- [BUGFIX] Use camel caps format for functions in external media utility d176687a
- [BUGFIX] PSR-2 Violations f15a896f
- [BUGFIX] Add composer self-update to travis 914a4254
- [BUGFIX] Correct indention da8c97d0
- [BUGFIX] Use correct assignment for TypoScript value 1e798736
- [BUGFIX] Make class.ext_update.php work on PHP  b8d89b14
- [BUGFIX] There is no boostrap package 1cf9b927

## MISC
- Scrutinizer Auto-Fixes ffe5e3e4
- Scrutinizer Auto-Fixes 3d6b3427
- Scrutinizer Auto-Fixes 6bd65dd0

# 6.2.14

## FEATURE
- [FEATURE] Add advanced Open Graph support, support new meta notation for 7.4 2734c162

## TASK
- [TASK] Add migration information for backend layout prefix change ad9f9282
- [TASK] Add missing changelog for 6.2.12 and 6.2.13 fc482ca9
- [TASK] Update TypoScript template mapping for backend layouts 5162b178
- [TASK] Add update script to migrate old backend layout prefix to new prefix in table pages fe57d19c
- [TASK] Disable BackendLayoutDataProvider for TYPO3 versions below 7.4 and adapt registration to core provider prefix for PageTS d467590b
- [TASK] Move column labels for border, normal, left, right to bootstrap_package, files moved in CMS 7 b90c08db
- [TASK] fix whitespaces 99c82668
- [TASK] Add 'active' class for shortcuts in sub navigation eb23a66f

## BUGFIX
- [BUGFIX] Use always $GLOBALS[TCA] f0f8c620
- [BUGFIX] fix missing TYPO3SEARCH_end marker b0bde8ab

## MISC
- Update Index.rst 04d164d9
- Rename index.rst to Index.rst 63473434
- Update Index.rst 9826f5ab
- Create index.rst bf873ff4

# 6.2.13

## TASK
- [TASK] Include css_styled_content and form in static template 4f031d5d

## BUGFIX
- [BUGFIX] Remove leading slash from classnames in typoscript setup 92c7c219
- [BUGFIX] Restrict options for default tab to currently assigned items - fixes #197 287e8df7

## MISC
- Fix 'overridden' typos 76a411b0
- Multiple fixes to composer.json e27b03e4
- Fix whitespace in ext_emconf.php e141e230

# 6.2.12

## BUGFIX
- [BUGFIX] Add missing static template for bootstrap package 9347264e

# 6.2.11

## BREAKING
- [!!!][TASK] Remove compatibility to ext:themes through lack of resources 987c2032
- [!!!][TASK] Cleanup deprecated template fallbacks 4b16e85f
- [!!!][FEATURE] Add template fallback support 20ec25cf
- [!!!][BUGFIX] Wrong path to font files - fixes #139 729e9667
- [!!!][TASK] Make less files public available c43a35e4
- [!!!][TASK] Move lightbox implemantation to a own file and remove main.js 305139fc
- [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup f0bee946
- [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3 3f8f04c6
- [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186 1f861227

## FEATURE
- [!!!][FEATURE] Add template fallback support 20ec25cf
- [FEATURE] Make DynamicContent wrappable 45ffc2c6
- [FEATURE] Add swipe support for carousels - fixes #161 94b74d51
- [FEATURE] Add new page type for popup usage without header and footer typeNum 1000 - fixes #70 1c50ebcf
- [FEATURE] Enable support in lib.dynamicContent to support content from pid - fixes #185 8975391d
- [FEATURE] Make breadcrumb enable treelevel configurable - fixes #191 78c19a7b
- [FEATURE] Add TypoScript TYPO3 version condition aa242026
- [FEATURE] Add selectivizr to add CSS3 pseudo selector support to IE8 13d4410a
- [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186 1f861227
- [FEATURE] Add carousel type backgroundimage - #188 8a1f1837
- [FEATURE] Make carousel header layout configurable - #188 224287ab
- [FEATURE] Add CSS status classes to content wrappers - #fixes 85 7d2c7c9c
- [FEATURE] Add tab content element 993eb4f6
- [FEATURE] Add external media content element for youtube and vimeo videos 02ec26fb
- [FEATURE] New advanced constant to enable/disable CSS source mapping 77639ab9

## TASK
- [TASK] Update Documentation for TypoScript constants ed01b96e
- [TASK] Update Documentation 0eeeac64
- [!!!][TASK] Remove compatibility to ext:themes through lack of resources 987c2032
- [TASK] Use TCA renderTypes - fixes #192 13ac5ee6
- [!!!][TASK] Cleanup deprecated template fallbacks 4b16e85f
- [TASK] Copy Bootstrap font files during build process 2f207e70
- [TASK] Update Bootstrap to 3.3.5 27d47b7a
- [!!!][TASK] Make less files public available c43a35e4
- [TASK] Use absRefPrefix = auto instead of baseURL in TYPO3 CMS 7 0e48e798
- [TASK] Add application context examples to .htaccess file 0d727e22
- [!!!][TASK] Move lightbox implemantation to a own file and remove main.js 305139fc
- [TASK] Add hires extension icon 882bfb50
- [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup f0bee946
- [TASK] Add grunt watcher for JavaScript files a8aed629
- [TASK] Add RespondJs to Bower ad3b9928
- [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3 3f8f04c6
- [TASK] Include bootstrap with Bower and Grunt 40e41071
- [TASK] Add Grunt uglify for JavaScripts a761175d
- [TASK] Add initial Grunt setup for RTE and precompiled theme d8881b36
- [TASK] Add less variables file to bootstrap theme db6a5c30
- [TASK] Unify namespace name in templates 3c4cec5e
- [TASK] Make ContextualClassViewHelper compilable 328e3596
- [TASK] Make FalViewHelper compilable a233f389
- [TASK] Make ExternalMediaViewHelper compilable fb7f968a
- [TASK] Make VarViewHelper compilable 95d83e96
- [TASK] Make ExplodeViewHelper compilable 92eafd19
- [TASK] Make DataRelationViewHelper compilable 9e2c3f1e
- [TASK] Remove leftover FormEngineViewHelper fc62a800
- [TASK] Make FlexFormViewHelper compilable bd5d285f
- [TASK] Update jquery.responsiveimages.js b15ee411
- [TASK] Reintroduce css class for first headline in column rendering 09434679
- [TASK] Move custom content element renderings to typoscript folder 9ba2483b
- [TASK] Cleanup extension declaration file to match documentation 848ec4ef
- [TASK] Add individual icons for content elements in wizard 6767c334
- [TASK] Added missing description to Bootstrap elements 35a6156f
- [TASK] Add field subheader to header palette of tt_content 7d6e5fc7
- [TASK] Remove csc-firstHeader CSS class in lib.stdHeader ea2a5296
- [TASK] Use references instead of hard copies in lib.stdheader 473ccd24
- [TASK] Use ExtensionManagementUtility in autoload.php - fixes #172 c2367fdc
- [TASK] Update bootstrap to 3.3.4 791356db

## BUGFIX
- [BUGFIX] Add disablePageTsRTE option to extension configuration again e84055e3
- [!!!][BUGFIX] Wrong path to font files - fixes #139 729e9667
- [BUGFIX] Correct overflow problem 10a0d604
- [BUGFIX] Deprecation of page.includeJSlibs in TYPO3 CMS 7 9273d3e8
- [BUGFIX] Ensure column CSS class is also set for imagecols set to 1 - fixes #138 566968ec
- [BUGFIX] Set BackendLayouts columns correctly if PageTs is set via page record 9be58651
- [BUGFIX] Section Index content item produces incorrect links - fixes #150 61a3fc85
- [BUGFIX] Correct OnePage Markup bf4b1815
- [BUGFIX] Add missing restore register in text with icon - fixes #174 c6f65941

## MISC
- slightly smarter TypoScript 825d4b26
- FLUIDTEMPLATE.templateName and templateRootPaths 193983b8
- Update jquery.responsiveimages.js a066650a
- Collision with jQuery width and height methods 10f0fbcb
- Update jquery.responsiveimages.js 7ee19d4b
- Update jquery.responsiveimages.js 8fddd3b1
- Update jquery.responsiveimages.js 496e017d
- Update jquery.responsiveimages.js a2bf2d30
- Event optimisation b0a54d66
- Fine tune jquery.responsiveimage.js cdefdf81
- Update jquery.responsiveimages.js 36b97037
- Update jquery.responsiveimages.js fe803ca5
- Update jquery.responsiveimages.js 3ab416b1
- Fix indents in tab feature fcef312b

# 6.2.10

## FEATURE
- [FEATURE] New advanced constant to enable/disable the use of Typoscript constants as Less variables e01b136d
- [FEATURE] new constant $page.logo.alt used to overwrite the default alt attribute of the logo image a7544c25
- [FEATURE] make site logo alt attribute configurable 5e1d06f6
- [FEATURE] Disable automatic less compiling - fixes #162 1eef6627

## TASK
- [TASK] Add changelog 2d3dc52c
- [TASK] Refactor jquery.responsiveimages.js 0f90334b
- [TASK] HTML5 markup for sub navigation - fixes #171 604ea24e
- [TASK] Make RealUrl autoconfig compatible with the version from Helmut Hummel for 7.x 20333053
- [TASK] Protect configuration of extensions in default .htaccess c3e76016
- [TASK] Remove migration of realurl in favor of Helmut Hummels release for TYPO3 CMS 7.2 a598a4df
- [TASK] Carousel: allow to set the max width of background images 39d46854
- [TASK] Update oyejorge/less.php to 1.7.0.3 c29b6227
- [TASK] Remove automatic cache clearing - fixes #126 35b81ccf
- [TASK] Add slack to contact and communication 7e746fd6
- [TASK] replaced  with  29b666b5
- [TASK] Add admin panel config to typoscript constants 761bd5c7
- [TASK] Update changelog in documentation 88139537

## BUGFIX
- [BUGFIX] Correct overlapping elements on centered image - fixes #113, #159 4cce784c
- [BUGFIX] Correct media display for file links content element - fixes #164 0af8bc02
- [BUGFIX] fix for HTML5 markup validation b5776a1c
- [BUGFIX] Missing container in default clean layout e6c0cf9f
- [BUGFIX] Adjust language uids to match introduction database - fixes #135 863615c6

## MISC
- Stop using deprecated XHTML cleaning 9aef5248
- Allow "target" attribute inside  tags. 653bd30a
- added "br" to "allowedTags" a44d88f1
- [CLEANUP] Correct indention to CGL a7a74f0c
- Modified footer and header 4aa5c42a
- [Bugfix] fixes sorting on localized relations e57bc95e
- Update FalViewHelper.php fe208bdc
- [Bugfix] FalViewHelper.php 7769afed
- Update Base.ts 697bedc4

# 6.2.9

## TASK
- [TASK] Update jquery to 1.11.2 e8822fce
- [TASK] Update modernizr to 2.8.3 559ff0c8
- [TASK] Update less.php to current master d065a0be
- [TASK] Throw exception on less compile error 70249bf3
- [TASK] Rise dependency of TYPO3 and css_styled_content version to 7.99.99 c056ffd9
- [TASK] Add backend skin changes to the documentation 4d78373c
- [TASK] Use realurl autoconfig hook instead of overriding every config 7d9fb372

## BUGFIX
- [BUGFIX] Remove problematic whitespace c7d64280
- [BUGFIX] Remove superfluous slash in font definition - fixes #132 115a9d58
- [BUGFIX] Classname must not start with a backslash in ext_conf_template.txt 095c2a17

## MISC
- Update Index.rst 4660037b
- Use array_merge_recursive() instead ca4d0322
- Don't overwrite existing configuration completely 18f1ca82

# 6.2.8

## TASK
- [TASK] Make realurl optional 6f92339a
- [TASK] Remove e-mail from contact b162f602
- [TASK] Minify responsiveimages.js and and cleanup f8ad4af7
- [TASK] Cleanup CGL c1956cf1
- [TASK] Make removeDefaultJs configurable. fixes #105 aebd1fcd

## BUGFIX
- [BUGFIX] Use correct rte transform in accordion textfield - fixes #67 21735bde
- [BUGFIX] Wrong calculation in news pagination - fixes #106 146a8659
- [BUGFIX] Flashmessage queue throws error while installing - fixes #116 f0508a9d

## MISC
- Update newContentElement.txt 94a1a165
- Update newContentElement.txt c7e27ab8
- Update jquery.responsiveimages.js e40750d9

# 6.2.7

## TASK
- [TASK] Include respond.js with conditional comment to work with static cache - fixes #101 66ce0a66
- [TASK] Cleanup CGL b5cd79d2
- [TASK] Reformat all project-specific content to TYPO3.CMS CGL 7a86c368
- [TASK] Make getCompiledFile a static method - fixes #103 #104 6541519a
- [TASK] Deprecate backend skin for CMS7 and provide new logos 279601a6
- [TASK] Carousel needs to have background-image and background-color at the same time available c000a5bf
- [TASK] Add .editorconfig file cf164b64

## BUGFIX
- [BUGFIX] Wrong colpos was used in layout "Default, Subnavigation Left and 2 Columns" fixes #98 5e0d2741

## MISC
- Fix for columns in backend layout 14d4eb34
- Add 25/75 backend layout 7b676ed6
- Add missing migrations for realurl cd232393
- Add migrations for realurl to be compatible with CMS 7.0 880b198b
- Remove unused template variable - fixes #93 614a1eb9
- typo df58daa6
- Updated RTE configuration. Implemented a workaround to get enableWordClean work again. 884dc404
- Finish Hotfix-lead-text 7aebd4e1
- Fixes Lead text in RTE that is not saved cause not in allowedClasses c0f69b38

# 6.2.6

## FEATURE
- [FEATURE] add composer.json 2c668813

## MISC
- Release 6.2.6 26b6ed91
- Correct colPos for left column on Layout: Default, Subnavigation Left and 2 Columns - fixes #62 51f177e3
- Add Google Analytics tracking code anonymization - fixes #84 f8ff29b3
- Adjust processing rules for rte 1b9b1c5e
- Add missing styling for rte table contextual classes be860ade
- Enhance accessibility for the accordion 7540ed6a
- Describe and enhance rte config, tables are now responsive by default, css classes have translations now 1217a36e
- Fix role="main" position in 2 columns layout. 23bec274
- Add backend layout with 2 columns 50/50% 2784053b
- Use DIR option instead of FILE to include backend layouts. 9b2c649d
- Remove superfluous text "Bootstrap Package: " from layouts names. 8e5cfe13
- Exclude page also from search engine index if no_search is set to the page - fixes #69 e4529ffd
- Enhance accessibility for the carousel 0db789b2
- Adjustments to skip to content - resolves #63 f32ea4ae
- Add marker for current year. Move replacements directly to the fluidtempalte - fixes #72 71163c16
- Add missing alt and title attributes on noscript fallback for image rendering - fixes #77 706df22c
- TASK: Skip to content Resolves https://github.com/benjaminkott/bootstrap_package/issues/63 e8214f8e
- Update bootstrap css file for the backend to 3.3.0 e3c8ba0c
- Adjust gitignore 6e317ce4
- Remove the automatic appending icons for content links de9f8ca0
- Fix navbar-brand-image position f20efcf0
- Fix Carousel fading in chrome 9938953f
- Update Bootstrap to version 3.3.0 5091bd83
- Display Problems in IE8 for "width: 100% \9;" 618350db
- Move css files for the backend to avoid missunderstandings and add plain default bootstrap.min.css - fixes #61 84a357f1
- Adjust language menu for smaller viewports - #65 7dbb159a
- Adjust font-size and line-height for better readability bd77e0a0
- We are always stable ;) 1d697bc3
- Backendskin is not disabled correctly if option is set eb9a85e0
- Add backend layouts for left navigation - fixes #62 5474be4b
- Adjust carousel - fixes #51 1f1ac900
- Add missing space in news date format - fixes #59 3886f279
- Add caption alignment - fixes #58 bb491586
- Fix small typo e7a23a26
- Cleanup configuration for indention frames - fixes #57 13498efd
- Cleanup RTE config a5720c9c
- Cleanup Tabs #52 b77c4ce6
- Remove forgotten typoscript code for searchbar and login - #50 9035ae18
- Set cache period to 24h - fixes #55 17695a1c
- Correct linkToTop rendering - fixes #54 242d37f0
- Correct composer.json b44573a1
- Move PARAMS before SOURCECOLLECTION for better HTML code readability. b3196163
- Move img class to params for easier customization. 8b2704cd
- Add basic google analytics settings aa7d6de8
- Provide open graph image for social networks ddd18ee7
- Cleanup flip ahead browsing for IE 672bd9cf
- Correct dependency to TYPO3 version to ensure that the correct forms are loaded 5b12351b
- Update composer.json e3c3bb94
- Fix dynamic rewrite base 31a8d99b
- Implement a dynamic rewrite base solution reduce problems with some hosters e0cd37b4
- Remove some image orient fields to avoid distraction 0375b126
- Remove unused link for the image in text with image - fixes #49 b6f1da7c
- Avoid error if data for lib.dynamicContent is not provided as array e8e33893
- The title attribute remains empty in mainmenu of onepage variant - fixes #44 e8cd26a3
- Allow link tag usage in html content element 7631b768
- Split theme less file fbe94f93
- Add new clean backend layout d64540c6
- Add styling constants for ext:themes 354bd9d2
- Provide options to disable parts of the auto included PageTs settings c02611bf
- Cleanup 291515cd
- Make Bootstrap Package run as a OnePage Website 676034fd
- fix 'Boostrap' typos c17e975f

# 6.2.5

## FEATURE
- [FEATURE] use SymLinksIfOwnerMatch in .htaccess 187c8581

## MISC
- Release 6.2.5 c86a3480
- Update Documentation 966bd586
- Add support for link "Edit me on Github" 858253eb
- Fix workspace problem for related records #37 d2484b99
- Make main navbar position configurable 45db7c4e
- Combine less files to avoid dublicate css definitions 9aec7779
- Allow Backend Layouts to be configured via PageTsConfig 3d72ea3d
- Cleanup less.php integration - fixes #32 1f50d81f
- Correct display of tx_form - hopefully 60f71fc3
- Correct type of baseURL typoscript constant dc732035
- Correct default icon-font-path to avoid problems if page is deployed in a folder - fixes #31 bd33fa10
- Update jQuery version to 1.11.1 1f78758f
- Disable imageheight and imagewidth for textpic and image content elements to avoid wrong rendering e2e19f65
- Avoid problems with hardcoded resource links in login template, remove overriding - fixes #28 16a6f996
- Correct label definitions for content elements, $_EXTKEY is not available here - fixes #27 d9b5c101
- Add conflict to dyncss to ensure correct less rendering 605db345
- Cleanup spaces 53251485
- Images displayed in one column have no restriction to current layout column - fixes #19 4cbf85f7
- Update Bootstrap to 3.2.0 adef7ece
- Correct file locations 58180a16
- Fix bootstrap less compiler if flattensetup is not available - fixes #20 25fce394
- Cleanup bootstrap file locations e55d0f17
- Move bootstrap js to separate folder f016b287
- Removing symlink option due problems on windows apache with symlinks - affects #25 538ef39c
- Add missing default variables file for bootstrap 46147ae2
- Remove backend style module - introduce typoscript constants instead to provide a more flexible less configuration - fixes #5 #20 2f0b0cea
- Update less.php 4160b7aa
- Move TCA c6cfb0ed
- Text and image - center top was not centered - fixes #21 18e5cb33
- Add missing bodytext field to carousel "text and image" and enable rte for accordion - fixes #23 80993edb
- Allow table in RTE a164e5a1
- Adjust LogoView to make it a bit more secure ed55a6fc
- added fluidpages to conflicts fixes #18 e8a32c06
- Add link to the complete teaser item and fix the relations 2967c55a
- Fix typo dfa694ca
- Make it possible to enable backend skin if themes is loaded. 2ef1c553
- Make bootstrap_package compatible with themes (part 2) fdfa43af
- Correct version number 661886df
- Cleanup formatting 1e422c8b
- Make bootstrap_package compatible with themes (part 1) 77414e69
- Correct types in constants a8879cda
- Add TYPO3 version to sitename in backend header 55b24006
- Correct wizard registration d97a9d43
- Add links for carousel images in FE, optimize fal fields. fixes #15 55e18f4a
- Update Accordion.html 342917cb
- add missing text_color field to carousel textwithimage #10 971cc247
- carousel interval and wrap needs to be configurable #10 5e1bb9c6
- wrong label for header in carousel textwithimage #10 daff0c1c
- cleanup wrong committed stuff before 331e51fa
- - cleanup wrong formatting in base.ts - add chash for pagination to prevent cashing issues described in #9 fc3b6b8d

# 6.2.4

## MISC
- ter does not allow long version numbers ... 52370906
- ter ist fucking up ;( a4608ef1
- set version to 6.2.2.2 c7aaf3c8
- Add Basic Documentation a3fb4c45
- correct version to 6.2.2.1 and adjust description 54518d62
- Hide navigation toggle if no subpages exist. 84c7b738
- Fix the height of the header if no subpages available a57cbc3f
- Provide an example .htaccess file after installation - fixes #3 da841fe4
- tabs and spaces ... 72dbbaec
- Remove absRefPrefix und add automatic baseURL determination instead. This will ensure that the links and pages are correct if you are running TYPO3 in a subfolder. d3bf38b1
- Change README to .rst format. Change spelling and wording. 3bbfa467
- Change README to .rst format. Change spelling and wording. b79952aa
- image fix IE 4e6ccbc2
- set version to 6.2.3 for further development 4f906769
- cleanup main.js c407babd
- remove rootpage id from realurl due complication with import 66d905d6
- Make absRefPrefix configurable, this is needed when typo3 is running in a subfolder 95e1772c
- set version to 6.2.2 for further development 65aac304
- Remove generated variables from repository 174e9fb7
- Add RealUrl Config 93f4c39f
- Update description 27e6edcb
- Update README.md 1667b223
- set version to 6.2.1 for further development 536466a9
- set version to 6.2.0 - initial release in ter 31783df8
- RC 6.2 eecd180a
- Initial commit 8a43508f

