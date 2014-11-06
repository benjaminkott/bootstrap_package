.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _changelog:

ChangeLog
---------

.. tabularcolumns:: |r|p{13.7cm}|

=======  =========================================================================================================================
Version  Changes
=======  =========================================================================================================================
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
