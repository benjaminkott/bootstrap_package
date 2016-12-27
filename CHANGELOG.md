# 7.0.0

## RELEASE
- [RELEASE] Release of 7.0.0 2bc505c

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

## RELEASE
- [RELEASE] Release of 6.2.15 9b9fdf1

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

## RELEASE
- [RELEASE] Release of 6.2.14 4ffb96a

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

## RELEASE
- [RELEASE] Release of 6.2.13 639545e

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

## RELEASE
- [RELEASE] Release of 6.2.12 8b57118

## BUGFIX
- [BUGFIX] Add missing static template for bootstrap package 9347264

# 6.2.11

## RELEASE
- [RELEASE] Release of 6.2.11 51972e5

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

## RELEASE
- [RELEASE] Release of 6.2.10 75fe900

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

## RELEASE
- [RELEASE] Release of 6.2.9 4e3aede

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

## RELEASE
- [RELEASE] Release 6.2.8 1f41eb1

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

## RELEASE
- [RELEASE] Release 6.2.7 a11d1db

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

