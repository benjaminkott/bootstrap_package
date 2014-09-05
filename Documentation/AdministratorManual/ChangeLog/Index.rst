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
