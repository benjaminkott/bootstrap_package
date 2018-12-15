# 6.2.16

## BUGFIX
- [BUGFIX] Only check for TYPO3 6.2 and 7.6 f6bd6017
- [BUGFIX] Remove vendor dir from php lint tests 59c0ac51

## MISC
- [SECURITY] 6.2.16 security changes e0cbfad1

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

