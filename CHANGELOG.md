# 9.1.0

## BREAKING
- [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine. c00049b
- [!!!][FEATURE] Add auto lookup for page templates 7b1fbdf

## FEATURE
- [!!!][FEATURE] Add auto lookup for page templates 7b1fbdf
- [FEATURE] Add auto lookup for page templates 2505133

## TASK
- [TASK] Raise allowed TYPO3 version to 9.5.99 ec39538
- [TASK] Add travis tests for php 7.2 on typo3 master c489860
- [TASK] Move CMS9 backend branding to service that is only called on installation c677ad9
- [TASK] Only write backend configuration if it has changes c7d0fc1
- [TASK] Remove correct addStaticFile function from extension scanner b8f9249
- [TASK] Move icon registration to localconf edf09e6
- [TASK] Exclude php less libary from extension scanner da16625

## BUGFIX
- [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine. c00049b
- [BUGFIX] Set default backend configuration for CMS9 9868010
- [REVERT][BUGFIX] Install php extension intl on travis ci 00a2867
- [BUGFIX] Install php extension intl on travis ci 3333064
- [BUGFIX] Adapt travisci build configuration to documentation 80121cd
- [BUGFIX] Ensure page layout class is never empty 2fc802b

# 9.0.0

## BREAKING
- [!!!][TASK] Remove obsolete pagetype popup - fixes #476 20124b9
- [!!!][FEATURE] Make css classes of footer columns directly addressable a500b6d
- [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core 625af26
- [!!!][TASK] Remove mod_filter check by default da1db9d
- [!!!][FEATURE] Load bootstrap rte configuration for all records by default 4036bd3
- [!!!][FEATURE] Enable links on dropdown menus in main navigation 4b8baee
- [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level 25b731d
- [!!!][TASK] Use .typoscript instead of .txt for configuration files 9583970
- [!!!][BUGFIX] Streamline grunt less and less.php rendering 3123bd2
- [!!!][TASK] Drop obsolete windows phone fix a2f9dea
- [!!!][TASK] Drop equalheight script 835b16b

## FEATURE
- [FEATURE] Pass current element on trigger loaded.bk2k.responsiveimage - fixes #471 450e465
- [FEATURE] Allow links on carousel type background image - fixes #455 33e6ffe
- [FEATURE] Enable frontend editing for pages 48ef140
- [FEATURE] Enable frontend editing for content elements 8d06457
- [FEATURE] Make open accordion item configurable dca76d1
- [FEATURE] Make gallery item column sizes configurable - fixes #465 e5d9cad
- [FEATURE]  Add table class in ckeditor by default 6fbd0f2
- [FEATURE] Add ckeditor plugin to insert boxes a54478b
- [FEATURE] Add carousel item type image e85c213
- [FEATURE] Add configurable header and subheader css classes e13a417
- [FEATURE] Add additional inline text style classes to editor config 5a60918
- [FEATURE] Add background image and base coloring support for content elements a9bd8c5
- [FEATURE] Introduce frame-container and frame-inner for more detailed control options 34e0039
- [FEATURE] Add auto lookup for carousel item templates and move wrapping links to partials 42a676d
- [FEATURE] Add UpperCamelCaseViewHelper 7b0f406
- [FEATURE] Add option to show navigation title in carousel navigation 88e86ec
- [FEATURE] Add navigation icons for main navigation 642eaff
- [FEATURE] Add current version to system information toolbar aad4bf5
- [FEATURE] Make scaling options for headlines configurable 4be3c37
- [!!!][FEATURE] Make css classes of footer columns directly addressable a500b6d
- [FEATURE] Make footer meta section colors configurable 0d6c2eb
- [FEATURE] Make breadcrumb extendable to show title of single records 57ca005
- [FEATURE] Add example configuration for Microsoft-IIS 33d8524
- [FEATURE] Add support for google-site-verification meta tag 7a19e6e
- [FEATURE] add element wrap in lib.dynamicContent 4f93616
- [!!!][FEATURE] Load bootstrap rte configuration for all records by default 4036bd3
- [!!!][FEATURE] Enable links on dropdown menus in main navigation 4b8baee
- [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level 25b731d
- [FEATURE] Make config.typolinkEnableLinksAcrossDomains available through constant cd47544
- [FEATURE] Enable cropping of carousel background image 770c96a
- [FEATURE] Enable cropping for image in carousel 42558ae

## TASK
- [!!!][TASK] Remove obsolete pagetype popup - fixes #476 20124b9
- [TASK] Push notifications to slack cf4cefc
- [TASK] Register bk2k as global namespace for viewhelpers ba56d07
- [TASK] Check for explicit for null value in version toolbar item 849d9dd
- [TASK] Adjust scrutinizer build 6da63b5
- [TASK] Remove obsolete divider to tabs option b9c14b2
- [TASK] Rename ckeditor box plugin to avoid naming conflicts 22077d2
- [TASK] Reduce form css to minimum and adapt to new form elements 4245a42
- [TASK] Update package-lock 8299c8c
- [TASK] Remove obsolete watch task for viewportfix ff4d2f7
- [TASK] Add small option to ckeditor a5628c4
- [TASK] Add default css class to unordered lists from rte fff4b2c
- [TASK] Reduce default fields of carousel item 2104e7b
- [TASK] Streamline element quote TCA 3d2c4b0
- [TASK] Hide relation tables to avoid problems when managed without proper context 014fb17
- [TASK] Remove authors from phpdoc 7d66f2e
- [TASK] Streamline php header comments and add fixer rule ddd4880
- [TASK] Remove obsolete margin bottom from breadcrumb c991413
- [TASK] Enhance positioning of scroll to top button b13a1bd
- [TASK] Avoid ambiguous "uid" error (#480) b839cb2
- [TASK] Use initialize arguments instead of render arguments in FalViewHelper 430fb3a
- [TASK] Use initialize arguments instead of render arguments in DataRelationViewHelper 769928f
- [TASK] Use initialize arguments instead of render arguments in ExplodeViewHelper 60eb760
- [TASK] Add mini section styling 092eb3a
- [TASK] Use initialize arguments instead of render arguments in ExternalMediaViewHelper e9394bb
- [TASK] Use initialize arguments instead of render arguments in LastImageInfoViewHelper 228aeb8
- [TASK] Remove obsolete tt_content palettes cc8328e
- [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core 625af26
- [TASK] Update readme and include frontend screenshot d70b031
- [TASK] Add .rst and .typoscript to editorconfig d0bf834
- [TASK] Add deployment for www.bootstrap-package.com 1d36a5b
- [!!!][TASK] Remove mod_filter check by default da1db9d
- [TASK] Ensure link target attribute is only rendered if target is set - fixes #468 9e13ae1
- [!!!][TASK] Use .typoscript instead of .txt for configuration files 9583970
- [TASK] Update npm dependencies a702b26
- [!!!][TASK] Drop obsolete windows phone fix a2f9dea
- [!!!][TASK] Drop equalheight script 835b16b
- [TASK] Remove release commit from changelog 528b851
- [TASK] Replace unwanted characters in commit messages 61ce04b
- [TASK] Add composer changelog script bdef9ab
- [TASK] Drop development affix for version numbers 9e1456f
- [TASK] Add composer version script cb2480b
- [TASK] Cleanup code formatting for palette configuration 2c224fd
- [TASK] Use php-cs-fixer instead of php-codesniffer c22ff31
- [TASK] Adjust composer keywords 6773db4
- [TASK] Raise php dependency to 7.x c100722
- [TASK] Remove not working ter upload 05c42f6
- [TASK] Add typo3 8.7 to travis 88fa5d6

## BUGFIX
- [BUGFIX] Correct css selector for carousel item type text and image c105a13
- [BUGFIX] Correct indentions bb499d7
- [BUGFIX] Show correct translations in language menu (#487) 54dc3d2
- [BUGFIX] Ensure aria-expanded is correctly set for accordion items 6b0551a
- [BUGFIX] Ensure selected tab item is shown in the backend e0b8cef
- [BUGFIX] Only support hover for on navbar toggle if hover is completely supported - fixes #459 a5925b1
- [BUGFIX] Add missing namespaces to carousel small and fullscreen templates 5e4a16d
- [BUGFIX] Use self instead of static in DataRelationViewHelper 6cd7491
- [BUGFIX] Add css to precompiled css files 617e898
- [BUGFIX] Correct jumbotron button styling 3fd55f6
- [BUGFIX] Add missing list styles to rte configuration 47bfded
- [BUGFIX] Correct bootstraps calculation of container widths c8ae888
- [BUGFIX] Ensure correct link colors are loaded for footer meta section 537fe9d
- [BUGFIX] Ensure footer list are actually centered 84a6674
- [BUGFIX] Correct preview template assignments for listgroup and external_media b441bc8
- [BUGFIX] Set default value for tt_content reference fields in *_item tables (#482) 1f8fb5c
- [BUGFIX] Add parseFunc handling to pre tags 34834d8
- [BUGFIX] Correct rendering method of LastImageInfoVIewHelper 7e3565d
- [BUGFIX] Correct indention in generic template 7267a2e
- [BUGFIX] Limit media element to youtube and vimeo c9cd0a0
- [BUGFIX] Display cropping variants for textmedia - fixes #438 49f894f
- [BUGFIX] Ensure link is displayed correctly in readme 8411a1d
- [BUGFIX] Correct image link in readme e842ce9
- [BUGFIX] Add boostrap-package.com as known host fa32c50
- [BUGFIX] Specify Deployer file c0826c4
- [BUGFIX] Fix sys_language_uid when adding item to translated tt_content (#458) 5a91e6f
- [BUGFIX] Only show content in MenuSectionPages that is marked for section index - fixes #466 7f7b788
- [BUGFIX] Close tags in meta menu properly - fixes #469 191395d
- [BUGFIX] Remove unused constant assignments - fixes #477 024c532
- [BUGFIX] Remove padding of navbar-collapse on desktop 9bf16d5
- [!!!][BUGFIX] Streamline grunt less and less.php rendering 3123bd2
- [BUGFIX] Remove wrong placed comma in navbar less file - fixes #460 afead77
- [BUGFIX] Prepare colPos field for proper quoting (#452) 498f970
- [BUGFIX] Correct texticon preview paths on windows d9a56f4
- [BUGFIX] Remove .php_cs.dist from export 439c38e
- [BUGFIX] Correct less variable: @icon-font-path (#450) 13edd33
- [BUGFIX] Correct sys_file_referece palettes for tab items a740752
- [BUGFIX] Correct sys_file_referece palettes for accordion items ef33c3e
- [BUGFIX] Use override child tca for carousel background image e687152
- [BUGFIX] Correct value type of data-wrap for bootstrap carousels - fixes #437 dc47cc9
- [BUGFIX] Remove conflicting btn stylings for legacy rtehtmlarea - fixes #447 ce256fe
- [BUGFIX] Correct dependencies for typo3 cms 9.x 9ce70d2

## MISC
- [CLEANUP] Fix typo by adding missing c to "seletor" 448d684
- Use correct closing tag 8ae85ef

# 8.0.0

## BREAKING
- [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead e33f0ed

## FEATURE
- [FEATURE] Enable compression of generated css files 4b39a41
- [FEATURE] Add bootstrap responsive wrapper to table ce - fixes #385 caac09a
- [FEATURE] Add art direction for image, media, textpic and textmedia efde1cb

## TASK
- [TASK] Force captions to break d1594b6
- [TASK] Make thumbnail menu more flexible a122f48
- [TASK] Apply more flexible style on thumbnail menus 7fd49b6
- [TASK] Remove cropping from text an image carousel item 0fd7121
- [TASK] Add missing rte configuration for content element panel 7431a08
- [TASK] Optimize brand placement 4c3209f
- [TASK] Use SVGs files instead of png for logos in frontend 2dd177b
- [TASK] Raise TYPO3 dependency in scrutinizer config c751d36
- [TASK] Remove obsolete adjustments for indexed search 13837b0
- [TASK] Update missleading informations 54b46e5
- [TASK] Raise TYPO3 Version requirement to 8.7 LTS 7ff8f0d
- [TASK] Migrate foreign selector to override child tca 65315cd
- [TASK] Remove default rendering fallback, core provides information already 215fb15
- [TASK] Remove deprecated localizationMode from TCA d761f7d
- [TASK] Use new form framework instead of old mailform element d0d5ef4
- [TASK] Change seperator of page title 2d28eee
- [TASK] Remove obsolete typoscript configuration 760f7eb
- [TASK] Adapt generic fluid template to match requirements for plugins 960d40f
- [TASK] Remove obsolete assignment for felogin 17071d4
- [TASK] Adapt childtca override config for cropping variants f50b57f
- [TASK] Adapt indexed search to CMS8 c9ce1dd
- [TASK] Remove obsolete login template 0ed6705
- [TASK] Adapt frontend login to CMS8 75ea29e
- [TASK] Add generic template for general usage d55863b
- [TASK] Remove obsolete tt_content typoscript configuration c3b01a9
- [TASK] Add rte configuration for tabs and accordions b84a29d
- [TASK] Restore typical content elements panel 5b5fca0
- [TASK] Add textpic and textmedia to content element wizard media and text 7672bfd
- [TASK] Add ckeditor as dependency - fixes #431 ad73b38
- [TASK] Adapt php-cs-fixer configuration 47410a8
- [TASK] Remove obsolete canNotCollapse attribute 6547a49
- [TASK] Resolve deprecation for general language file d83b10e
- [TASK] Optimize gallery rendering to use flexbox for better performance 743782c
- [TASK] Enhance gallery template 0fc62da
- [TASK] Honor CMS8 cache convention for processed less files - fixes #371 3e08b28
- [TASK] Resolve deprecation and use f:defaultCase for default in f:switch 2c635f0
- [TASK] Remove deprecated TypoScript property config.noScaleUp 60dd67f
- [TASK] Enable accessibility options to bypass navigation content elements 18e4d89
- [TASK] Streamline blockquote RTE rendering b76d355
- [TASK] Enable RTE h4 and h5 format tags 69fa832
- [TASK] Add table RTE configuration 043ef72
- [TASK] Add basic RTE styling aae5594
- [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead e33f0ed
- [TASK] Add html tag with namespace definitions to fluid tempaltes 09d97ef
- [TASK] Streamline carousel content element 85d2dbf
- [TASK] Streamline accordion content element 3b310f4
- [TASK] Remove type from content element configuration comment 0ea9263
- [TASK] Streamline tab content element 33dc2ff
- [TASK] Move bullets content element in wizard to text a4686fe
- [TASK] Streamline bullet content element with fsc a0b94c4
- [TASK] Move table content element to text tab in wizard 53a574e
- [TASK] Streamline external media element key d239414
- [TASK] Streamline listgroup rendering ed8c8e7
- [TASK] Move image content element in wizard to media tab 3a73d61
- [TASK] Move default content elements in wizard to dedicated tabs 4c08672
- [TASK] Remove header palette override dd81e21
- [TASK] Streamline uploads content element with fluid_styled_content 9e9b6c8
- [TASK] Use more simple ctype for text and icon content element caec788
- [TASK] Adapt panel element for CMS8 d0ce21a
- [TASK] Move texticon to text palette in content element wizard d277dea
- [TASK] Streamline default, div, header, and html templates e75c292
- [TASK] Streamline quote definition and rendering ab971f6
- [TASK] Remove obsolete thumbnail icon since its now available in core iconset 5d5cddd
- [TASK] Remove obsolete textmedia icon 11fb8ef
- [TASK] Remove obsolete textteaser icon since its now available in core iconset 105c690
- [TASK] Streamline tabecolumn rendering f2dedfa
- [TASK] Streamline textteaser definition and rendering 6eea954
- [TASK] Add html tag with fluid namespace to text template 079f7bb
- [TASK] Add html tag with fluid namespace to shortcut template 7b30786
- [TASK] Convert new lines to break for captions c79fed5
- [TASK] Adapt media gallery from fluid_styled_content 80901d1
- [TASK] Adapt media element for CMS8 6952b1e
- [TASK] Move external media content element to media group 1fb86cf
- [TASK] Move audio content element to new media group 7a6e603
- [TASK] Set default header to h2 1c8eb6a
- [TASK] Enforce linux lf for xml files ec2a31d
- [TASK] Update default .htaccess 5445e4b
- [TASK] Remove RTE HtmlArea config e0d1f40
- [TASK] Minor cleanups 7dfee8f
- [TASK] Streamline table rendering with fluid_styled_content 0de50f8
- [TASK] Remove indexed search from new content element wizard 1d92fe4
- [TASK] Cleanup new content element wizard configuration 12a9269
- [TASK] Move thumbnail menus to menu tab in content element wizard c36fb42
- [TASK] Migrate pages and subpages menus to dedicated content elements 58effa9
- [TASK] Migrate abstract menu to dedicated content element 4b60262
- [TASK] Migrate recently updated pages menu to dedicated content element f1ea58a
- [TASK] Migrate related pages menu to dedicated content element e039988
- [TASK] Migrate section menus to dedicated content elements 1e6844a
- [TASK] Migrate sitemap menus to dedicated content elements 0eae502
- [TASK] Migrate categorized content and pages menus to dedicated menus 043e07e
- [TASK] Migrate thumbnail menus to dedicated menus fefdc5b
- [TASK] Remove obsolete fields from sql file 3f6571e
- [TASK] Remove obsolete tt_content categorizable call 26d12f4
- [TASK] Remove obsolete bullets content element definition c53d6cb
- [TASK] Remove obsolete menu content element definition 20206b2
- [TASK] Remove obsolete table content element definition 708f6d2
- [TASK] Remove obsolete uploads content element definition ecebab1
- [TASK] Remove obsolete textmedia content element definition 02e0101
- [TASK] Remove admin panel pagets configuration 68f62f5
- [TASK] Remove obsolete mailform content element definition 5f9a4f1
- [TASK] Remove obsolete shortcut content element definition b074243
- [TASK] Remove obsolete html content element definition e655ea3
- [TASK] Remove obsolete list content element definition 7e4ae2f
- [TASK] Remove obsolete div content element definition 9d536a3
- [TASK] Remove obsolete tceform corrections a5a3eb0
- [TASK] Remove obsolete image content element definition 2efd5fd
- [TASK] Remove obsolete imageorient definition c0bd8fc
- [TASK] Remove obsolete textpic content element definition 792f857
- [TASK] Remove obsolete text content element definition aa88469
- [TASK] Remove obsolete header content element definition bf467eb
- [TASK] Remove obsolete header_position 355afcd
- [TASK] Adapt texticon element for CMS 8 97cba7d
- [TASK] Adapt tab element for CMS 8 1fd6e96
- [TASK] Adapt panel element for CMS 8 a11094b
- [TASK] Adapt carousel element for CMS 8 e2b8679
- [TASK] Adapt accordion element for CMS 8 9cc5d98
- [TASK] Adapt audio element for CMS 8 4eb7fa6
- [TASK] Adapt externalmedia element for CMS 8 dfcd4d2
- [TASK] Adapt listgroup element for CMS 8 b3d4909
- [TASK] Streamline content element definitions and apply new header 2443f84
- [TASK] Add fallback to header section and remove overrides e383d97
- [TASK] Update loginscreen and extension configuration experience d7d72d0
- [TASK] Enable appearanceLinks palette for all content elements and add footer 872afa4
- [TASK] Mark default content element layout sections as optional 2299ebe
- [TASK] Adapt DropIn's from Fluid Styled Content 682c36f
- [TASK] Migrate sectionframe to frame class, enable spacebefore and after 1b0d852
- [TASK] Hide accordion-, carousel- and tabitems after copy 607de8f
- [TASK] Migrate requestUpdate to onChange 12dd043
- [TASK] Migrate showIconTable to selectIcons configuration 5055e31
- [TASK] Migrate colorChoice wizard to render type colorpicker 0584b7f
- [TASK] Migrate TCA field quote_link and link inputLink 92cd67d
- [TASK] Set versioningWS to true 5d0d01f
- [TASK] Remove unused TCA control setting versioning_followPages 2f8cafb
- [TASK] Migrate TCA field bodytext to match new wizards c143815
- [TASK] Migrate TCA fields starttime and endtime to inputDateTime 35135f5

## BUGFIX
- [BUGFIX] Adapt thumbnail list template 8542900
- [BUGFIX] Remove all typolinks from backend preview of quote element 12946cd
- [BUGFIX] Remove typolink from backend preview of quote element 2306885
- [BUGFIX] Add missing data prefix for lightbox caption 179e73f
- [BUGFIX] Set lightbox caption 6a8037d
- [BUGFIX] Add missing compiled css c59d57d
- [BUGFIX] Correct font size for text and image carousel item 14150c0
- [BUGFIX] Add missing support for subheader on carousel text and image 50256da
- [BUGFIX] Exclude buttons from section link styling c25bfe9
- [BUGFIX] Add missing link colors to sections d6237f3
- [BUGFIX] Use correct external media palette e339b4c
- [BUGFIX] Correct spacing between carousel indicators ee95762
- [BUGFIX] Correct sorting in content element type select 7e909ea
- [BUGFIX] Correct resolving of less sourcemaps - fixes #413 49318ce
- [BUGFIX] Set default language value for custom records 571192e
- [BUGFIX] Add hammer.js mapping files for debugging - fixes #396 99fbf8f
- [BUGFIX] Resolve deprecation for language file usage 5d7521c
- [BUGFIX] Remove focus after clicking on scroll-top link - fixes #432 f9b5e59
- [BUGFIX] Add missing html tags and streamline selfclosing tags eaa579f
- [BUGFIX] Correct hook to clear less caches e890dc8
- [BUGFIX] Correct relative path for less processing 324e83f
- [BUGFIX] Ensure correct preformatted text rendering a4f0a2a
- [BUGFIX] Correct TCA for parent record in accordion and tab item b3ca827
- [BUGFIX] Correct spelling of temp folder f05fc55
- [BUGFIX] Add type to linkVars language parameter 0f0e61b
- [REVERT][BUGFIX] Remove tools from scrutinizer config but disable analyzer a49c399
- [BUGFIX] Remove tools from scrutinizer config b74c7d0
- [BUGFIX] Set TYPO3 version for scrutinizer build 4d0453f
- [BUGFIX] Require typo3/cms for scrutinizer build fa4c278
- [BUGFIX] Restore location of well and jumbotron in frame class a65475e

# 7.1.0

## BREAKING
- [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356 d2b23d1
- [!!!][TASK] Reintroduce "no frame" option - fixes #319 f2b06d7
- [!!!][FEATURE] Add sections to visually group elements eedb60d
- [!!!][FEATURE] Adjust make footer color configurable 9001189
- [!!!][FEATURE] Add support for google webfonts - fixes #115 7d58ac6
- [!!!][FEATURE] Add support for spacer in menu processor - fixes #335 5d0a76c

## FEATURE
- [FEATURE] Make language uids for menu configurable d07e219
- [FEATURE] Add audio content element - fixes #399 c7ac13d
- [FEATURE] Add preview for quote content element add8bc0
- [FEATURE] rearrange settings for images and media assets (#395) 3c2ddf2
- [FEATURE] Add signal to compile service - fixes #371 2b0e577
- [FEATURE] Add quotation content element 1b528c4
- [FEATURE] Provide generated link and target from hmenu in menu resultset - fixes #380 0f206e8
- [FEATURE] Add smothscrolling and back to top link d5218b1
- [FEATURE] Add content element text with teaser 477a83e
- [FEATURE] Add constant for absolute favicon path 41f2413
- [FEATURE] Add subheader to carousel item header 9d54f21
- [FEATURE] Add stickyheader to overlay carousel ceaa969
- [FEATURE] Add fullscreen variant of carousel b651815
- [FEATURE] Add support for additional iconsets and ionicons - fixes #357 c5c6f61
- [FEATURE] Add header_link to the icon of text widh icon content element - fixes #154 b34960f
- [FEATURE] Add meta navigation support 66c7650
- [FEATURE] Add marker for frontendurl 8f23e43
- [FEATURE] Add content element to display regular text in columns ef7bcf0
- [FEATURE] Allow html entities in carousel header f043d60
- [FEATURE] Colorize text selection in primary color 9430c1e
- [FEATURE] Make imported font weights of google webfonts editable 37658b8
- [FEATURE] Add transition option to switch from fade to slide - #356 #347 7da14da
- [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356 d2b23d1
- [!!!][FEATURE] Add sections to visually group elements eedb60d
- [!!!][FEATURE] Adjust make footer color configurable 9001189
- [!!!][FEATURE] Add support for google webfonts - fixes #115 7d58ac6
- [!!!][FEATURE] Add support for spacer in menu processor - fixes #335 5d0a76c
- [FEATURE] Add content element for vimeo and youtube videos d36a8b2
- [FEATURE] Clear less cache when all caches are cleared ad695e0

## TASK
- [TASK] Optimize html output 63fa499
- [TASK] Update dependencies bcfd9ef
- [TASK] Add instruction to clear initial TypoScript (#420) 5cd4525
- [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 93e55e8
- [TASK] Update changelog schema 82be428
- [TASK] Optimize travis and composer configuration for automatic ter uploading ad98cd5
- [TASK] Add TYPO3 8 dev-master to issue template 6deb278
- [TASK] Add GitHub pull request template 0bb032e
- [TASK] Add GitHub issue template 722b442
- [TASK] remove uniqueLinkVars (#407) 7e79b77
- [REVERT][TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 4921d82
- [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5 7537983
- [TASK] Streamline php_cs fixer configuration with TYPO3 core fb6467b
- [TASK] Add checks for TYPO3_MODE to all tca override files configuration files 60beeb9
- [TASK] Throw exception if invalid arguments are passed to menu processor 8979cb4
- [TASK] Drop IE8 and IE9 support for background images in carousel 53ea6d2
- [TASK] Always trim assigned variables in var viewhelper 62e8870
- [TASK] Streamline position of columns for images and media to match textpic and textmedia af89966
- [TASK] Use shorthand array syntax in custom record tca b74db02
- [TASK] Do not set links bold in navigation bar 25797b0
- [TASK] Remove obsolete use statement 82e3c2a
- [TASK] Update menu templates to use the generated links and targets from menuDataProcessor 9cfb365
- [TASK] Replace f:link.page with static link (#370) 1ce0019
- [TASK] Exclude fixed navbar from scrolling to anchor eae382e
- [TASK] Add border between same sections 0946712
- [TASK] Allow html entities for content element header f992024
- [TASK] Remove obsolete constants b7b67d5
- [TASK] Update modernizr to 3.3.1 15a6926
- [TASK] Adjust section size 1fa43ee
- [TASK] Move icon selector to new tab to have enough space for large icon sets - relates #357 19d1590
- [TASK] Move icon registration for text with icon to itemsProcFunc - relates #357 c43ab1e
- [TASK] Remove unnessesary margin for last element in texticon content 1cb56ab
- [TASK] Remove dependency to glyphicons in carousel control - relates #356 8b1ae0a
- [TASK] Move carousel controls to partials - relates #356 9a573c1
- [TASK] Adjust indentions 145e164
- [TASK] Enable default and rename current to normal to ensure it can be overridden without removing the normal template 83baee4
- [!!!][TASK] Reintroduce "no frame" option - fixes #319 f2b06d7
- [TASK] Correct indention according to PSR2 89cb1f8
- [TASK] Do not exclude composer.json from export 7827744
- [TASK] Add CType as class to outer content element frame 86306a4
- [TASK] Add scaling for text-icon 8f982e4
- [TASK] Scale headlines on smaller devices 2fff83a
- [TASK] Use dataprocessors instead of viewhelpers for carousel rendering 468c5ad
- [TASK] Scale margin of frames 148b159
- [TASK] Move page class and id from section to bodytag 1740c47
- [TASK] Remove override for hover link decoration and use bootstrap variables instead - fixes #321 b714e05
- [TASK] Split tt_content overrides cde7cf0
- [TASK] Optimize images 9ae55e7
- [TASK] Use correct icons for tt_content imageorient palette - fixes #352 10c8ce0
- [TASK] Remove bower from travis tests eb7036d
- [TASK] Include photoswipe via npm instead of bower 96c2a40
- [TASK] Include hammerjs via npm instead of bower 283fce8
- [TASK] Include bootstrap via npm instead of bower 9f8820d
- [TASK] Update jquery to 2.2.4 389afc8
- [TASK] Update hammer.js to 2.0.8 cda5f1e
- [TASK] Update grunt 6af9bba
- [TASK] Correct composer requirements for TYPO3 9a43942
- [TASK] Remove unit tests from travis d5c2045
- [TASK] Fix Travis 2 374250e
- [TASK] Add color option to phpunit for travis 000d0d8
- [TASK] Add typo3 unit tests to travis ad0828b
- [TASK] Remove version from composer.json to prefer git tags dfe05c9
- [TASK] Adjust editorconfig b58e629
- [TASK] Add changelog for release 7.0.0 b8fe3c7
- [TASK] Add missing changelog entries for 7.1.0 3ceaaf1
- [TASK] Enable basic frontend editing 00d42a0
- [TASK] Add missing css fixes for #325 c49042d
- [TASK] Accessibility - fix of landmark error added role and aria- labelledby attribute c733ffd
- [TASK] Accessabiliy - added role navigation to breadcrumb bef517e
- [TASK] Accessibility - delete role contentinfo because you cant nest the same landmark in itself 9a5a6a8
- [TASK] Accessibility - correction of landmark a2810cb
- [TASK] Accessibility - Add link title attributes to logo constants, setup and html 2c9ee0e

## BUGFIX
- [BUGFIX] Add missing icon for text & media missing - fixes #417 ec64324
- [BUGFIX] Adapt link tag parsing for RTE fields 46697bd
- [BUGFIX] Move class alias for menu processor to localconf to ensure correct loading a04a6c7
- [BUGFIX] Ensure that variables are not converted to strings by variable viewhelper cdd2005
- [BUGFIX] Use correct layout (#408) 72bb577
- [BUGFIX] Correct position of carousel with fixed transparent header c0c3cc5
- [BUGFIX] Ensure that navbar-collapse has a maxheight if menu is fixed b698328
- [BUGFIX] Enforce checkout with linux lf consistent over all plattforms 6886bc8
- [BUGFIX] Respect show in section menus option for pages in section index menu 0dff070
- [BUGFIX] Use smooth scroll only on elements that have an hash... (#398) a91373e
- [BUGFIX] Move temp folder back to root of typo3 temp dd66961
- [BUGFIX] Remove double imagecols field in showitem configuration 485ab96
- [BUGFIX] Workaround variable name cut off in CMS8 - fixes #388 b27d017
- [BUGFIX] Use string to identify bootstrap_package for adding static template ed63827
- [BUGFIX] Allow non ID values for language fields to avoid errors on mysql strict mode f46a631
- [BUGFIX] Correct sql definitions for bodytextfields for carousel, accordion and tab content element item 4b85507
- [BUGFIX] Correct indention of sql definition 0645bb3
- [BUGFIX] Correct teaser sql field definition f1b42b4
- [BUGFIX] Move TCA change in ext_tables.php to Configuration/TCA/Overrides (#389) e089216
- [BUGFIX] Avoid specific DBMS literals in database queries (#384) c0ba786
- [BUGFIX] Fix inline documentation of MenuProcessor (#369) 64f9807
- [BUGFIX] Correct dependency for namelesscoder/typo3-repository-client bcddcaf
- [BUGFIX] Correct positioning of carousel when header is fixed cc39afc
- [BUGFIX] Correct case error in ionicons template 8ac3100
- [BUGFIX] Use correct less variable in font-family-base 9553484
- [BUGFIX] Correct position of carousels on sticky header 566d135
- [BUGFIX] Add missing active state to stickyheader 90fb0b2
- [BUGFIX] Correct navbar z-index in combination with fullscreen carousel in border column e6cc5ab
- [BUGFIX] Ensure color for headlines is correclty inherited in footer sections 446435f
- [BUGFIX] Correct output of texticon if no icon is selected aa388a2
- [BUGFIX] Ensure carousel headline color is inherited eb894e1
- [BUGFIX] Remove duplicate case in content element layout c2db076
- [BUGFIX] Correct paragraph rte classes c04e2b0
- [BUGFIX] Fix tab elements missing on slided content ac12a51
- [BUGFIX] Fix carousel elements missing on slided content a994f77
- [BUGFIX] Fix accordion elements missing on slided content ddaab8b
- [BUGFIX] Correct texticon content element rendering with default layout - fixes #336 5fb24e9
- [BUGFIX] Correct PSR-2 issues 08f6994
- [BUGFIX] Tabs, Accordion, and Carousel Items not referencing files on sys_file_reference and sys_refindex - fixes #349 a39c6bb
- [BUGFIX] Bugfix/menuprocessor (#354) 9413d78
- [BUGFIX] Prevent double escaping of menu titles 58824f9
- [BUGFIX] Remove vendor dir from php lint tests 63909ec
- [BUGFIX] Load form configuration only if ext:form is installed e39df3f
- [BUGFIX] Respect padding in equalheight script a8bb806
- [BUGFIX] Correct overlapping of content elements with indention - fixes #325 9b16ef3
- [BUGFIX] Corrected label for attribute 17bf663
- [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options bf80fe3

## MISC
- "usind" is wrong 0459bd3
- Correct php-cs-fixer command 0a22336

# 7.0.0

## BREAKING
- [!!!][TASK] Send cache headers per default 9b9f945
- [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other 5ecadef
- [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor 22d60c8
- [!!!][TASK] Disable link to top bd62ef8
- [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts 1761622
- [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default fe5b5b8
- [!!!][TASK] Drop IE8 support c9a9ffb
- [!!!][FEATURE] Register optional PageTS config files e9caa18
- [!!!][TASK] Remove some 6.2 specific fallbacks 8ade18a
- [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4 569df45
- [!!!][TASK] Drop TemplateFileResolver fallback for 6.2 d70ee66
- [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now dd81e0c
- [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev 0bc1499

## FEATURE
- [FEATURE] Remaining PageTS templates are configurable 7806d37
- [FEATURE] Allow to disable footer-section with Typoscript constant. 561cb0e
- [FEATURE] Allow photoswipe to be opened by url params 317032b
- [FEATURE] Add PhotoSwipe as lightbox a00e011
- [FEATURE] Thumbnail Menu b6bdc42
- [FEATURE] Include records without default translation in content select 9ffce33
- [FEATURE] Allow media content in accordion a16b625
- [FEATURE] Allow media content in tabs 9ccf082
- [!!!][FEATURE] Register optional PageTS config files e9caa18

## TASK
- [TASK] Set defaults for backend configuration 42001a9
- [TASK] Remove backend_layout upgrade wizard bdd51ad
- [TASK] Update hammerjs to 2.0.6 a2f2e59
- [TASK] Update jQuery to 2.2.1 977a997
- [TASK] Update bootstrap to 3.3.6 fa1f19f
- [TASK] Update oyejorge/less.php to 1.7.0.10 4a28bad
- [TASK] Remove unneeded rte_transform options 070ad6c
- [TASK] Optimize export b7012da
- [TASK] Correct accordion rendering 444df86
- [TASK] Correct tab rendering when no media is selected f3a4be1
- [TASK] Remove realurl autoconfiguration in preparation for realurl 2 b44a798
- [TASK] Add TYPO3 branch for 7.6 and exclude php versions < 7 on master 34640fd
- [TASK] Add php7 to travis 9f51a7e
- [TASK] Fix typo 89906d1
- [TASK] RTE: Classes for links, see benjaminkott#281 55c4a1e
- [TASK] Add note to vagrant box 5ddf090
- [!!!][TASK] Send cache headers per default 9b9f945
- [TASK] Update jQuery to 2.2.0 bee6955
- [TASK] Test asset pipe on travis 91496d3
- [TASK] Fix Code according to CGL 9a20304
- [TASK] Add php cs fixer config a334f7f
- [TASK] Add TYPO3 CMS 8 as compatible version ccbbd11
- [TASK] Split source and distribution javascript files and use static paths 291e83b
- [TASK] Adjust frontend login configuration 4182473
- [TASK] Add basic configuration and template overrides for indexed_search 9bb70a9
- [TASK] Add notice about content rendering extensions 1a479e1
- [TASK] Add header palette to cType list 7d4cb61
- [TASK] Use default layout as identifier when not backend_layout is selected fc228b0
- [TASK] Use use titlefield instead of raw data in menus - fixes #273 36b9428
- [TASK] Add escaped class to example in lib.dynamicContent 0217d68
- [TASK] Use fluidtemplate for languagemenu rendering 35c2ced
- [TASK] Use fluidtemplate for breadcrumb rendering 51b4049
- [TASK] Use fluidtemplate for mainnavigation rendering f399864
- [TASK] Use fluidtemplate for subnavigation rendering a6b62f1
- [TASK] Add configuration for felogin 57e2acc
- [TASK] Remove unneeded typo3_mode check b772f39
- [TASK] Add textmedia content element aa91cb0
- [TASK] Add typoscript parse functions 7cb7fa1
- [TASK] Add basic FluidTemplate for mailform and set paths abae4dc
- [TASK] Add FluidTemplate for list 540e7df
- [TASK] Add typoscript setup as content rendering template 9b06797
- [TASK] Add FluidTemplate for shortcut bade03a
- [TASK] Add description to menu processor d417401
- [TASK] Add FluidTemplate for menus 37676d7
- [TASK] Move uploads to typical page content tab 0e4fe0b
- [TASK] Remove unnessesary adjustment of the header palette 34483ee
- [TASK] Remove leftover mention of css_styled_content cc096ca
- [TASK] Add FluidTemplate for uploads content element 06f96ad
- [TASK] Add TCA and wizard for content element div 40ceba9
- [TASK] Add TCA and wizard for content element html 5e20f7f
- [TASK] Add content element wizard items for table a2a3a12
- [TASK] Add FluidTemplate for table content element eee3c63
- [TASK] Add TCA for content element bullet list 4739632
- [TASK] Enable header position again 1257178
- [TASK] Enable section frame again feaf2e3
- [TASK] Add TCA for content element header fb6ba2a
- [TASK] Add TCA for content element image dc99388
- [TASK] Add content element wizard items for header, text, textpic 455cbdb
- [TASK] Add TCA for content element textpic bd201a5
- [TASK] Add TCA for content element text 863c9fd
- [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other 5ecadef
- [TASK] Add case for tt_content rendering 2f6db37
- [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor 22d60c8
- [TASK] Drop experimental OnePage setup b828197
- [TASK] Flatten content element setup and add layouts and sections a110a61
- [TASK] Several adjustments ce1abd1
- [TASK] Make css adjustments b9f023b
- [TASK] Remove unnessesary column classes a7f894e
- [TASK] Move section frames to fluid d5c1071
- [!!!][TASK] Disable link to top bd62ef8
- [TASK] Add FluidTemplate for image content element ba7d160
- [TASK] Flatten content element rendering b418c7f
- [TASK] Steamline header usage templates 6e0a882
- [TASK]  Add FluidTemplate for image content element bc5183e
- [TASK]  Add FluidTemplate for textpic content element df93601
- [TASK]  Add FluidTemplate for text content element c032f2c
- [TASK]  Add FluidTemplate for header content element a43eb90
- [TASK]  Add FluidTemplate for bullets content element c39d30b
- [TASK] Add FluidTemplate for html content element 5bbc988
- [TASK] Remove dependency to styles.content.get definition 8aa6302
- [TASK] Add FluidTemplate for divider content element c13ffdd
- [TASK] Migrate reference to "wizard_element_browser" to new "wizard_link" - fixes #258 7f11f4d
- [TASK] Harden template names for page module previews 3db1711
- [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts 1761622
- [TASK] Use dataprocessing in listgroup content element 4fcbcbf
- [TASK] Use fluid template name for panel content element 737797d
- [TASK] Use fluid template name for list group content element f5c0260
- [TASK] Use fluid template name for external media content element 3fd77ae
- [TASK] Use fluid template name for default content element 64142fc
- [TASK] Use fluid template name for tab content element d370a03
- [TASK] Use fluid template name for carousel content element f3e9c38
- [TASK] Use fluid template name for accordion content element 5e2836f
- [TASK] Move css_styled_content typoscript configuration 2c6bde2
- [TASK] Extract lib.dynamicContent from Base.ts 174fa1b
- [TASK] Remove iconInOptionTags and noIconsBelowSelect - fixes #243 4c39c52
- [TASK] Add preview for content element list-group 5024221
- [TASK] Reduce size of external media preview 729d4a8
- [TASK] Update less.php to 1.7.0.9 4adf395
- [TASK] Update jQuery to 2.1.4 f93cb03
- [TASK] Add recommended apache modules e42c4e6
- [TASK] Enable async loading for modernizr and windowsphone-fix 823460f
- [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default fe5b5b8
- [!!!][TASK] Drop IE8 support c9a9ffb
- [TASK] Harden expression in PreProcessHook 2f0d669
- [TASK] Register content element listgroup icon f795415
- [TASK] Register content element external-media icon 72c2929
- [TASK] Register icon for element accordion-item 500bf8e
- [TASK] Adjust icons for element carousel-item types 73145e5
- [TASK] Register icons for element carousel-item types 13eb28d
- [TASK] Register content element carousel icon 37c46b2
- [TASK] Register content element accordion f66d935
- [TASK] Register content element panel 3db5c2a
- [TASK] Register content element texticon b4734d9
- [TASK] Register content element tab-item icon 92e017a
- [TASK] Register content element tab icon 286d441
- [TASK] Harden expression in ExternalMediaUtility bffb89b
- [!!!][TASK] Remove some 6.2 specific fallbacks 8ade18a
- [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4 569df45
- [!!!][TASK] Drop TemplateFileResolver fallback for 6.2 d70ee66
- [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now dd81e0c
- [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev 0bc1499
- [TASK] Add preview for external media content element in page module - CMS7 only e4bbd6c
- [TASK] Keep additional params for youtube urls 8c96100
- [TASK] Add psr-4 autoload config to ext_emconf 2a4aa97
- [TASK] add classes to containers useful to better select them with CSS and Javascript 8ef1ecd
- [TASK] fix tag closure for HTML5 head meta and link 1a00748
- [TASK] breadcrumb: include the homepage link at the beginning of the breadcrumb. b751194
- [TASK] breadcrumb: for the content of the links use alternative navigation title if it is set, else use page title. 4e01a9e

## BUGFIX
- [BUGFIX] Remove skin setting from RTE configuration to ensure correct file is loaded in cms 8 3a6d10a
- [BUGFIX] Disable output escaping for viewhelpers c8b881a
- [BUGFIX] Remove spaceless viewhelper cd18e0e
- [BUGFIX] gallery in 2 cols also for devices >= 768px and < 992px be97457
- [BUGFIX] use the correct Typoscript constant in setup 3a5c5a7
- [BUGFIX] Correct grunt watch tasks 49abd2e
- [BUGFIX] Add header to cType List 5c64e39
- [BUGFIX] Respect sorting for tab items 2f4d942
- [BUGFIX] Respect sorting for accordion items 4e1895c
- [BUGFIX] Correct PSR2  issue d2f3858
- [BUGFIX] Add missing column overrides for text and textpic content elements 0e750f0
- [BUGFIX] Check if content element type exists before merging f59acad
- [BUGFIX] Merge type configuration in TCA instead of overriding fef0fc6
- [BUGFIX] Add missing comma in uploads field selection 9a6506c
- [BUGFIX] Correct accordion content element markup 3e87fca
- [BUGFIX] Add missing showIconTable setting for field icon 142a040
- [BUGFIX] Adjust imagepath and wizard settings for carousel links 003489f
- [BUGFIX] Adapt moved language file b44bcf3
- [BUGFIX] Add missing renderTypes to tt_content fields 2bd9495
- [BUGFIX] Add missing renderTypes to tab item f460fa7
- [BUGFIX] Add missing renderTypes to accordion item 553f48f
- [BUGFIX] Add missing renderTypes to carousel item 39ec027
- [BUGFIX] Correct typoscript paths 534fa91
- [BUGFIX] Add missing link for media type image in tabs 3ddad62
- [BUGFIX] Add missing link for media type image in accordion a9bf6df
- [BUGFIX] Correct composer branch-alias 353e3b5
- [BUGFIX] Make links visible in jumbotron - fixes #248 9bf49a1
- [BUGFIX] Fix behaviour of strictly allowed RTE classes 3bef8e0
- [BUGFIX] Add the table colspan and rowspan attributes to allowed attributes in RTE configuration 46f24a1
- [BUGFIX] Correct height operator for opengraph image - fixes #227 0da305f

## MISC
- Fix more typos / grammar issues ce3f8df
- Fix typos found by codespell 3b25d80
- Followup: Use spaces instead of tabs a50ed6e
- Fix grammar 62ade32
- Removed duplicate "List Group" entry 2edeebc
- add static to getVariablesFromConstants() because of deprecation notice b917eae
- Add crop to carousel background image fbbe0cf
- Use settings instead of variables for configuration in FLUIDTEMPLATE f0966b5
- [WIP] Image rendering c596fd7
- [WIP] Adjust Tab Rendering 663af6a
- [CLEANUP] Bootstrap Package external media item 01a006c
- [CLEANUP] Bootstrap Package list group item 66e3090
- [CLEANUP] Rendering definition for default content element ea5db05
- [CLEANUP] Remove unused header partial bec55b6
- Add namespace to ext_update class 1c2db8b
- Update constants.txt 6c19cf4
- Update CssStyledContent.txt 57a6a17
- Add data-preload to force image preload fddd5e2
- Merge remote-tracking branch 'upstream/master' 3205507
- [CLEANUP] Remove unused file 12e6e6e
- [CLEANUP] Correct email in bower setup 0971165
- Merge remote-tracking branch 'upstream/master' into disable-meta-section e1df075
- Add mod_filter to apache recommendations 7998c5b
- [CLEANUP] Correct Readme 7cc4fee
- [CLEANUP] PSR-2 stuff f847569
- [CLEANUP] Remove unused use statements in install service 1cb8469
- [TROLL] Update copyright text fba1805
- [CLEANUP] Initialize fieldsToUpdate in ext_update 020bf69
- Merge remote-tracking branch 'upstream/master' into disable-meta-section b91e71d
- [CLEANUP] Remove unused Hooks and Xclass 7f2b9d7
- [CLEANUP] Remove TYPO3 6.2 and PHP5.3 and PHP5.4 from Travis CI 7897a86
- [CLEANUP] Remove unused use statements in realurl autoconfig a75a027
- bring metaSection enable setting to constants 83088bb
- Update setup.txt with default meta section enabled fb68e00
- change Footer.html to disable meta output 100a108
- Fixed typos 2cf4e9b
- Fixed typos aa88fbb
- Correction of minor typo db95d9a
- Force preload images to allow print 1b5581d
- Add useful RTE buttons fbb6fa1

# 6.2.15

## TASK
- [TASK] Add travis-ci build status image 3e5f00f
- [TASK] Remove unused coverage from travis f0ef2c5
- [TASK] Add phpcs as dev dependency to composer.json 50d372c
- [TASK] Remove TYPO3 dependencies and conflicts from composer.json 3dc0c1d
- [TASK] Add travis-ci support b103871
- [TASK] Unify license comment 1737339
- [TASK] Static declaration should come after the visibility declaration aaad7a4
- [TASK] Apply PSR-2 a8a589e
- [TASK] Add scrutinizer code style fixer for psr-2 023b985
- [TASK] Convert tabs to spaces 2 42381a0
- [TASK] Convert tabs to spaces 82ee78a
- [TASK] Add scrutinizer psr-2 settings 4dac59f
- [TASK] Add braces in condition ab4dcaf
- [TASK] Add code quality section to readme e4e3e9b
- [TASK] Add YML to editorconfig 82bae49
- [TASK] Add scrutinizer configuration 756f96a
- [TASK] Change TYPO3 composer dependency to typo3-cms 6c9570f
- [TASK] Update less.php to 1.7.0.5 d359261

## BUGFIX
- [BUGFIX] Ignore PSR-2 check for legacy core classes aa58782
- [BUGFIX] Use camel caps format for functions in external media utility d176687
- [BUGFIX] PSR-2 Violations f15a896
- [BUGFIX] Add composer self-update to travis 914a425
- [BUGFIX] Correct indention da8c97d
- [BUGFIX] Use correct assignment for TypoScript value 1e79873
- [BUGFIX] Make class.ext_update.php work on PHP  b8d89b1
- [BUGFIX] There is no boostrap package 1cf9b92

## MISC
- Scrutinizer Auto-Fixes ffe5e3e
- Scrutinizer Auto-Fixes 3d6b342
- Scrutinizer Auto-Fixes 6bd65dd

# 6.2.14

## FEATURE
- [FEATURE] Add advanced Open Graph support, support new meta notation for 7.4 2734c16

## TASK
- [TASK] Add migration information for backend layout prefix change ad9f928
- [TASK] Add missing changelog for 6.2.12 and 6.2.13 fc482ca
- [TASK] Update TypoScript template mapping for backend layouts 5162b17
- [TASK] Add update script to migrate old backend layout prefix to new prefix in table pages fe57d19
- [TASK] Disable BackendLayoutDataProvider for TYPO3 versions below 7.4 and adapt registration to core provider prefix for PageTS d467590
- [TASK] Move column labels for border, normal, left, right to bootstrap_package, files moved in CMS 7 b90c08d
- [TASK] fix whitespaces 99c8266
- [TASK] Add 'active' class for shortcuts in sub navigation eb23a66

## BUGFIX
- [BUGFIX] Use always $GLOBALS[TCA] f0f8c62
- [BUGFIX] fix missing TYPO3SEARCH_end marker b0bde8a

## MISC
- Update Index.rst 04d164d
- Rename index.rst to Index.rst 6347343
- Update Index.rst 9826f5a
- Create index.rst bf873ff

# 6.2.13

## TASK
- [TASK] Include css_styled_content and form in static template 4f031d5

## BUGFIX
- [BUGFIX] Remove leading slash from classnames in typoscript setup 92c7c21
- [BUGFIX] Restrict options for default tab to currently assigned items - fixes #197 287e8df

## MISC
- Fix 'overridden' typos 76a411b
- Multiple fixes to composer.json e27b03e
- Fix whitespace in ext_emconf.php e141e23

# 6.2.12

## BUGFIX
- [BUGFIX] Add missing static template for bootstrap package 9347264

# 6.2.11

## BREAKING
- [!!!][TASK] Remove compatibility to ext:themes through lack of resources 987c203
- [!!!][TASK] Cleanup deprecated template fallbacks 4b16e85
- [!!!][FEATURE] Add template fallback support 20ec25c
- [!!!][BUGFIX] Wrong path to font files - fixes #139 729e966
- [!!!][TASK] Make less files public available c43a35e
- [!!!][TASK] Move lightbox implemantation to a own file and remove main.js 305139f
- [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup f0bee94
- [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3 3f8f04c
- [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186 1f86122

## FEATURE
- [!!!][FEATURE] Add template fallback support 20ec25c
- [FEATURE] Make DynamicContent wrappable 45ffc2c
- [FEATURE] Add swipe support for carousels - fixes #161 94b74d5
- [FEATURE] Add new page type for popup usage without header and footer typeNum 1000 - fixes #70 1c50ebc
- [FEATURE] Enable support in lib.dynamicContent to support content from pid - fixes #185 8975391
- [FEATURE] Make breadcrumb enable treelevel configurable - fixes #191 78c19a7
- [FEATURE] Add TypoScript TYPO3 version condition aa24202
- [FEATURE] Add selectivizr to add CSS3 pseudo selector support to IE8 13d4410
- [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186 1f86122
- [FEATURE] Add carousel type backgroundimage - #188 8a1f183
- [FEATURE] Make carousel header layout configurable - #188 224287a
- [FEATURE] Add CSS status classes to content wrappers - #fixes 85 7d2c7c9
- [FEATURE] Add tab content element 993eb4f
- [FEATURE] Add external media content element for youtube and vimeo videos 02ec26f
- [FEATURE] New advanced constant to enable/disable CSS source mapping 77639ab

## TASK
- [TASK] Update Documentation for TypoScript constants ed01b96
- [TASK] Update Documentation 0eeeac6
- [!!!][TASK] Remove compatibility to ext:themes through lack of resources 987c203
- [TASK] Use TCA renderTypes - fixes #192 13ac5ee
- [!!!][TASK] Cleanup deprecated template fallbacks 4b16e85
- [TASK] Copy Bootstrap font files during build process 2f207e7
- [TASK] Update Bootstrap to 3.3.5 27d47b7
- [!!!][TASK] Make less files public available c43a35e
- [TASK] Use absRefPrefix = auto instead of baseURL in TYPO3 CMS 7 0e48e79
- [TASK] Add application context examples to .htaccess file 0d727e2
- [!!!][TASK] Move lightbox implemantation to a own file and remove main.js 305139f
- [TASK] Add hires extension icon 882bfb5
- [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup f0bee94
- [TASK] Add grunt watcher for JavaScript files a8aed62
- [TASK] Add RespondJs to Bower ad3b992
- [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3 3f8f04c
- [TASK] Include bootstrap with Bower and Grunt 40e4107
- [TASK] Add Grunt uglify for JavaScripts a761175
- [TASK] Add initial Grunt setup for RTE and precompiled theme d8881b3
- [TASK] Add less variables file to bootstrap theme db6a5c3
- [TASK] Unify namespace name in templates 3c4cec5
- [TASK] Make ContextualClassViewHelper compilable 328e359
- [TASK] Make FalViewHelper compilable a233f38
- [TASK] Make ExternalMediaViewHelper compilable fb7f968
- [TASK] Make VarViewHelper compilable 95d83e9
- [TASK] Make ExplodeViewHelper compilable 92eafd1
- [TASK] Make DataRelationViewHelper compilable 9e2c3f1
- [TASK] Remove leftover FormEngineViewHelper fc62a80
- [TASK] Make FlexFormViewHelper compilable bd5d285
- [TASK] Update jquery.responsiveimages.js b15ee41
- [TASK] Reintroduce css class for first headline in column rendering 0943467
- [TASK] Move custom content element renderings to typoscript folder 9ba2483
- [TASK] Cleanup extension declaration file to match documentation 848ec4e
- [TASK] Add individual icons for content elements in wizard 6767c33
- [TASK] Added missing description to Bootstrap elements 35a6156
- [TASK] Add field subheader to header palette of tt_content 7d6e5fc
- [TASK] Remove csc-firstHeader CSS class in lib.stdHeader ea2a529
- [TASK] Use references instead of hard copies in lib.stdheader 473ccd2
- [TASK] Use ExtensionManagementUtility in autoload.php - fixes #172 c2367fd
- [TASK] Update bootstrap to 3.3.4 791356d

## BUGFIX
- [BUGFIX] Add disablePageTsRTE option to extension configuration again e84055e
- [!!!][BUGFIX] Wrong path to font files - fixes #139 729e966
- [BUGFIX] Correct overflow problem 10a0d60
- [BUGFIX] Deprecation of page.includeJSlibs in TYPO3 CMS 7 9273d3e
- [BUGFIX] Ensure column CSS class is also set for imagecols set to 1 - fixes #138 566968e
- [BUGFIX] Set BackendLayouts columns correctly if PageTs is set via page record 9be5865
- [BUGFIX] Section Index content item produces incorrect links - fixes #150 61a3fc8
- [BUGFIX] Correct OnePage Markup bf4b181
- [BUGFIX] Add missing restore register in text with icon - fixes #174 c6f6594

## MISC
- slightly smarter TypoScript 825d4b2
- FLUIDTEMPLATE.templateName and templateRootPaths 193983b
- Update jquery.responsiveimages.js a066650
- Collision with jQuery width and height methods 10f0fbc
- Update jquery.responsiveimages.js 7ee19d4
- Update jquery.responsiveimages.js 8fddd3b
- Update jquery.responsiveimages.js 496e017
- Update jquery.responsiveimages.js a2bf2d3
- Event optimisation b0a54d6
- Fine tune jquery.responsiveimage.js cdefdf8
- Update jquery.responsiveimages.js 36b9703
- Update jquery.responsiveimages.js fe803ca
- Update jquery.responsiveimages.js 3ab416b
- Fix indents in tab feature fcef312

# 6.2.10

## FEATURE
- [FEATURE] New advanced constant to enable/disable the use of Typoscript constants as Less variables e01b136
- [FEATURE] new constant $page.logo.alt used to overwrite the default alt attribute of the logo image a7544c2
- [FEATURE] make site logo alt attribute configurable 5e1d06f
- [FEATURE] Disable automatic less compiling - fixes #162 1eef662

## TASK
- [TASK] Add changelog 2d3dc52
- [TASK] Refactor jquery.responsiveimages.js 0f90334
- [TASK] HTML5 markup for sub navigation - fixes #171 604ea24
- [TASK] Make RealUrl autoconfig compatible with the version from Helmut Hummel for 7.x 2033305
- [TASK] Protect configuration of extensions in default .htaccess c3e7601
- [TASK] Remove migration of realurl in favor of Helmut Hummels release for TYPO3 CMS 7.2 a598a4d
- [TASK] Carousel: allow to set the max width of background images 39d4685
- [TASK] Update oyejorge/less.php to 1.7.0.3 c29b622
- [TASK] Remove automatic cache clearing - fixes #126 35b81cc
- [TASK] Add slack to contact and communication 7e746fd
- [TASK] replaced  with  29b666b
- [TASK] Add admin panel config to typoscript constants 761bd5c
- [TASK] Update changelog in documentation 8813953

## BUGFIX
- [BUGFIX] Correct overlapping elements on centered image - fixes #113, #159 4cce784
- [BUGFIX] Correct media display for file links content element - fixes #164 0af8bc0
- [BUGFIX] fix for HTML5 markup validation b5776a1
- [BUGFIX] Missing container in default clean layout e6c0cf9
- [BUGFIX] Adjust language uids to match introduction database - fixes #135 863615c

## MISC
- Stop using deprecated XHTML cleaning 9aef524
- Allow "target" attribute inside  tags. 653bd30
- added "br" to "allowedTags" a44d88f
- [CLEANUP] Correct indention to CGL a7a74f0
- Modified footer and header 4aa5c42
- [Bugfix] fixes sorting on localized relations e57bc95
- Update FalViewHelper.php fe208bd
- [Bugfix] FalViewHelper.php 7769afe
- Update Base.ts 697bedc

# 6.2.9

## TASK
- [TASK] Update jquery to 1.11.2 e8822fc
- [TASK] Update modernizr to 2.8.3 559ff0c
- [TASK] Update less.php to current master d065a0b
- [TASK] Throw exception on less compile error 70249bf
- [TASK] Rise dependency of TYPO3 and css_styled_content version to 7.99.99 c056ffd
- [TASK] Add backend skin changes to the documentation 4d78373
- [TASK] Use realurl autoconfig hook instead of overriding every config 7d9fb37

## BUGFIX
- [BUGFIX] Remove problematic whitespace c7d6428
- [BUGFIX] Remove superfluous slash in font definition - fixes #132 115a9d5
- [BUGFIX] Classname must not start with a backslash in ext_conf_template.txt 095c2a1

## MISC
- Update Index.rst 4660037
- Use array_merge_recursive() instead ca4d032
- Don't overwrite existing configuration completely 18f1ca8

# 6.2.8

## TASK
- [TASK] Make realurl optional 6f92339
- [TASK] Remove e-mail from contact b162f60
- [TASK] Minify responsiveimages.js and and cleanup f8ad4af
- [TASK] Cleanup CGL c1956cf
- [TASK] Make removeDefaultJs configurable. fixes #105 aebd1fc

## BUGFIX
- [BUGFIX] Use correct rte transform in accordion textfield - fixes #67 21735bd
- [BUGFIX] Wrong calculation in news pagination - fixes #106 146a865
- [BUGFIX] Flashmessage queue throws error while installing - fixes #116 f0508a9

## MISC
- Update newContentElement.txt 94a1a16
- Update newContentElement.txt c7e27ab
- Update jquery.responsiveimages.js e40750d

# 6.2.7

## TASK
- [TASK] Include respond.js with conditional comment to work with static cache - fixes #101 66ce0a6
- [TASK] Cleanup CGL b5cd79d
- [TASK] Reformat all project-specific content to TYPO3.CMS CGL 7a86c36
- [TASK] Make getCompiledFile a static method - fixes #103 #104 6541519
- [TASK] Deprecate backend skin for CMS7 and provide new logos 279601a
- [TASK] Carousel needs to have background-image and background-color at the same time available c000a5b
- [TASK] Add .editorconfig file cf164b6

## BUGFIX
- [BUGFIX] Wrong colpos was used in layout "Default, Subnavigation Left and 2 Columns" fixes #98 5e0d274

## MISC
- Fix for columns in backend layout 14d4eb3
- Add 25/75 backend layout 7b676ed
- Add missing migrations for realurl cd23239
- Add migrations for realurl to be compatible with CMS 7.0 880b198
- Remove unused template variable - fixes #93 614a1eb
- typo df58daa
- Updated RTE configuration. Implemented a workaround to get enableWordClean work again. 884dc40
- Finish Hotfix-lead-text 7aebd4e
- Fixes Lead text in RTE that is not saved cause not in allowedClasses c0f69b3

# 6.2.6

## FEATURE
- [FEATURE] add composer.json 2c66881

## MISC
- Release 6.2.6 26b6ed9
- Correct colPos for left column on Layout: Default, Subnavigation Left and 2 Columns - fixes #62 51f177e
- Add Google Analytics tracking code anonymization - fixes #84 f8ff29b
- Adjust processing rules for rte 1b9b1c5
- Add missing styling for rte table contextual classes be860ad
- Enhance accessibility for the accordion 7540ed6
- Describe and enhance rte config, tables are now responsive by default, css classes have translations now 1217a36
- Fix role="main" position in 2 columns layout. 23bec27
- Add backend layout with 2 columns 50/50% 2784053
- Use DIR option instead of FILE to include backend layouts. 9b2c649
- Remove superfluous text "Bootstrap Package: " from layouts names. 8e5cfe1
- Exclude page also from search engine index if no_search is set to the page - fixes #69 e4529ff
- Enhance accessibility for the carousel 0db789b
- Adjustments to skip to content - resolves #63 f32ea4a
- Add marker for current year. Move replacements directly to the fluidtempalte - fixes #72 71163c1
- Add missing alt and title attributes on noscript fallback for image rendering - fixes #77 706df22
- TASK: Skip to content Resolves https://github.com/benjaminkott/bootstrap_package/issues/63 e8214f8
- Update bootstrap css file for the backend to 3.3.0 e3c8ba0
- Adjust gitignore 6e317ce
- Remove the automatic appending icons for content links de9f8ca
- Fix navbar-brand-image position f20efcf
- Fix Carousel fading in chrome 9938953
- Update Bootstrap to version 3.3.0 5091bd8
- Display Problems in IE8 for "width: 100% \9;" 618350d
- Move css files for the backend to avoid missunderstandings and add plain default bootstrap.min.css - fixes #61 84a357f
- Adjust language menu for smaller viewports - #65 7dbb159
- Adjust font-size and line-height for better readability bd77e0a
- We are always stable ;) 1d697bc
- Backendskin is not disabled correctly if option is set eb9a85e
- Add backend layouts for left navigation - fixes #62 5474be4
- Adjust carousel - fixes #51 1f1ac90
- Add missing space in news date format - fixes #59 3886f27
- Add caption alignment - fixes #58 bb49158
- Fix small typo e7a23a2
- Cleanup configuration for indention frames - fixes #57 13498ef
- Cleanup RTE config a5720c9
- Cleanup Tabs #52 b77c4ce
- Remove forgotten typoscript code for searchbar and login - #50 9035ae1
- Set cache period to 24h - fixes #55 17695a1
- Correct linkToTop rendering - fixes #54 242d37f
- Correct composer.json b44573a
- Move PARAMS before SOURCECOLLECTION for better HTML code readability. b319616
- Move img class to params for easier customization. 8b2704c
- Add basic google analytics settings aa7d6de
- Provide open graph image for social networks ddd18ee
- Cleanup flip ahead browsing for IE 672bd9c
- Correct dependency to TYPO3 version to ensure that the correct forms are loaded 5b12351
- Update composer.json e3c3bb9
- Fix dynamic rewrite base 31a8d99
- Implement a dynamic rewrite base solution reduce problems with some hosters e0cd37b
- Remove some image orient fields to avoid distraction 0375b12
- Remove unused link for the image in text with image - fixes #49 b6f1da7
- Avoid error if data for lib.dynamicContent is not provided as array e8e3389
- The title attribute remains empty in mainmenu of onepage variant - fixes #44 e8cd26a
- Allow link tag usage in html content element 7631b76
- Split theme less file fbe94f9
- Add new clean backend layout d64540c
- Add styling constants for ext:themes 354bd9d
- Provide options to disable parts of the auto included PageTs settings c02611b
- Cleanup 291515c
- Make Bootstrap Package run as a OnePage Website 676034f
- fix 'Boostrap' typos c17e975

# 6.2.5

## FEATURE
- [FEATURE] use SymLinksIfOwnerMatch in .htaccess 187c858

## MISC
- Release 6.2.5 c86a348
- Update Documentation 966bd58
- Add support for link "Edit me on Github" 858253e
- Fix workspace problem for related records #37 d2484b9
- Make main navbar position configurable 45db7c4
- Combine less files to avoid dublicate css definitions 9aec777
- Allow Backend Layouts to be configured via PageTsConfig 3d72ea3
- Cleanup less.php integration - fixes #32 1f50d81
- Correct display of tx_form - hopefully 60f71fc
- Correct type of baseURL typoscript constant dc73203
- Correct default icon-font-path to avoid problems if page is deployed in a folder - fixes #31 bd33fa1
- Update jQuery version to 1.11.1 1f78758
- Disable imageheight and imagewidth for textpic and image content elements to avoid wrong rendering e2e19f6
- Avoid problems with hardcoded resource links in login template, remove overriding - fixes #28 16a6f99
- Correct label definitions for content elements, $_EXTKEY is not available here - fixes #27 d9b5c10
- Add conflict to dyncss to ensure correct less rendering 605db34
- Cleanup spaces 5325148
- Images displayed in one column have no restriction to current layout column - fixes #19 4cbf85f
- Update Bootstrap to 3.2.0 adef7ec
- Correct file locations 58180a1
- Fix bootstrap less compiler if flattensetup is not available - fixes #20 25fce39
- Cleanup bootstrap file locations e55d0f1
- Move bootstrap js to separate folder f016b28
- Removing symlink option due problems on windows apache with symlinks - affects #25 538ef39
- Add missing default variables file for bootstrap 46147ae
- Remove backend style module - introduce typoscript constants instead to provide a more flexible less configuration - fixes #5 #20 2f0b0ce
- Update less.php 4160b7a
- Move TCA c6cfb0e
- Text and image - center top was not centered - fixes #21 18e5cb3
- Add missing bodytext field to carousel "text and image" and enable rte for accordion - fixes #23 80993ed
- Allow table in RTE a164e5a
- Adjust LogoView to make it a bit more secure ed55a6f
- added fluidpages to conflicts fixes #18 e8a32c0
- Add link to the complete teaser item and fix the relations 2967c55
- Fix typo dfa694c
- Make it possible to enable backend skin if themes is loaded. 2ef1c55
- Make bootstrap_package compatible with themes (part 2) fdfa43a
- Correct version number 661886d
- Cleanup formatting 1e422c8
- Make bootstrap_package compatible with themes (part 1) 77414e6
- Correct types in constants a8879cd
- Add TYPO3 version to sitename in backend header 55b2400
- Correct wizard registration d97a9d4
- Add links for carousel images in FE, optimize fal fields. fixes #15 55e18f4
- Update Accordion.html 342917c
- add missing text_color field to carousel textwithimage #10 971cc24
- carousel interval and wrap needs to be configurable #10 5e1bb9c
- wrong label for header in carousel textwithimage #10 daff0c1
- cleanup wrong committed stuff before 331e51f
- - cleanup wrong formatting in base.ts - add chash for pagination to prevent cashing issues described in #9 fc3b6b8

# 6.2.4

## MISC
- ter does not allow long version numbers ... 5237090
- ter ist fucking up ;( a4608ef
- set version to 6.2.2.2 c7aaf3c
- Add Basic Documentation a3fb4c4
- correct version to 6.2.2.1 and adjust description 54518d6
- Hide navigation toggle if no subpages exist. 84c7b73
- Fix the height of the header if no subpages available a57cbc3
- Provide an example .htaccess file after installation - fixes #3 da841fe
- tabs and spaces ... 72dbbae
- Remove absRefPrefix und add automatic baseURL determination instead. This will ensure that the links and pages are correct if you are running TYPO3 in a subfolder. d3bf38b
- Change README to .rst format. Change spelling and wording. 3bbfa46
- Change README to .rst format. Change spelling and wording. b79952a
- image fix IE 4e6ccbc
- set version to 6.2.3 for further development 4f90676
- cleanup main.js c407bab
- remove rootpage id from realurl due complication with import 66d905d
- Make absRefPrefix configurable, this is needed when typo3 is running in a subfolder 95e1772
- set version to 6.2.2 for further development 65aac30
- Remove generated variables from repository 174e9fb
- Add RealUrl Config 93f4c39
- Update description 27e6edc
- Update README.md 1667b22
- set version to 6.2.1 for further development 536466a
- set version to 6.2.0 - initial release in ter 31783df
- RC 6.2 eecd180
- Initial commit 8a43508

