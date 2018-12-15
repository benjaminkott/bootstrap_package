.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _changelog:

Changelog
---------

The changelog represents the commits that have been done since the last version
excluding followups. Please have a look at the release notes to get more detailed
Information.

.. tabularcolumns:: |r|p{13.7cm}|

+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Version    | Changes                                                                                                                                                                    |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.16     | - [BUGFIX] Only check for TYPO3 6.2 and 7.6                                                                                                                                |
|            | - [BUGFIX] Remove vendor dir from php lint tests                                                                                                                           |
|            | - [SECURITY] 6.2.16 security changes                                                                                                                                       |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.15     | - [TASK] Add travis-ci build status image                                                                                                                                  |
|            | - [TASK] Remove unused coverage from travis                                                                                                                                |
|            | - [TASK] Add phpcs as dev dependency to composer.json                                                                                                                      |
|            | - [TASK] Remove TYPO3 dependencies and conflicts from composer.json                                                                                                        |
|            | - [TASK] Add travis-ci support                                                                                                                                             |
|            | - [TASK] Unify license comment                                                                                                                                             |
|            | - [TASK] Static declaration should come after the visibility declaration                                                                                                   |
|            | - [TASK] Apply PSR-2                                                                                                                                                       |
|            | - [TASK] Add scrutinizer code style fixer for psr-2                                                                                                                        |
|            | - [TASK] Convert tabs to spaces 2                                                                                                                                          |
|            | - [TASK] Convert tabs to spaces                                                                                                                                            |
|            | - [TASK] Add scrutinizer psr-2 settings                                                                                                                                    |
|            | - [TASK] Add braces in condition                                                                                                                                           |
|            | - [TASK] Add code quality section to readme                                                                                                                                |
|            | - [TASK] Add YML to editorconfig                                                                                                                                           |
|            | - [TASK] Add scrutinizer configuration                                                                                                                                     |
|            | - [TASK] Change TYPO3 composer dependency to typo3-cms                                                                                                                     |
|            | - [TASK] Update less.php to 1.7.0.5                                                                                                                                        |
|            | - [BUGFIX] Ignore PSR-2 check for legacy core classes                                                                                                                      |
|            | - [BUGFIX] Use camel caps format for functions in external media utility                                                                                                   |
|            | - [BUGFIX] PSR-2 Violations                                                                                                                                                |
|            | - [BUGFIX] Add composer self-update to travis                                                                                                                              |
|            | - [BUGFIX] Correct indention                                                                                                                                               |
|            | - [BUGFIX] Use correct assignment for TypoScript value                                                                                                                     |
|            | - [BUGFIX] Make class.ext_update.php work on PHP                                                                                                                           |
|            | - [BUGFIX] There is no boostrap package                                                                                                                                    |
|            | - Scrutinizer Auto-Fixes                                                                                                                                                   |
|            | - Scrutinizer Auto-Fixes                                                                                                                                                   |
|            | - Scrutinizer Auto-Fixes                                                                                                                                                   |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.14     | - [FEATURE] Add advanced Open Graph support, support new meta notation for 7.4                                                                                             |
|            | - [TASK] Add migration information for backend layout prefix change                                                                                                        |
|            | - [TASK] Add missing changelog for 6.2.12 and 6.2.13                                                                                                                       |
|            | - [TASK] Update TypoScript template mapping for backend layouts                                                                                                            |
|            | - [TASK] Add update script to migrate old backend layout prefix to new prefix in table pages                                                                               |
|            | - [TASK] Disable BackendLayoutDataProvider for TYPO3 versions below 7.4 and adapt registration to core provider prefix for PageTS                                          |
|            | - [TASK] Move column labels for border, normal, left, right to bootstrap_package, files moved in CMS 7                                                                     |
|            | - [TASK] fix whitespaces                                                                                                                                                   |
|            | - [TASK] Add 'active' class for shortcuts in sub navigation                                                                                                                |
|            | - [BUGFIX] Use always $GLOBALS[TCA]                                                                                                                                        |
|            | - [BUGFIX] fix missing TYPO3SEARCH_end marker                                                                                                                              |
|            | - Update Index.rst                                                                                                                                                         |
|            | - Rename index.rst to Index.rst                                                                                                                                            |
|            | - Update Index.rst                                                                                                                                                         |
|            | - Create index.rst                                                                                                                                                         |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.13     | - [TASK] Include css_styled_content and form in static template                                                                                                            |
|            | - [BUGFIX] Remove leading slash from classnames in typoscript setup                                                                                                        |
|            | - [BUGFIX] Restrict options for default tab to currently assigned items - fixes #197                                                                                       |
|            | - Fix 'overridden' typos                                                                                                                                                   |
|            | - Multiple fixes to composer.json                                                                                                                                          |
|            | - Fix whitespace in ext_emconf.php                                                                                                                                         |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.12     | - [BUGFIX] Add missing static template for bootstrap package                                                                                                               |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.11     | - [!!!][TASK] Remove compatibility to ext:themes through lack of resources                                                                                                 |
|            | - [!!!][TASK] Cleanup deprecated template fallbacks                                                                                                                        |
|            | - [!!!][FEATURE] Add template fallback support                                                                                                                             |
|            | - [!!!][BUGFIX] Wrong path to font files - fixes #139                                                                                                                      |
|            | - [!!!][TASK] Make less files public available                                                                                                                             |
|            | - [!!!][TASK] Move lightbox implemantation to a own file and remove main.js                                                                                                |
|            | - [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup                                                                                           |
|            | - [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3                                                                                     |
|            | - [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186                                                                                                     |
|            | - [!!!][FEATURE] Add template fallback support                                                                                                                             |
|            | - [FEATURE] Make DynamicContent wrappable                                                                                                                                  |
|            | - [FEATURE] Add swipe support for carousels - fixes #161                                                                                                                   |
|            | - [FEATURE] Add new page type for popup usage without header and footer typeNum 1000 - fixes #70                                                                           |
|            | - [FEATURE] Enable support in lib.dynamicContent to support content from pid - fixes #185                                                                                  |
|            | - [FEATURE] Make breadcrumb enable treelevel configurable - fixes #191                                                                                                     |
|            | - [FEATURE] Add TypoScript TYPO3 version condition                                                                                                                         |
|            | - [FEATURE] Add selectivizr to add CSS3 pseudo selector support to IE8                                                                                                     |
|            | - [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186                                                                                                     |
|            | - [FEATURE] Add carousel type backgroundimage - #188                                                                                                                       |
|            | - [FEATURE] Make carousel header layout configurable - #188                                                                                                                |
|            | - [FEATURE] Add CSS status classes to content wrappers - #fixes 85                                                                                                         |
|            | - [FEATURE] Add tab content element                                                                                                                                        |
|            | - [FEATURE] Add external media content element for youtube and vimeo videos                                                                                                |
|            | - [FEATURE] New advanced constant to enable/disable CSS source mapping                                                                                                     |
|            | - [TASK] Update Documentation for TypoScript constants                                                                                                                     |
|            | - [TASK] Update Documentation                                                                                                                                              |
|            | - [!!!][TASK] Remove compatibility to ext:themes through lack of resources                                                                                                 |
|            | - [TASK] Use TCA renderTypes - fixes #192                                                                                                                                  |
|            | - [!!!][TASK] Cleanup deprecated template fallbacks                                                                                                                        |
|            | - [TASK] Copy Bootstrap font files during build process                                                                                                                    |
|            | - [TASK] Update Bootstrap to 3.3.5                                                                                                                                         |
|            | - [!!!][TASK] Make less files public available                                                                                                                             |
|            | - [TASK] Use absRefPrefix = auto instead of baseURL in TYPO3 CMS 7                                                                                                         |
|            | - [TASK] Add application context examples to .htaccess file                                                                                                                |
|            | - [!!!][TASK] Move lightbox implemantation to a own file and remove main.js                                                                                                |
|            | - [TASK] Add hires extension icon                                                                                                                                          |
|            | - [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup                                                                                           |
|            | - [TASK] Add grunt watcher for JavaScript files                                                                                                                            |
|            | - [TASK] Add RespondJs to Bower                                                                                                                                            |
|            | - [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3                                                                                     |
|            | - [TASK] Include bootstrap with Bower and Grunt                                                                                                                            |
|            | - [TASK] Add Grunt uglify for JavaScripts                                                                                                                                  |
|            | - [TASK] Add initial Grunt setup for RTE and precompiled theme                                                                                                             |
|            | - [TASK] Add less variables file to bootstrap theme                                                                                                                        |
|            | - [TASK] Unify namespace name in templates                                                                                                                                 |
|            | - [TASK] Make ContextualClassViewHelper compilable                                                                                                                         |
|            | - [TASK] Make FalViewHelper compilable                                                                                                                                     |
|            | - [TASK] Make ExternalMediaViewHelper compilable                                                                                                                           |
|            | - [TASK] Make VarViewHelper compilable                                                                                                                                     |
|            | - [TASK] Make ExplodeViewHelper compilable                                                                                                                                 |
|            | - [TASK] Make DataRelationViewHelper compilable                                                                                                                            |
|            | - [TASK] Remove leftover FormEngineViewHelper                                                                                                                              |
|            | - [TASK] Make FlexFormViewHelper compilable                                                                                                                                |
|            | - [TASK] Update jquery.responsiveimages.js                                                                                                                                 |
|            | - [TASK] Reintroduce css class for first headline in column rendering                                                                                                      |
|            | - [TASK] Move custom content element renderings to typoscript folder                                                                                                       |
|            | - [TASK] Cleanup extension declaration file to match documentation                                                                                                         |
|            | - [TASK] Add individual icons for content elements in wizard                                                                                                               |
|            | - [TASK] Added missing description to Bootstrap elements                                                                                                                   |
|            | - [TASK] Add field subheader to header palette of tt_content                                                                                                               |
|            | - [TASK] Remove csc-firstHeader CSS class in lib.stdHeader                                                                                                                 |
|            | - [TASK] Use references instead of hard copies in lib.stdheader                                                                                                            |
|            | - [TASK] Use ExtensionManagementUtility in autoload.php - fixes #172                                                                                                       |
|            | - [TASK] Update bootstrap to 3.3.4                                                                                                                                         |
|            | - [BUGFIX] Add disablePageTsRTE option to extension configuration again                                                                                                    |
|            | - [!!!][BUGFIX] Wrong path to font files - fixes #139                                                                                                                      |
|            | - [BUGFIX] Correct overflow problem                                                                                                                                        |
|            | - [BUGFIX] Deprecation of page.includeJSlibs in TYPO3 CMS 7                                                                                                                |
|            | - [BUGFIX] Ensure column CSS class is also set for imagecols set to 1 - fixes #138                                                                                         |
|            | - [BUGFIX] Set BackendLayouts columns correctly if PageTs is set via page record                                                                                           |
|            | - [BUGFIX] Section Index content item produces incorrect links - fixes #150                                                                                                |
|            | - [BUGFIX] Correct OnePage Markup                                                                                                                                          |
|            | - [BUGFIX] Add missing restore register in text with icon - fixes #174                                                                                                     |
|            | - slightly smarter TypoScript                                                                                                                                              |
|            | - FLUIDTEMPLATE.templateName and templateRootPaths                                                                                                                         |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Collision with jQuery width and height methods                                                                                                                           |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Event optimisation                                                                                                                                                       |
|            | - Fine tune jquery.responsiveimage.js                                                                                                                                      |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
|            | - Fix indents in tab feature                                                                                                                                               |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.10     | - [FEATURE] New advanced constant to enable/disable the use of Typoscript constants as Less variables                                                                      |
|            | - [FEATURE] new constant $page.logo.alt used to overwrite the default alt attribute of the logo image                                                                      |
|            | - [FEATURE] make site logo alt attribute configurable                                                                                                                      |
|            | - [FEATURE] Disable automatic less compiling - fixes #162                                                                                                                  |
|            | - [TASK] Add changelog                                                                                                                                                     |
|            | - [TASK] Refactor jquery.responsiveimages.js                                                                                                                               |
|            | - [TASK] HTML5 markup for sub navigation - fixes #171                                                                                                                      |
|            | - [TASK] Make RealUrl autoconfig compatible with the version from Helmut Hummel for 7.x                                                                                    |
|            | - [TASK] Protect configuration of extensions in default .htaccess                                                                                                          |
|            | - [TASK] Remove migration of realurl in favor of Helmut Hummels release for TYPO3 CMS 7.2                                                                                  |
|            | - [TASK] Carousel: allow to set the max width of background images                                                                                                         |
|            | - [TASK] Update oyejorge/less.php to 1.7.0.3                                                                                                                               |
|            | - [TASK] Remove automatic cache clearing - fixes #126                                                                                                                      |
|            | - [TASK] Add slack to contact and communication                                                                                                                            |
|            | - [TASK] replaced  with                                                                                                                                                    |
|            | - [TASK] Add admin panel config to typoscript constants                                                                                                                    |
|            | - [TASK] Update changelog in documentation                                                                                                                                 |
|            | - [BUGFIX] Correct overlapping elements on centered image - fixes #113, #159                                                                                               |
|            | - [BUGFIX] Correct media display for file links content element - fixes #164                                                                                               |
|            | - [BUGFIX] fix for HTML5 markup validation                                                                                                                                 |
|            | - [BUGFIX] Missing container in default clean layout                                                                                                                       |
|            | - [BUGFIX] Adjust language uids to match introduction database - fixes #135                                                                                                |
|            | - Stop using deprecated XHTML cleaning                                                                                                                                     |
|            | - Allow "target" attribute inside  tags.                                                                                                                                   |
|            | - added "br" to "allowedTags"                                                                                                                                              |
|            | - [CLEANUP] Correct indention to CGL                                                                                                                                       |
|            | - Modified footer and header                                                                                                                                               |
|            | - [Bugfix] fixes sorting on localized relations                                                                                                                            |
|            | - Update FalViewHelper.php                                                                                                                                                 |
|            | - [Bugfix] FalViewHelper.php                                                                                                                                               |
|            | - Update Base.ts                                                                                                                                                           |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.9      | - [TASK] Update jquery to 1.11.2                                                                                                                                           |
|            | - [TASK] Update modernizr to 2.8.3                                                                                                                                         |
|            | - [TASK] Update less.php to current master                                                                                                                                 |
|            | - [TASK] Throw exception on less compile error                                                                                                                             |
|            | - [TASK] Rise dependency of TYPO3 and css_styled_content version to 7.99.99                                                                                                |
|            | - [TASK] Add backend skin changes to the documentation                                                                                                                     |
|            | - [TASK] Use realurl autoconfig hook instead of overriding every config                                                                                                    |
|            | - [BUGFIX] Remove problematic whitespace                                                                                                                                   |
|            | - [BUGFIX] Remove superfluous slash in font definition - fixes #132                                                                                                        |
|            | - [BUGFIX] Classname must not start with a backslash in ext_conf_template.txt                                                                                              |
|            | - Update Index.rst                                                                                                                                                         |
|            | - Use array_merge_recursive() instead                                                                                                                                      |
|            | - Don't overwrite existing configuration completely                                                                                                                        |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.8      | - [TASK] Make realurl optional                                                                                                                                             |
|            | - [TASK] Remove e-mail from contact                                                                                                                                        |
|            | - [TASK] Minify responsiveimages.js and and cleanup                                                                                                                        |
|            | - [TASK] Cleanup CGL                                                                                                                                                       |
|            | - [TASK] Make removeDefaultJs configurable. fixes #105                                                                                                                     |
|            | - [BUGFIX] Use correct rte transform in accordion textfield - fixes #67                                                                                                    |
|            | - [BUGFIX] Wrong calculation in news pagination - fixes #106                                                                                                               |
|            | - [BUGFIX] Flashmessage queue throws error while installing - fixes #116                                                                                                   |
|            | - Update newContentElement.txt                                                                                                                                             |
|            | - Update newContentElement.txt                                                                                                                                             |
|            | - Update jquery.responsiveimages.js                                                                                                                                        |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.7      | - [TASK] Include respond.js with conditional comment to work with static cache - fixes #101                                                                                |
|            | - [TASK] Cleanup CGL                                                                                                                                                       |
|            | - [TASK] Reformat all project-specific content to TYPO3.CMS CGL                                                                                                            |
|            | - [TASK] Make getCompiledFile a static method - fixes #103 #104                                                                                                            |
|            | - [TASK] Deprecate backend skin for CMS7 and provide new logos                                                                                                             |
|            | - [TASK] Carousel needs to have background-image and background-color at the same time available                                                                           |
|            | - [TASK] Add .editorconfig file                                                                                                                                            |
|            | - [BUGFIX] Wrong colpos was used in layout "Default, Subnavigation Left and 2 Columns" fixes #98                                                                           |
|            | - Fix for columns in backend layout                                                                                                                                        |
|            | - Add 25/75 backend layout                                                                                                                                                 |
|            | - Add missing migrations for realurl                                                                                                                                       |
|            | - Add migrations for realurl to be compatible with CMS 7.0                                                                                                                 |
|            | - Remove unused template variable - fixes #93                                                                                                                              |
|            | - typo                                                                                                                                                                     |
|            | - Updated RTE configuration. Implemented a workaround to get enableWordClean work again.                                                                                   |
|            | - Finish Hotfix-lead-text                                                                                                                                                  |
|            | - Fixes Lead text in RTE that is not saved cause not in allowedClasses                                                                                                     |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.6      | - [FEATURE] add composer.json                                                                                                                                              |
|            | - Release 6.2.6                                                                                                                                                            |
|            | - Correct colPos for left column on Layout: Default, Subnavigation Left and 2 Columns - fixes #62                                                                          |
|            | - Add Google Analytics tracking code anonymization - fixes #84                                                                                                             |
|            | - Adjust processing rules for rte                                                                                                                                          |
|            | - Add missing styling for rte table contextual classes                                                                                                                     |
|            | - Enhance accessibility for the accordion                                                                                                                                  |
|            | - Describe and enhance rte config, tables are now responsive by default, css classes have translations now                                                                 |
|            | - Fix role="main" position in 2 columns layout.                                                                                                                            |
|            | - Add backend layout with 2 columns 50/50%                                                                                                                                 |
|            | - Use DIR option instead of FILE to include backend layouts.                                                                                                               |
|            | - Remove superfluous text "Bootstrap Package: " from layouts names.                                                                                                        |
|            | - Exclude page also from search engine index if no_search is set to the page - fixes #69                                                                                   |
|            | - Enhance accessibility for the carousel                                                                                                                                   |
|            | - Adjustments to skip to content - resolves #63                                                                                                                            |
|            | - Add marker for current year. Move replacements directly to the fluidtempalte - fixes #72                                                                                 |
|            | - Add missing alt and title attributes on noscript fallback for image rendering - fixes #77                                                                                |
|            | - TASK: Skip to content Resolves https://github.com/benjaminkott/bootstrap_package/issues/63                                                                               |
|            | - Update bootstrap css file for the backend to 3.3.0                                                                                                                       |
|            | - Adjust gitignore                                                                                                                                                         |
|            | - Remove the automatic appending icons for content links                                                                                                                   |
|            | - Fix navbar-brand-image position                                                                                                                                          |
|            | - Fix Carousel fading in chrome                                                                                                                                            |
|            | - Update Bootstrap to version 3.3.0                                                                                                                                        |
|            | - Display Problems in IE8 for "width: 100% \9;"                                                                                                                            |
|            | - Move css files for the backend to avoid missunderstandings and add plain default bootstrap.min.css - fixes #61                                                           |
|            | - Adjust language menu for smaller viewports - #65                                                                                                                         |
|            | - Adjust font-size and line-height for better readability                                                                                                                  |
|            | - We are always stable ;)                                                                                                                                                  |
|            | - Backendskin is not disabled correctly if option is set                                                                                                                   |
|            | - Add backend layouts for left navigation - fixes #62                                                                                                                      |
|            | - Adjust carousel - fixes #51                                                                                                                                              |
|            | - Add missing space in news date format - fixes #59                                                                                                                        |
|            | - Add caption alignment - fixes #58                                                                                                                                        |
|            | - Fix small typo                                                                                                                                                           |
|            | - Cleanup configuration for indention frames - fixes #57                                                                                                                   |
|            | - Cleanup RTE config                                                                                                                                                       |
|            | - Cleanup Tabs #52                                                                                                                                                         |
|            | - Remove forgotten typoscript code for searchbar and login - #50                                                                                                           |
|            | - Set cache period to 24h - fixes #55                                                                                                                                      |
|            | - Correct linkToTop rendering - fixes #54                                                                                                                                  |
|            | - Correct composer.json                                                                                                                                                    |
|            | - Move PARAMS before SOURCECOLLECTION for better HTML code readability.                                                                                                    |
|            | - Move img class to params for easier customization.                                                                                                                       |
|            | - Add basic google analytics settings                                                                                                                                      |
|            | - Provide open graph image for social networks                                                                                                                             |
|            | - Cleanup flip ahead browsing for IE                                                                                                                                       |
|            | - Correct dependency to TYPO3 version to ensure that the correct forms are loaded                                                                                          |
|            | - Update composer.json                                                                                                                                                     |
|            | - Fix dynamic rewrite base                                                                                                                                                 |
|            | - Implement a dynamic rewrite base solution reduce problems with some hosters                                                                                              |
|            | - Remove some image orient fields to avoid distraction                                                                                                                     |
|            | - Remove unused link for the image in text with image - fixes #49                                                                                                          |
|            | - Avoid error if data for lib.dynamicContent is not provided as array                                                                                                      |
|            | - The title attribute remains empty in mainmenu of onepage variant - fixes #44                                                                                             |
|            | - Allow link tag usage in html content element                                                                                                                             |
|            | - Split theme less file                                                                                                                                                    |
|            | - Add new clean backend layout                                                                                                                                             |
|            | - Add styling constants for ext:themes                                                                                                                                     |
|            | - Provide options to disable parts of the auto included PageTs settings                                                                                                    |
|            | - Cleanup                                                                                                                                                                  |
|            | - Make Bootstrap Package run as a OnePage Website                                                                                                                          |
|            | - fix 'Boostrap' typos                                                                                                                                                     |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.5      | - [FEATURE] use SymLinksIfOwnerMatch in .htaccess                                                                                                                          |
|            | - Release 6.2.5                                                                                                                                                            |
|            | - Update Documentation                                                                                                                                                     |
|            | - Add support for link "Edit me on Github"                                                                                                                                 |
|            | - Fix workspace problem for related records #37                                                                                                                            |
|            | - Make main navbar position configurable                                                                                                                                   |
|            | - Combine less files to avoid dublicate css definitions                                                                                                                    |
|            | - Allow Backend Layouts to be configured via PageTsConfig                                                                                                                  |
|            | - Cleanup less.php integration - fixes #32                                                                                                                                 |
|            | - Correct display of tx_form - hopefully                                                                                                                                   |
|            | - Correct type of baseURL typoscript constant                                                                                                                              |
|            | - Correct default icon-font-path to avoid problems if page is deployed in a folder - fixes #31                                                                             |
|            | - Update jQuery version to 1.11.1                                                                                                                                          |
|            | - Disable imageheight and imagewidth for textpic and image content elements to avoid wrong rendering                                                                       |
|            | - Avoid problems with hardcoded resource links in login template, remove overriding - fixes #28                                                                            |
|            | - Correct label definitions for content elements, $_EXTKEY is not available here - fixes #27                                                                               |
|            | - Add conflict to dyncss to ensure correct less rendering                                                                                                                  |
|            | - Cleanup spaces                                                                                                                                                           |
|            | - Images displayed in one column have no restriction to current layout column - fixes #19                                                                                  |
|            | - Update Bootstrap to 3.2.0                                                                                                                                                |
|            | - Correct file locations                                                                                                                                                   |
|            | - Fix bootstrap less compiler if flattensetup is not available - fixes #20                                                                                                 |
|            | - Cleanup bootstrap file locations                                                                                                                                         |
|            | - Move bootstrap js to separate folder                                                                                                                                     |
|            | - Removing symlink option due problems on windows apache with symlinks - affects #25                                                                                       |
|            | - Add missing default variables file for bootstrap                                                                                                                         |
|            | - Remove backend style module - introduce typoscript constants instead to provide a more flexible less configuration - fixes #5 #20                                        |
|            | - Update less.php                                                                                                                                                          |
|            | - Move TCA                                                                                                                                                                 |
|            | - Text and image - center top was not centered - fixes #21                                                                                                                 |
|            | - Add missing bodytext field to carousel "text and image" and enable rte for accordion - fixes #23                                                                         |
|            | - Allow table in RTE                                                                                                                                                       |
|            | - Adjust LogoView to make it a bit more secure                                                                                                                             |
|            | - added fluidpages to conflicts fixes #18                                                                                                                                  |
|            | - Add link to the complete teaser item and fix the relations                                                                                                               |
|            | - Fix typo                                                                                                                                                                 |
|            | - Make it possible to enable backend skin if themes is loaded.                                                                                                             |
|            | - Make bootstrap_package compatible with themes (part 2)                                                                                                                   |
|            | - Correct version number                                                                                                                                                   |
|            | - Cleanup formatting                                                                                                                                                       |
|            | - Make bootstrap_package compatible with themes (part 1)                                                                                                                   |
|            | - Correct types in constants                                                                                                                                               |
|            | - Add TYPO3 version to sitename in backend header                                                                                                                          |
|            | - Correct wizard registration                                                                                                                                              |
|            | - Add links for carousel images in FE, optimize fal fields. fixes #15                                                                                                      |
|            | - Update Accordion.html                                                                                                                                                    |
|            | - add missing text_color field to carousel textwithimage #10                                                                                                               |
|            | - carousel interval and wrap needs to be configurable #10                                                                                                                  |
|            | - wrong label for header in carousel textwithimage #10                                                                                                                     |
|            | - cleanup wrong committed stuff before                                                                                                                                     |
|            | - - cleanup wrong formatting in base.ts - add chash for pagination to prevent cashing issues described in #9                                                               |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 6.2.4      | - ter does not allow long version numbers ...                                                                                                                              |
|            | - ter ist fucking up ;(                                                                                                                                                    |
|            | - set version to 6.2.2.2                                                                                                                                                   |
|            | - Add Basic Documentation                                                                                                                                                  |
|            | - correct version to 6.2.2.1 and adjust description                                                                                                                        |
|            | - Hide navigation toggle if no subpages exist.                                                                                                                             |
|            | - Fix the height of the header if no subpages available                                                                                                                    |
|            | - Provide an example .htaccess file after installation - fixes #3                                                                                                          |
|            | - tabs and spaces ...                                                                                                                                                      |
|            | - Remove absRefPrefix und add automatic baseURL determination instead. This will ensure that the links and pages are correct if you are running TYPO3 in a subfolder.      |
|            | - Change README to .rst format. Change spelling and wording.                                                                                                               |
|            | - Change README to .rst format. Change spelling and wording.                                                                                                               |
|            | - image fix IE                                                                                                                                                             |
|            | - set version to 6.2.3 for further development                                                                                                                             |
|            | - cleanup main.js                                                                                                                                                          |
|            | - remove rootpage id from realurl due complication with import                                                                                                             |
|            | - Make absRefPrefix configurable, this is needed when typo3 is running in a subfolder                                                                                      |
|            | - set version to 6.2.2 for further development                                                                                                                             |
|            | - Remove generated variables from repository                                                                                                                               |
|            | - Add RealUrl Config                                                                                                                                                       |
|            | - Update description                                                                                                                                                       |
|            | - Update README.md                                                                                                                                                         |
|            | - set version to 6.2.1 for further development                                                                                                                             |
|            | - set version to 6.2.0 - initial release in ter                                                                                                                            |
|            | - RC 6.2                                                                                                                                                                   |
|            | - Initial commit                                                                                                                                                           |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
