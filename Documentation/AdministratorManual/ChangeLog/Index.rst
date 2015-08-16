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

=======  =========================================================================================================================
Version  Changes
=======  =========================================================================================================================
6.2.15   - [BUGFIX] Make class.ext_update.php work on PHP <5.5 as well
         - [BUGFIX] Use correct assignment for TypoScript value
         - [BUGFIX] Use camel caps format for functions in external media utility
         - [TASK] Unify license comment
         - [TASK] Add phpcs as dev dependency to composer.json
         - [TASK] Add Scrutinizer
         - [TASK] Add travis-ci builds for TYPO3 6.2 and master
         - [TASK] Remove TYPO3 dependencies and conflicts from composer.json
         - [TASK] Update less.php to 1.7.0.5
         - [TASK] Introduce PSR-2 Coding Style Guide
6.2.14   - [FEATURE] Add advanced Open Graph support, support new meta notation for 7.4
         - [BUGFIX] Use always $GLOBALS[TCA]
         - [BUGFIX] fix missing TYPO3SEARCH_end marker
         - [TASK] Responsive Images plugin documentation
         - [TASK] Update TypoScript template mapping for backend layouts
         - [TASK] Add update script to migrate old backend layout prefix to new prefix in table pages
         - [TASK] Disable BackendLayoutDataProvider for TYPO3 versions above 7.3 and adapt core provider prefix for PageTS
         - [TASK] Add 'active' class for shortcuts in sub navigation
         - [TASK] Move column labels for border, normal, left, right to bootstrap_package, files moved in CMS 7
6.2.13   - [BUGFIX] Remove leading slash from classnames in typoscript setup
         - [BUGFIX] Restrict options for default tab to currently assigned items
         - [BUGFIX] Fix composer.json
         - [TASK] Include css_styled_content and form in static template
6.2.12   - [BUGFIX] Add missing static template for bootstrap package
6.2.11   - [BUGFIX] Add disablePageTsRTE option to extension configuration again
         - [!!!][TASK] Remove compatibility to ext:themes through lack of resources
         - [TASK] Use TCA renderTypes
         - [!!!][TASK] Cleanup deprecated template fallbacks
         - [!!!][FEATURE] Add template fallback support
         - [FEATURE] Make DynamicContent wrappable
         - [TASK] Copy Bootstrap font files during build process
         - [!!!][BUGFIX] Wrong path to font files
         - [TASK] Update Bootstrap to 3.3.5
         - [FEATURE] Add swipe support for carousels
         - [BUGFIX] Correct overflow problem
         - [FEATURE] Add new page type for popup usage without header and footer
         - [FEATURE] Enable support in lib.dynamicContent to support content from pid
         - [FEATURE] Make breadcrumb enable treelevel configurable
         - [TASK] Use absRefPrefix = auto instead of baseURL in TYPO3 CMS 7
         - [BUGFIX] Deprecation of page.includeJSlibs in TYPO3 CMS 7
         - [FEATURE] Add TypoScript TYPO3 version condition
         - [BUGFIX] Ensure column CSS class is also set for imagecols set to 1
         - [TASK] Add application context examples to .htaccess file
         - [!!!][TASK] Move lightbox implemantation to a own file and remove main.js
         - [TASK] Add hires extension icon
         - [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup
         - [FEATURE] Add selectivizr to add CSS3 pseudo selector support to IE8
         - [TASK] Add grunt watcher for JavaScript files
         - [TASK] Add RespondJs to Bower
         - [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3
         - [BUGFIX] Set BackendLayouts columns correctly if PageTs is set via page record
         - [TASK] Include bootstrap with Bower and Grunt
         - [TASK] Add Grunt uglify for JavaScripts
         - [TASK] Add initial Grunt setup for RTE and precompiled theme
         - [TASK] Add less variables file to bootstrap theme
         - [TASK] Unify namespace name in templates
         - [TASK] Make ContextualClassViewHelper compilable
         - [TASK] Make FalViewHelper compilable
         - [TASK] Make ExternalMediaViewHelper compilable
         - [TASK] Make VarViewHelper compilable
         - [TASK] Make ExplodeViewHelper compilable
         - [TASK] Make DataRelationViewHelper compilable
         - [TASK] Remove leftover FormEngineViewHelper
         - [TASK] Make FlexFormViewHelper compilable
         - [TASK] Update jquery.responsiveimages.js
         - [TASK] Reintroduce css class for first headline in column rendering
         - [!!!][FEATURE] Support multilevel tree in subnavigation
         - [FEATURE] Add carousel type backgroundimage
         - [FEATURE] Make carousel header layout configurable
         - [BUGFIX] Section Index content item produces incorrect links
         - [FEATURE] Add CSS status classes to content wrappers
         - [BUGFIX] Correct OnePage Markup
         - [FEATURE] New advanced constant to enable/disable CSS source mapping
         - [BUGFIX] Correct OnePage Markup
         - [TASK] Move custom content element renderings to typoscript folder
         - [TASK] Cleanup extension declaration file to match documentation
         - [FEATURE] Add tab content element
         - [BUGFIX] Add missing restore register in text with icon
         - [TASK] Add individual icons for content elements in wizard
         - [TASK] Added missing description to Bootstrap elements
         - [FEATURE] Add external media content element for youtube and vimeo videos
         - [TASK] Add field subheader to header palette of tt_content
         - [TASK] Remove csc-firstHeader CSS class in lib.stdHeader
         - [TASK] Use references instead of hard copies in lib.stdheader
         - [TASK] Use ExtensionManagementUtility in autoload.php
         - [TASK] Update bootstrap to 3.3.4
6.2.10   - [TASK] Refactor jquery.responsiveimages.js
         - [TASK] HTML5 markup for sub navigation
         - [TASK] Make RealUrl autoconfig compatible with the version from Helmut Hummel for 7.x
         - [TASK] Remove migration of realurl in favor of Helmut Hummels release for TYPO3 CMS 7.2
         - [FEATURE] New advanced constant to enable/disable the use of TypoScript constants as Less variables
         - [TASK] Carousel: allow to set the max width of background images
         - [TASK] Remove deprecated XHTML cleaning
         - [TASK] Update oyejorge/less.php to 1.7.0.3
         - [BUGFIX] Correct overlapping elements on centered image
         - [TASK] Remove automatic cache clearing
         - [BUGFIX] Correct media display for file links content element
         - [FEATURE] make site logo alt attribute configurable
         - [TASK] Add slack to contact and communication
         - [FEATURE] Disable automatic less compiling
         - [TASK] Allow "target" attribute inside <a> tags.
         - [BUGFIX] Missing container in default clean layout
         - [TASK] Add <br> to allowedTags in RTE config
         - [TASK] HTML5 improvements on footer
         - [TASK] HTML5 improvements on navigation
         - [TASK] HTML5 improvements on language menu
         - [TASK] HTML5 improvements on main section
         - [BUGFIX] Sorting on localized relations
         - [BUGFIX] FalViewHelper missing translations
         - [BUGFIX] Correct markup for news date
         - [BUGFIX] Adjust language uids to match introduction database
         - [TASK] Add admin panel config to typoscript constants
6.2.9    - [TASK] Update jquery to 1.11.2
         - [TASK] Update modernizr to 2.8.3
         - [BUGFIX] Remove problematic whitespace in carousel flexform
         - [BUGFIX] Remove superfluous slash in font definition
         - [TASK] Update less.php to current master
         - [TASK] Throw exception on less compile error
         - [TASK] Use realurl autoconfig hook instead of overriding every config
         - [BUGFIX] Classname must not start with a backslash in ext_conf_template.t
6.2.8    - [TASK] Make realurl optional
         - [TASK] Update jquery.responsiveimages.js
         - [BUGFIX] Flashmessage queue throws error while installing
         - [BUGFIX] Wrong calculation in news pagination
         - [BUGFIX] Use correct rte transform in accordion textfield
6.2.7    - [TASK] Deprecate backend skin for CMS7 and provide new logos
         - [TASK] Include respond.js with conditional comment to work with static cache
         - [TASK] Reformat all project-specific content to TYPO3.CMS CGL
         - [TASK] Carousel needs to have background-image and background-color at the same time available
         - [TASK] Add .editorconfig to make contributions more easy
         - [TASK] Add 25/75 backend layout
         - [TASK] Add migrations for realurl to be compatible with 7.0
         - [BUGFIX] Wrong colpos was used in layout "Default, Subnavigation Left and 2 Columns
         - [BUGFIX] Updated RTE configuration to enable wordclean correctly
         - [BUGFIX] RTE does not save .lead
6.2.6    - Add new RTE config for better editor usability
         - Add responsive tables in RTE
         - Add backend layout with 2 columns 50/50%
         - Exclude page also from search engine index if no_search is set to the page
         - Enhance accessibility for the carousel
         - Add Marker ###CURRENTYEAR###
         - Add skip to content for screen reader
         - Remove the automatic appending icons for content links
         - Update Bootstrap to version 3.3.0
         - Correct image display problems in IE8
         - Adjust language menu for smaller viewports
         - Adjust font-size and line-height for better readability
         - Add backend layouts for left navigation
         - Add missing space in news date format
         - Add caption alignment
         - Set cache period to 24h
         - Correct linkToTop rendering
         - Add google analytics
         - Provide open graph image for social networks
         - Add basic composer.json
         - Implement a dynamic rewrite base solution reduce problems with some hosters
         - Change lib.dynamicContent to be more flexible
         - Allow link tag usage in html content element
         - Split theme less file
         - Add new clean backend layout
         - Add styling constants for ext:themes
         - Provide options to disable parts of the auto included PageTs settings
         - Make Bootstrap Package run as a OnePage Website
         - Cleanups
6.2.5    - Update Documentation
         - Add support for link "Edit me on Github"
         - Fix workspace problem for related records
         - Make main navbar position configurable
         - Combine less files to avoid dublicate css definitions
         - Allow Backend Layouts to be configured via PageTsConfig
         - Correct display of tx_form
         - Correct type of baseURL typoscript constant
         - Update jQuery version to 1.11.1
         - Disable imageheight and imagewidth for textpic and image content elements to avoid wrong rendering
         - Avoid problems with hardcoded resource links in login template, remove overriding
         - Add conflict to dyncss to ensure correct less rendering
         - Images displayed in one column have no restriction to current layout column
         - Update Bootstrap to 3.2.0
         - Removing symlink option due problems on windows apache with symlinks - affects
         - Remove backend style module - introduce typoscript constants instead to provide a more flexible less configuration
         - Update less.php
         - Move TCA
         - Text and image - center top was not centered
         - Add missing bodytext field to carousel "text and image" and enable rte for accordion
         - Allow table in RTE
         - Adjust LogoView to make it a bit more secure
         - Add link to the complete teaser item and fix the relations
         - Make it possible to enable backend skin if themes is loaded.
         - Make Themes compatible
         - Add TYPO3 version to sitename in backend header
         - Correct wizard registration
         - Add links for carousel images in FE, optimize fal fields
         - Wrong label for header in carousel textwithimage
         - Carousel interval and wrap needs to be configurable
         - Add missing text_color field to carousel textwithimage
         - Fix wrong attributes on accordion
         - Cleanups
6.2.4    - Initial working TER release
=======  =========================================================================================================================
