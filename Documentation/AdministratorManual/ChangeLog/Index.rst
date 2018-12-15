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
| 10.0.5     | - [TASK] Add vscode to gitignore                                                                                                                                           |
|            | - [TASK] Update Bootstrap 3.x to 3.4.0                                                                                                                                     |
|            | - [BUGFIX] Make Less Parser PHP 7.3 compatible (#617)                                                                                                                      |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 10.0.4     | - [FEATURE] Collapsible in accordion should scroll to the top of its contents (#589)                                                                                       |
|            | - [TASK] Update leafo/scssphp to v0.7.7 - fixes #612                                                                                                                       |
|            | - [TASK] Name hooks and always register them, regardless of context                                                                                                        |
|            | - [TASK] Add option to disable the web font loader                                                                                                                         |
|            | - [BUGFIX] Ensure parallax effect works across all desktop browsers - fixes #610                                                                                           |
|            | - [BUGFIX] Keep page accessible on early javascript errors                                                                                                                 |
|            | - [BUGFIX] Catch exception in TYPO3 8.7 backend on database configuration missmatch                                                                                        |
|            | - [BUGFIX] Minor fixes to wording - fixes #606                                                                                                                             |
|            | - [BUGFIX] Avoid update problems and always include sql adjustments for sys_language                                                                                       |
|            | - [BUGFIX] Move parsefunc and dynamic content to content rendering definition                                                                                              |
|            | - [BUGFIX] Use typolink instead of page viewhelper for wizard fields                                                                                                       |
|            | - [BUGFIX] Do not use rem in bootstrap 3 context - part 2                                                                                                                  |
|            | - [BUGFIX] Do not use rem in bootstrap 3 context                                                                                                                           |
|            | - [BUGFIX] Make standalone element configuration availabe as rendering template                                                                                            |
|            | - [BUGFIX] Remove obsolete unsetting of the list content element for plugins                                                                                               |
|            | - [BUGFIX] Correct path in comment to bootstrap resource files - fixes #590                                                                                                |
|            | - [BUGFIX] Respect title configuration in menu card and menu thumbnail elements - fixes #591                                                                               |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 10.0.3     | - [TASK] Remove install notification for unsupported webservers - fixes #562                                                                                               |
|            | - [BUGFIX] Streamline file property access to also lead sys_file data - #578                                                                                               |
|            | - [BUGFIX] Add fallback handling for unsupported pointer events in safari - #571                                                                                           |
|            | - [BUGFIX] Correct styling of accordion - fixes #579                                                                                                                       |
|            | - [BUGFIX] Ensure element browser links working in carousel - fixes #575                                                                                                   |
|            | - [BUGFIX] Adjust comment in ext_tables.php                                                                                                                                |
|            | - [BUGFIX] Fix typo in comment  (#580)                                                                                                                                     |
|            | - [BUGFIX] Ensure photoswipe scss vars can be adjusted                                                                                                                     |
|            | - [BUGFIX] Correct placement of main navigation dropdowns on small viewports - fixes #561, #565                                                                            |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 10.0.2     | - [BUGFIX] Respect overrides for enable-rounded scss variable - #558                                                                                                       |
|            | - [BUGFIX] Correct TCA for carousel small (#557)                                                                                                                           |
|            | - [BUGFIX] use correct default value for texticon icon type (#559)                                                                                                         |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 10.0.1     | - [TASK] Add forgotten textpic and textmedia alignment                                                                                                                     |
|            | - [BUGFIX] Correct link color bubbling for sections in bootstrap 4                                                                                                         |
|            | - [BUGFIX] Prevent color bubbling for cards                                                                                                                                |
|            | - [BUGFIX] Correct primary label in bs4 typoscript constants (#554)                                                                                                        |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 10.0.0     | - [!!!][FEATURE] Use bootstrap 4 the default frontend framework                                                                                                            |
|            | - [!!!][TASK] Use dedicated thumbnail field for card menu thumbnails                                                                                                       |
|            | - [!!!][TASK] Drop signal to modify less settings                                                                                                                          |
|            | - [!!!][FEATURE] Provide new design for thumbnail menu content element                                                                                                     |
|            | - [!!!][TASK] Use dedicated thumbnail field for thumbnail menu content element                                                                                             |
|            | - [!!!][FEATURE] Allow multiple icon sources for text and icon - fixes #504                                                                                                |
|            | - [!!!][TASK] Ensure classes and ids on template areas are unique                                                                                                          |
|            | - [!!!][TASK] Use .form.yaml instead of .yaml                                                                                                                              |
|            | - [!!!][TASK] Add google webfont support for bs4 and add option to disable them                                                                                            |
|            | - [!!!][TASK] Move navigation constants to dedicated namespace                                                                                                             |
|            | - [!!!][TASK] Enable css und js concatenation by default                                                                                                                   |
|            | - [!!!][FEATURE] Improve responsive image rendering (#517)                                                                                                                 |
|            | - [!!!][TASK] Move footer column rendering to page templates                                                                                                               |
|            | - [!!!][TASK] Drop clean backendlayout in favor of simple                                                                                                                  |
|            | - [!!!][TASK] Move border column rendering to new section above breadcrumb                                                                                                 |
|            | - [!!!][TASK] Migrate frame classes well and jumbotron to background color classes                                                                                         |
|            | - [!!!][TASK] Make mainnavigation compatible with bs3 and bs4                                                                                                              |
|            | - [!!!][TASK] Use theme constants instead of settings                                                                                                                      |
|            | - [!!!][TASK] Drop show footer option                                                                                                                                      |
|            | - [!!!][FEATURE] Use bootstrap 4 the default frontend framework                                                                                                            |
|            | - [FEATURE] Enable responsive images for carousel item text and image - #552                                                                                               |
|            | - [FEATURE] Enable responsive images for carousel item image - #552                                                                                                        |
|            | - [FEATURE] Enable responsive images for carousel backgrounds - #552                                                                                                       |
|            | - [FEATURE] Enable responsive images for content element background images - #552                                                                                          |
|            | - [FEATURE] Enable responsive images for timeline - #552                                                                                                                   |
|            | - [FEATURE] Enable responsive images for card menu                                                                                                                         |
|            | - [FEATURE] Make columns and alignment of card menu configurable                                                                                                           |
|            | - [FEATURE] Enable responsive images for tab items                                                                                                                         |
|            | - [FEATURE] Enable crop variants for tab items                                                                                                                             |
|            | - [FEATURE] Enable columns and image zoom for tab items                                                                                                                    |
|            | - [FEATURE] Allow multiple assets rendered in tab item                                                                                                                     |
|            | - [FEATURE] Add additional media positions to tab content element                                                                                                          |
|            | - [FEATURE] Enable crop variants for carousel items                                                                                                                        |
|            | - [FEATURE] Enable responsive images for accordion items #552                                                                                                              |
|            | - [FEATURE] Enable columns and image zoom for accordion items                                                                                                              |
|            | - [FEATURE] Allow multiple assets rendered in accordion item                                                                                                               |
|            | - [FEATURE] Enable more image positions for accordion content element                                                                                                      |
|            | - [FEATURE] Add gutter support for image variants utility                                                                                                                  |
|            | - [!!!][FEATURE] Provide new design for thumbnail menu content element                                                                                                     |
|            | - [FEATURE] Add dedicated thumbnail fied to pages                                                                                                                          |
|            | - [FEATURE] Add card group content element                                                                                                                                 |
|            | - [FEATURE] Add trim viewhelper                                                                                                                                            |
|            | - [!!!][FEATURE] Allow multiple icon sources for text and icon - fixes #504                                                                                                |
|            | - [FEATURE] Add more content positions to existing layouts                                                                                                                 |
|            | - [FEATURE] Add static file processor                                                                                                                                      |
|            | - [FEATURE] Add DropIn locations to page footer                                                                                                                            |
|            | - [FEATURE] Make frame inner and outer spacing configurable                                                                                                                |
|            | - [FEATURE] Add secondary colors and introduce outline buttons                                                                                                             |
|            | - [FEATURE] Add folder support for textpic content element                                                                                                                 |
|            | - [FEATURE] Add text indention plugin to ckeditor                                                                                                                          |
|            | - [FEATURE] Add options to disable icon rendering in main and subnavigation                                                                                                |
|            | - [FEATURE] Add optional nav icon rendering to card menu                                                                                                                   |
|            | - [FEATURE] Add css columns to ckeditor - fixes #386 #387                                                                                                                  |
|            | - [FEATURE] Add background image effects to content elements and carousel                                                                                                  |
|            | - [FEATURE] Add src support for inline svg viewhelper                                                                                                                      |
|            | - [FEATURE] Add content element to render csv files                                                                                                                        |
|            | - [FEATURE] Add navigation icon support in dropdown                                                                                                                        |
|            | - [!!!][FEATURE] Improve responsive image rendering (#517)                                                                                                                 |
|            | - [FEATURE] Add automatic local google font cache (#522)                                                                                                                   |
|            | - [FEATURE] Add typoscript condition to check typo3 core version                                                                                                           |
|            | - [FEATURE] Add popup close and open events to cookieconsent - fixes (#526)                                                                                                |
|            | - [FEATURE] Add support for folders in image and media element                                                                                                             |
|            | - [FEATURE] Add data processor to filter files by extension                                                                                                                |
|            | - [FEATURE] Make lightbox max image dimensions configurable                                                                                                                |
|            | - [FEATURE] Automatic language menus and configuration for TYPO3 8.7 and >= 9.3 (#511)                                                                                     |
|            | - [FEATURE] Add placeholder for google analytics opt-out / opt-in                                                                                                          |
|            | - [FEATURE] Introduce template blocks                                                                                                                                      |
|            | - [FEATURE] Add cookieconsent                                                                                                                                              |
|            | - [FEATURE] Add additional header and subheader classes for carousel items                                                                                                 |
|            | - [FEATURE] Make timeline sorting direction adjustable                                                                                                                     |
|            | - [FEATURE] Add timeline content element                                                                                                                                   |
|            | - [FEATURE] Add drop-in support for main navigation                                                                                                                        |
|            | - [FEATURE] Add border column to all simple layouts - fixes #235                                                                                                           |
|            | - [FEATURE] Allow navigation icons in breadcrumb                                                                                                                           |
|            | - [FEATURE] Add call to action carousel item                                                                                                                               |
|            | - [FEATURE] Add ckeditor plugin to insert address                                                                                                                          |
|            | - [FEATURE] Add social links content element                                                                                                                               |
|            | - [FEATURE] Add simple backendlayout without container                                                                                                                     |
|            | - [FEATURE] Provide form styling for bs3 and bs4 and add basic contact form                                                                                                |
|            | - [FEATURE] Add typoscript constant viewhelper                                                                                                                             |
|            | - [FEATURE] Add lowercase dashed formatting viewhelper                                                                                                                     |
|            | - [FEATURE] Allow to set width and height to inline svgs                                                                                                                   |
|            | - [FEATURE] Add anchor classes to linkbrowser                                                                                                                              |
|            | - [FEATURE] Add icon group content element                                                                                                                                 |
|            | - [FEATURE] Add viewhelper to render inline svgs                                                                                                                           |
|            | - [FEATURE] Add card menu                                                                                                                                                  |
|            | - [FEATURE] Add social media channels to page footer                                                                                                                       |
|            | - [FEATURE] Add processor to make typoscript constants available in templates                                                                                              |
|            | - [FEATURE] Add bootstrap 4 sources                                                                                                                                        |
|            | - [FEATURE] Load webfonts via fontloader to avoid blocking rendering - fixes #491                                                                                          |
|            | - [FEATURE] Enable scss and less processing for includeCSSLibs                                                                                                             |
|            | - [FEATURE] Introduce new parser for scss css files                                                                                                                        |
|            | - [TASK] Enable ckeditor autolink plugin per default                                                                                                                       |
|            | - [TASK] Add rel noopener to links in default copyright text                                                                                                               |
|            | - [TASK] Update webserver configs to mach typo3 v9 defaults                                                                                                                |
|            | - [TASK] Optimize modernizr footprint                                                                                                                                      |
|            | - [TASK] Update frontend build chain to latest versions                                                                                                                    |
|            | - [TASK] Update grunt-webfont to 1.7.2 and rebuild assets                                                                                                                  |
|            | - [TASK] Update popper.js to 1.14.4                                                                                                                                        |
|            | - [TASK] Update cookieconsent to 3.1.0                                                                                                                                     |
|            | - [TASK] Optimize backgroundimages to avoid frame overflows                                                                                                                |
|            | - [TASK] Add TypoScript variables for Bootstrap 4 (#500)                                                                                                                   |
|            | - [TASK] Streamline database definition with TYPO3 v9                                                                                                                      |
|            | - [TASK] Use rel noopener for social links                                                                                                                                 |
|            | - [TASK] Streamline placement of background image templates                                                                                                                |
|            | - [TASK] Add tests for ExternalMediaUtility                                                                                                                                |
|            | - [!!!][TASK] Use dedicated thumbnail field for card menu thumbnails                                                                                                       |
|            | - [TASK] Code cleanups                                                                                                                                                     |
|            | - [TASK] Streamline less and scss caching                                                                                                                                  |
|            | - [!!!][TASK] Drop signal to modify less settings                                                                                                                          |
|            | - [TASK] Prefer wording gutters over gutter to show that this are multiple                                                                                                 |
|            | - [TASK] Optimize CSS compiler code and caches (#550)                                                                                                                      |
|            | - [TASK] Harden image variants utility                                                                                                                                     |
|            | - [TASK] Add first unit tests for image variants utility                                                                                                                   |
|            | - [TASK] Optimize responsive image rendering of thumbnail menu                                                                                                             |
|            | - [!!!][TASK] Use dedicated thumbnail field for thumbnail menu content element                                                                                             |
|            | - [TASK] Improve config scoping of textpic and textmedia responsive image settings                                                                                         |
|            | - [TASK] Streamline card link classes with rte buttons                                                                                                                     |
|            | - [TASK] Remove misleading doccomments in viewhelpers                                                                                                                      |
|            | - [TASK] Slightly improve gallery image handling                                                                                                                           |
|            | - [TASK] Simplify Icon Group handling                                                                                                                                      |
|            | - [TASK] Cleanup install service                                                                                                                                           |
|            | - [TASK] Make list-inline compatible                                                                                                                                       |
|            | - [TASK] Use typo3 v9 minimal distribution for scrutinizer                                                                                                                 |
|            | - [TASK] Correct CGL                                                                                                                                                       |
|            | - [TASK] Add svgo config                                                                                                                                                   |
|            | - [TASK] Cleanup glyphicons and ensure all icons are correctly rendered                                                                                                    |
|            | - [TASK] Cleanup ionicons and ensure all icons are correctly rendered                                                                                                      |
|            | - [TASK] Add fill currentColor to all svg icons                                                                                                                            |
|            | - [TASK] Optimize svg images                                                                                                                                               |
|            | - [TASK] Use svgs as backend icons for ionicons                                                                                                                            |
|            | - [TASK] Use svgs as backend icons for glyphicons                                                                                                                          |
|            | - [TASK] Migrate text and icon types to string classes                                                                                                                     |
|            | - [TASK] Migrate text and icon sizes to string classes                                                                                                                     |
|            | - [TASK] Migrate textteaser                                                                                                                                                |
|            | - [TASK] Prefix region classes to avoid conflics with bootstrap 3                                                                                                          |
|            | - [!!!][TASK] Ensure classes and ids on template areas are unique                                                                                                          |
|            | - [TASK] Add missing html tags to page layout                                                                                                                              |
|            | - [TASK] Make page footer more easy to identify                                                                                                                            |
|            | - [TASK] Streamline navbar fixed behaviour                                                                                                                                 |
|            | - [TASK] Enhance placement of carousel content for overlays                                                                                                                |
|            | - [TASK] Add border column to simple layout                                                                                                                                |
|            | - [TASK] Migrate well styling to bs4                                                                                                                                       |
|            | - [TASK] Update bootstrap 4 to 4.1.3                                                                                                                                       |
|            | - [TASK] Use .tsconfig fileending and official structure for page tsconfig                                                                                                 |
|            | - [TASK] Seperate the configuration of content elements                                                                                                                    |
|            | - [TASK] Change primary default color                                                                                                                                      |
|            | - [TASK] Make translations more easy and hide layout fields in irre records                                                                                                |
|            | - [TASK] Add NetBeans IDE configuration to gitignore - fixes #539 (#540)                                                                                                   |
|            | - [TASK] Sort typoscript constants to make them more accessible                                                                                                            |
|            | - [TASK] Add sudo command again                                                                                                                                            |
|            | - [TASK] Use sudo for deployment stage                                                                                                                                     |
|            | - [TASK] Split deploy scripts                                                                                                                                              |
|            | - [!!!][TASK] Use .form.yaml instead of .yaml                                                                                                                              |
|            | - [TASK] Simplify icon registration                                                                                                                                        |
|            | - [TASK] Optimize content element header spacing                                                                                                                           |
|            | - [!!!][TASK] Add google webfont support for bs4 and add option to disable them                                                                                            |
|            | - [TASK] Make subnavigation compatible with bs 4 and 3                                                                                                                     |
|            | - [!!!][TASK] Move navigation constants to dedicated namespace                                                                                                             |
|            | - [TASK] Remove copyright from custom js files                                                                                                                             |
|            | - [TASK] Only keep minified contrib libs and remove sourcemaps                                                                                                             |
|            | - [TASK] Update grunt-modules and recompile sources                                                                                                                        |
|            | - [TASK] Update bootstrap to 4.1.1                                                                                                                                         |
|            | - [TASK] Improve quality of PHP code (#534)                                                                                                                                |
|            | - [TASK] Use travis build stages - fixes #531 (#533)                                                                                                                       |
|            | - [TASK] Add AdditionalConfiguration.php as shared file to deployment script                                                                                               |
|            | - [!!!][TASK] Enable css und js concatenation by default                                                                                                                   |
|            | - [TASK] Remove deployer configuration from scrutinizer analysis                                                                                                           |
|            | - [TASK] Remove unused code in DataRelationViewHelper                                                                                                                      |
|            | - [TASK] Use local webfontloader library                                                                                                                                   |
|            | - [TASK] Add php version and TYPO3 dev-master prerequisites to pull request template (#527)                                                                                |
|            | - [TASK] Use youtube-nocookie url in external media utility                                                                                                                |
|            | - [TASK] Migrate headline styling scaling to bs4                                                                                                                           |
|            | - [TASK] Streamline container width between bootstrap 3 and 4                                                                                                              |
|            | - [TASK] Simplify image gallery column rendering                                                                                                                           |
|            | - [TASK] Extract setup and constants for content elements                                                                                                                  |
|            | - [TASK] Drop obsolete constant                                                                                                                                            |
|            | - [TASK] Add picture support for figures                                                                                                                                   |
|            | - [TASK] Use local ratio labels for image croppings                                                                                                                        |
|            | - [TASK] Remove unused $rootPage                                                                                                                                           |
|            | - [TASK] Trigger plain js cookie consent events                                                                                                                            |
|            | - [TASK] Optimize typoscript constants for cookie consent                                                                                                                  |
|            | - [TASK] Update node dependencies                                                                                                                                          |
|            | - [TASK] Reduce webfont loader timeout to one second                                                                                                                       |
|            | - [TASK] Remove role from carousel-inner                                                                                                                                   |
|            | - [TASK] Mention bootstrap-package.com in default header comment                                                                                                           |
|            | - [TASK] Remove whitespace from header layouts                                                                                                                             |
|            | - [TASK] Always anonymize ip if google analytics is used                                                                                                                   |
|            | - [TASK] Update bootstrap 4 branch to 4.1.0                                                                                                                                |
|            | - [TASK] Add date to timeline label                                                                                                                                        |
|            | - [TASK] Make textpic and textmedia positions compatible with bs3 and bs4                                                                                                  |
|            | - [TASK] Optimize space usage of frame indentions                                                                                                                          |
|            | - [TASK] Add additional stylings for file and mail links                                                                                                                   |
|            | - [TASK] Add card menu styling for bs4                                                                                                                                     |
|            | - [TASK] Remove obsolete container wrappings for single columns                                                                                                            |
|            | - [!!!][TASK] Move footer column rendering to page templates                                                                                                               |
|            | - [TASK] Add robots.txt symlink in deployment                                                                                                                              |
|            | - [TASK] Change default copyright text                                                                                                                                     |
|            | - [!!!][TASK] Drop clean backendlayout in favor of simple                                                                                                                  |
|            | - [!!!][TASK] Move border column rendering to new section above breadcrumb                                                                                                 |
|            | - [TASK] Drop hardcoded template column sizes from templates - fixes #391                                                                                                  |
|            | - [TASK] Migrate panel element to bs4                                                                                                                                      |
|            | - [TASK] Add additional css classes to teaser elements                                                                                                                     |
|            | - [TASK] Add additional css classes to footer columns                                                                                                                      |
|            | - [TASK] Split footer sections into dedicated partials                                                                                                                     |
|            | - [TASK] Migrate frames and sections to bs4                                                                                                                                |
|            | - [TASK] Map button default to secondary in bs4                                                                                                                            |
|            | - [TASK] Add migration wizard for frame classes                                                                                                                            |
|            | - [!!!][TASK] Migrate frame classes well and jumbotron to background color classes                                                                                         |
|            | - [TASK] Split sections in special feature template                                                                                                                        |
|            | - [TASK] Migrate uploads to bs4                                                                                                                                            |
|            | - [TASK] Rename socialmedia icons to bootstrappackageicon                                                                                                                  |
|            | - [TASK] Migrate quote to bs4                                                                                                                                              |
|            | - [TASK] Migrate text in columns to bs4                                                                                                                                    |
|            | - [TASK] Adjust default variables in bs4                                                                                                                                   |
|            | - [TASK] Adjust indentions of scss variables                                                                                                                               |
|            | - [TASK] Migrate thumbnail menu to bs4                                                                                                                                     |
|            | - [TASK] Update modernizr to 3.6.0 and add css/focuswithin test                                                                                                            |
|            | - [TASK] Add more meaningful defaults for contactform                                                                                                                      |
|            | - [TASK] Move form configuration file                                                                                                                                      |
|            | - [TASK] Disable obsolete share element in lightbox                                                                                                                        |
|            | - [TASK] Migrate photoswipe lightbox to bs4                                                                                                                                |
|            | - [TASK] Make gallery compatible with bs3 and bs4                                                                                                                          |
|            | - [TASK] Make accordion compatible with bs3 and bs4                                                                                                                        |
|            | - [!!!][TASK] Make mainnavigation compatible with bs3 and bs4                                                                                                              |
|            | - [TASK] Move active bar styling of mainnavigation to pseudo element                                                                                                       |
|            | - [TASK] Streamline behaviour of icongroup                                                                                                                                 |
|            | - [TASK] Finetune styling of icongroup content element                                                                                                                     |
|            | - [TASK] Migrate navbar toggle to bs4                                                                                                                                      |
|            | - [TASK] Reduce timeout for font loading                                                                                                                                   |
|            | - [TASK] Migrate texticon styling to bs4                                                                                                                                   |
|            | - [!!!][TASK] Use theme constants instead of settings                                                                                                                      |
|            | - [!!!][TASK] Drop show footer option                                                                                                                                      |
|            | - [TASK] Streamline usages of frames                                                                                                                                       |
|            | - [TASK] Migrate figure styling to bs4                                                                                                                                     |
|            | - [TASK] Migrate carousel base styling to bs4                                                                                                                              |
|            | - [TASK] Adjust audio styling in bs4                                                                                                                                       |
|            | - [TASK] Migrate scroll-top styling to bs4                                                                                                                                 |
|            | - [TASK] Streamline rendering of breadcrump in bs3 and bs4                                                                                                                 |
|            | - [TASK] Include framework name and version in generated css files                                                                                                         |
|            | - [TASK] Load bootstrap 3 with a different package name to avoid later conflicts                                                                                           |
|            | - [TASK] Move ionicons to contrib folder                                                                                                                                   |
|            | - [TASK] Move all bootstrap 3 resources to contrib                                                                                                                         |
|            | - [TASK] Move bootstrap 3 includes to dedicated folders                                                                                                                    |
|            | - [TASK] Move bootstrap 3.x specific constants                                                                                                                             |
|            | - [TASK] Drop empty line in minified js files                                                                                                                              |
|            | - [TASK] Move javascript assets to contrib avoid naming conflicts                                                                                                          |
|            | - [TASK] Update jquery to 3.3.1                                                                                                                                            |
|            | - [TASK] Replace npm with yarn to ensure correct versions are always loaded                                                                                                |
|            | - [TASK] Cleanup gitignore                                                                                                                                                 |
|            | - [TASK] Remove TYPO3-9.x from testing until new testing setup available                                                                                                   |
|            | - [BUGFIX] Ensure popper.js is loaded before bootstrap.js                                                                                                                  |
|            | - [BUGFIX] Get rid of warning for count() thrown in less compiler with PHP 7.2                                                                                             |
|            | - [BUGFIX] Ensure condition matching assigns correct matches                                                                                                               |
|            | - [BUGFIX] Correct loading order of content elements in type select                                                                                                        |
|            | - [BUGFIX] Google font hook must modify setup after caching font files                                                                                                     |
|            | - [BUGFIX] Fix issue in ChangeLogScript after cleanup                                                                                                                      |
|            | - [BUGFIX] Ensure ensure typoscript language hook is working correctly                                                                                                     |
|            | - [BUGFIX] Do not override function param                                                                                                                                  |
|            | - [BUGFIX] Correct CGL                                                                                                                                                     |
|            | - [BUGFIX] Remove unsupported rendertype checkboxtoggle in accordion item                                                                                                  |
|            | - [BUGFIX] Correct defaults for accordion item                                                                                                                             |
|            | - [BUGFIX] Correct relative urls                                                                                                                                           |
|            | - [BUGFIX] Respect backendlayout gutter in image generation                                                                                                                |
|            | - [BUGFIX] Correct phpunit call in composer json                                                                                                                           |
|            | - [BUGFIX] Correct cgl in unit test                                                                                                                                        |
|            | - [BUGFIX] Use full command to run unit tests                                                                                                                              |
|            | - [BUGFIX] Correct travis config                                                                                                                                           |
|            | - [BUGFIX] Correct menu thumbnail constant assignments                                                                                                                     |
|            | - [BUGFIX] Use correct storage for media assets crop configuration                                                                                                         |
|            | - [BUGFIX] Use correct interface in data relation viewhelper                                                                                                               |
|            | - [BUGFIX] Remove unused code in texticon utility                                                                                                                          |
|            | - [BUGFIX] Add missing namespace declaration in google font service                                                                                                        |
|            | - [BUGFIX] Adapt icon type checks in text icon partials                                                                                                                    |
|            | - [BUGFIX] Add missing frame layout class                                                                                                                                  |
|            | - [BUGFIX] Correct typo in docheader of file filter processor (#545)                                                                                                       |
|            | - [BUGFIX] Add missing color information for navbar toggler in bs3                                                                                                         |
|            | - [BUGFIX] Correct position of above and below rendering in textpic and textmedia                                                                                          |
|            | - [BUGFIX] Correct grouping of icon enable toggle for subnavigation                                                                                                        |
|            | - [BUGFIX] Make complete background transparent if navigation is in transition mode                                                                                        |
|            | - [BUGFIX] Remove obsolete console.log from box plugin                                                                                                                     |
|            | - [BUGFIX] Use TsConfig instead of TSconfig                                                                                                                                |
|            | - [BUGFIX] Correct CGL                                                                                                                                                     |
|            | - [BUGFIX] Ensure correct positioning of preloader                                                                                                                         |
|            | - [BUGFIX] Process fieldName correctly in flexform data processor                                                                                                          |
|            | - [BUGFIX] Enable translations of timeline content element                                                                                                                 |
|            | - [BUGFIX] Add missing sorting field for timeline item                                                                                                                     |
|            | - [BUGFIX] Add missing system information icon                                                                                                                             |
|            | - [BUGFIX] Respect conditions in webfont includes                                                                                                                          |
|            | - [BUGFIX] Use correct namespace for navigation constants in layout                                                                                                        |
|            | - [BUGFIX] Override width and height attributes correctly in InlineSvgViewHelper                                                                                           |
|            | - [BUGFIX] Correct docheader of CoreVersionCondition                                                                                                                       |
|            | - [BUGFIX] Load extension configuration only when extensions are installed                                                                                                 |
|            | - [BUGFIX] Correct return type in GoogleFontService                                                                                                                        |
|            | - [BUGFIX] Correct typo in AdditionalFieldInformation                                                                                                                      |
|            | - [BUGFIX] Correct parsefunc to allow address tags outside p tags                                                                                                          |
|            | - [BUGFIX] Correct ckeditor address plugin to allow links for mail and www                                                                                                 |
|            | - [BUGFIX] Resolve deprecation for EXT:lang in TYPO3 v9.x                                                                                                                  |
|            | - [BUGFIX] Correct return types in GoogleFontHook and PreProcessHook                                                                                                       |
|            | - [BUGFIX] Correct doc comments in LanguageMenuProcessor                                                                                                                   |
|            | - [BUGFIX] Correct return type in ConstantsProcessor                                                                                                                       |
|            | - [BUGFIX] Update scrutinizer configuration (#532)                                                                                                                         |
|            | - [BUGFIX] Correct CGL                                                                                                                                                     |
|            | - [BUGFIX] Use .typoscript fileeindng for configuratio files in TYPO3 >= 9.3 for external includes                                                                         |
|            | - [BUGFIX] Remove double BackendLayouts in comment (#528)                                                                                                                  |
|            | - [BUGFIX] Remove unavailable return type void to support php < 7.2.x                                                                                                      |
|            | - [BUGFIX] Correct several typos - fixes #525                                                                                                                              |
|            | - [BUGFIX] Add missing height and width attributes to backend layout icons                                                                                                 |
|            | - [BUGFIX] Ensure links have adjustable colors for frame backgrounds                                                                                                       |
|            | - [BUGFIX] Strip new lines before and after pre tag                                                                                                                        |
|            | - [BUGFIX] Correct spacings                                                                                                                                                |
|            | - [BUGFIX] Caption alignment should follow image alignment - fixes #515                                                                                                    |
|            | - [BUGFIX] Rename folder to macht includes                                                                                                                                 |
|            | - [BUGFIX] Ensure language typoscript is added correctly                                                                                                                   |
|            | - [BUGFIX] Check if array is empty in language utility                                                                                                                     |
|            | - [BUGFIX] Use twoLetterIsoCode instead of language field                                                                                                                  |
|            | - [BUGFIX] Ensure language configuration is not overwritten                                                                                                                |
|            | - [BUGFIX] Correct syntax error in php 7.0 in LanguageMenuProcessor                                                                                                        |
|            | - [BUGFIX] Correct comment                                                                                                                                                 |
|            | - [BUGFIX] Make datefield required again                                                                                                                                   |
|            | - [BUGFIX] Use datefield to save date values in timeline                                                                                                                   |
|            | - [BUGFIX] Correct php-cs-fixer command in github issue template - fixes #512                                                                                              |
|            | - [BUGFIX] Properly close html tag in navigation partial                                                                                                                   |
|            | - [BUGFIX] Add missing compiled css files                                                                                                                                  |
|            | - [BUGFIX] Ensure that em is used instead of rem in bs3 card layouts                                                                                                       |
|            | - [BUGFIX] Ensure section index menu is also available for hidden pages if directly assigned                                                                               |
|            | - [BUGFIX] Correct calculations for border radius                                                                                                                          |
|            | - [BUGFIX] Correct language label                                                                                                                                          |
|            | - [BUGFIX] Correct identifier for button text in call to action item                                                                                                       |
|            | - [BUGFIX] Properly close html tag in content element dropins                                                                                                              |
|            | - [BUGFIX] Correct cgl violations                                                                                                                                          |
|            | - [BUGFIX] Remove obsolete class from footer section meta frame                                                                                                            |
|            | - [BUGFIX] Ensure that selected pages are shown in menu content elements                                                                                                   |
|            | - [BUGFIX] Adjust form override key to avoid conflicts with introduction                                                                                                   |
|            | - [BUGFIX] Add active state to meta menu                                                                                                                                   |
|            | - [BUGFIX] Add default if background color class is not set                                                                                                                |
|            | - [BUGFIX] Remove debug message                                                                                                                                            |
|            | - [BUGFIX] Use english in contact form subject                                                                                                                             |
|            | - [BUGFIX] Correct icongroup css                                                                                                                                           |
|            | - [BUGFIX] Use href instead of data attribute to avoid messing of urls                                                                                                     |
|            | - [BUGFIX] Remove testing console.log calls                                                                                                                                |
|            | - [BUGFIX] Correct toggle selector for main navigation hover                                                                                                               |
|            | - [BUGFIX] Use correct accordion_item language label in Backend.xlf (#490)                                                                                                 |
|            | - [BUGFIX] Show navigation toggler only above grid float breakpoint                                                                                                        |
|            | - [BUGFIX] Remove wrong placed closing html tag in copyright partial                                                                                                       |
|            | - [BUGFIX] Remove wrong placed space                                                                                                                                       |
|            | - [BUGFIX] Attributes on breadcrumb list item should be separated by whitespace                                                                                            |
|            | - [BUGFIX] Remove false condition for abstracts in card menus                                                                                                              |
|            | - [BUGFIX] Unset file array in css processing hook                                                                                                                         |
|            | - [BUGFIX] Correct CGL                                                                                                                                                     |
|            | - Revert "[BUGFIX] Set correct type for svg files in apache configuration"                                                                                                 |
|            | - [BUGFIX] Set correct type for svg files in apache configuration                                                                                                          |
|            | - [BUGFIX] Set correct type for javascript files in apache configuration                                                                                                   |
|            | - [CLEANUP] Move additional field information node to language compat                                                                                                      |
|            | - [CLEANUP] Move extension icon                                                                                                                                            |
|            | - [CLEANUP] Correct text and icon migration leftovers                                                                                                                      |
|            | - [CLEANUP] Correct class comment in abstract parser                                                                                                                       |
|            | - [CLEANUP] Minor cleanups                                                                                                                                                 |
|            | - [CLEANUP] Remove obsolete background image width settings                                                                                                                |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 9.1.0      | - [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine.                                                                                                      |
|            | - [!!!][FEATURE] Add auto lookup for page templates                                                                                                                        |
|            | - [!!!][FEATURE] Add auto lookup for page templates                                                                                                                        |
|            | - [FEATURE] Add auto lookup for page templates                                                                                                                             |
|            | - [TASK] Raise allowed TYPO3 version to 9.5.99                                                                                                                             |
|            | - [TASK] Add travis tests for php 7.2 on typo3 master                                                                                                                      |
|            | - [TASK] Move CMS9 backend branding to service that is only called on installation                                                                                         |
|            | - [TASK] Only write backend configuration if it has changes                                                                                                                |
|            | - [TASK] Remove correct addStaticFile function from extension scanner                                                                                                      |
|            | - [TASK] Move icon registration to localconf                                                                                                                               |
|            | - [TASK] Exclude php less libary from extension scanner                                                                                                                    |
|            | - [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine.                                                                                                      |
|            | - [BUGFIX] Set default backend configuration for CMS9                                                                                                                      |
|            | - [REVERT][BUGFIX] Install php extension intl on travis ci                                                                                                                 |
|            | - [BUGFIX] Install php extension intl on travis ci                                                                                                                         |
|            | - [BUGFIX] Adapt travisci build configuration to documentation                                                                                                             |
|            | - [BUGFIX] Ensure page layout class is never empty                                                                                                                         |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 9.0.0      | - [!!!][TASK] Remove obsolete pagetype popup - fixes #476                                                                                                                  |
|            | - [!!!][FEATURE] Make css classes of footer columns directly addressable                                                                                                   |
|            | - [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core                                                                                           |
|            | - [!!!][TASK] Remove mod_filter check by default                                                                                                                           |
|            | - [!!!][FEATURE] Load bootstrap rte configuration for all records by default                                                                                               |
|            | - [!!!][FEATURE] Enable links on dropdown menus in main navigation                                                                                                         |
|            | - [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level                                                                                     |
|            | - [!!!][TASK] Use .typoscript instead of .txt for configuration files                                                                                                      |
|            | - [!!!][BUGFIX] Streamline grunt less and less.php rendering                                                                                                               |
|            | - [!!!][TASK] Drop obsolete windows phone fix                                                                                                                              |
|            | - [!!!][TASK] Drop equalheight script                                                                                                                                      |
|            | - [FEATURE] Pass current element on trigger loaded.bk2k.responsiveimage - fixes #471                                                                                       |
|            | - [FEATURE] Allow links on carousel type background image - fixes #455                                                                                                     |
|            | - [FEATURE] Enable frontend editing for pages                                                                                                                              |
|            | - [FEATURE] Enable frontend editing for content elements                                                                                                                   |
|            | - [FEATURE] Make open accordion item configurable                                                                                                                          |
|            | - [FEATURE] Make gallery item column sizes configurable - fixes #465                                                                                                       |
|            | - [FEATURE]  Add table class in ckeditor by default                                                                                                                        |
|            | - [FEATURE] Add ckeditor plugin to insert boxes                                                                                                                            |
|            | - [FEATURE] Add carousel item type image                                                                                                                                   |
|            | - [FEATURE] Add configurable header and subheader css classes                                                                                                              |
|            | - [FEATURE] Add additional inline text style classes to editor config                                                                                                      |
|            | - [FEATURE] Add background image and base coloring support for content elements                                                                                            |
|            | - [FEATURE] Introduce frame-container and frame-inner for more detailed control options                                                                                    |
|            | - [FEATURE] Add auto lookup for carousel item templates and move wrapping links to partials                                                                                |
|            | - [FEATURE] Add UpperCamelCaseViewHelper                                                                                                                                   |
|            | - [FEATURE] Add option to show navigation title in carousel navigation                                                                                                     |
|            | - [FEATURE] Add navigation icons for main navigation                                                                                                                       |
|            | - [FEATURE] Add current version to system information toolbar                                                                                                              |
|            | - [FEATURE] Make scaling options for headlines configurable                                                                                                                |
|            | - [!!!][FEATURE] Make css classes of footer columns directly addressable                                                                                                   |
|            | - [FEATURE] Make footer meta section colors configurable                                                                                                                   |
|            | - [FEATURE] Make breadcrumb extendable to show title of single records                                                                                                     |
|            | - [FEATURE] Add example configuration for Microsoft-IIS                                                                                                                    |
|            | - [FEATURE] Add support for google-site-verification meta tag                                                                                                              |
|            | - [FEATURE] add element wrap in lib.dynamicContent                                                                                                                         |
|            | - [!!!][FEATURE] Load bootstrap rte configuration for all records by default                                                                                               |
|            | - [!!!][FEATURE] Enable links on dropdown menus in main navigation                                                                                                         |
|            | - [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level                                                                                     |
|            | - [FEATURE] Make config.typolinkEnableLinksAcrossDomains available through constant                                                                                        |
|            | - [FEATURE] Enable cropping of carousel background image                                                                                                                   |
|            | - [FEATURE] Enable cropping for image in carousel                                                                                                                          |
|            | - [!!!][TASK] Remove obsolete pagetype popup - fixes #476                                                                                                                  |
|            | - [TASK] Push notifications to slack                                                                                                                                       |
|            | - [TASK] Register bk2k as global namespace for viewhelpers                                                                                                                 |
|            | - [TASK] Check for explicit for null value in version toolbar item                                                                                                         |
|            | - [TASK] Adjust scrutinizer build                                                                                                                                          |
|            | - [TASK] Remove obsolete divider to tabs option                                                                                                                            |
|            | - [TASK] Rename ckeditor box plugin to avoid naming conflicts                                                                                                              |
|            | - [TASK] Reduce form css to minimum and adapt to new form elements                                                                                                         |
|            | - [TASK] Update package-lock                                                                                                                                               |
|            | - [TASK] Remove obsolete watch task for viewportfix                                                                                                                        |
|            | - [TASK] Add small option to ckeditor                                                                                                                                      |
|            | - [TASK] Add default css class to unordered lists from rte                                                                                                                 |
|            | - [TASK] Reduce default fields of carousel item                                                                                                                            |
|            | - [TASK] Streamline element quote TCA                                                                                                                                      |
|            | - [TASK] Hide relation tables to avoid problems when managed without proper context                                                                                        |
|            | - [TASK] Remove authors from phpdoc                                                                                                                                        |
|            | - [TASK] Streamline php header comments and add fixer rule                                                                                                                 |
|            | - [TASK] Remove obsolete margin bottom from breadcrumb                                                                                                                     |
|            | - [TASK] Enhance positioning of scroll to top button                                                                                                                       |
|            | - [TASK] Avoid ambiguous "uid" error (#480)                                                                                                                                |
|            | - [TASK] Use initialize arguments instead of render arguments in FalViewHelper                                                                                             |
|            | - [TASK] Use initialize arguments instead of render arguments in DataRelationViewHelper                                                                                    |
|            | - [TASK] Use initialize arguments instead of render arguments in ExplodeViewHelper                                                                                         |
|            | - [TASK] Add mini section styling                                                                                                                                          |
|            | - [TASK] Use initialize arguments instead of render arguments in ExternalMediaViewHelper                                                                                   |
|            | - [TASK] Use initialize arguments instead of render arguments in LastImageInfoViewHelper                                                                                   |
|            | - [TASK] Remove obsolete tt_content palettes                                                                                                                               |
|            | - [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core                                                                                           |
|            | - [TASK] Update readme and include frontend screenshot                                                                                                                     |
|            | - [TASK] Add .rst and .typoscript to editorconfig                                                                                                                          |
|            | - [TASK] Add deployment for www.bootstrap-package.com                                                                                                                      |
|            | - [!!!][TASK] Remove mod_filter check by default                                                                                                                           |
|            | - [TASK] Ensure link target attribute is only rendered if target is set - fixes #468                                                                                       |
|            | - [!!!][TASK] Use .typoscript instead of .txt for configuration files                                                                                                      |
|            | - [TASK] Update npm dependencies                                                                                                                                           |
|            | - [!!!][TASK] Drop obsolete windows phone fix                                                                                                                              |
|            | - [!!!][TASK] Drop equalheight script                                                                                                                                      |
|            | - [TASK] Remove release commit from changelog                                                                                                                              |
|            | - [TASK] Replace unwanted characters in commit messages                                                                                                                    |
|            | - [TASK] Add composer changelog script                                                                                                                                     |
|            | - [TASK] Drop development affix for version numbers                                                                                                                        |
|            | - [TASK] Add composer version script                                                                                                                                       |
|            | - [TASK] Cleanup code formatting for palette configuration                                                                                                                 |
|            | - [TASK] Use php-cs-fixer instead of php-codesniffer                                                                                                                       |
|            | - [TASK] Adjust composer keywords                                                                                                                                          |
|            | - [TASK] Raise php dependency to 7.x                                                                                                                                       |
|            | - [TASK] Remove not working ter upload                                                                                                                                     |
|            | - [TASK] Add typo3 8.7 to travis                                                                                                                                           |
|            | - [BUGFIX] Correct css selector for carousel item type text and image                                                                                                      |
|            | - [BUGFIX] Correct indentions                                                                                                                                              |
|            | - [BUGFIX] Show correct translations in language menu (#487)                                                                                                               |
|            | - [BUGFIX] Ensure aria-expanded is correctly set for accordion items                                                                                                       |
|            | - [BUGFIX] Ensure selected tab item is shown in the backend                                                                                                                |
|            | - [BUGFIX] Only support hover for on navbar toggle if hover is completely supported - fixes #459                                                                           |
|            | - [BUGFIX] Add missing namespaces to carousel small and fullscreen templates                                                                                               |
|            | - [BUGFIX] Use self instead of static in DataRelationViewHelper                                                                                                            |
|            | - [BUGFIX] Add css to precompiled css files                                                                                                                                |
|            | - [BUGFIX] Correct jumbotron button styling                                                                                                                                |
|            | - [BUGFIX] Add missing list styles to rte configuration                                                                                                                    |
|            | - [BUGFIX] Correct bootstraps calculation of container widths                                                                                                              |
|            | - [BUGFIX] Ensure correct link colors are loaded for footer meta section                                                                                                   |
|            | - [BUGFIX] Ensure footer list are actually centered                                                                                                                        |
|            | - [BUGFIX] Correct preview template assignments for listgroup and external_media                                                                                           |
|            | - [BUGFIX] Set default value for tt_content reference fields in *_item tables (#482)                                                                                       |
|            | - [BUGFIX] Add parseFunc handling to pre tags                                                                                                                              |
|            | - [BUGFIX] Correct rendering method of LastImageInfoVIewHelper                                                                                                             |
|            | - [BUGFIX] Correct indention in generic template                                                                                                                           |
|            | - [BUGFIX] Limit media element to youtube and vimeo                                                                                                                        |
|            | - [BUGFIX] Display cropping variants for textmedia - fixes #438                                                                                                            |
|            | - [BUGFIX] Ensure link is displayed correctly in readme                                                                                                                    |
|            | - [BUGFIX] Correct image link in readme                                                                                                                                    |
|            | - [BUGFIX] Add boostrap-package.com as known host                                                                                                                          |
|            | - [BUGFIX] Specify Deployer file                                                                                                                                           |
|            | - [BUGFIX] Fix sys_language_uid when adding item to translated tt_content (#458)                                                                                           |
|            | - [BUGFIX] Only show content in MenuSectionPages that is marked for section index - fixes #466                                                                             |
|            | - [BUGFIX] Close tags in meta menu properly - fixes #469                                                                                                                   |
|            | - [BUGFIX] Remove unused constant assignments - fixes #477                                                                                                                 |
|            | - [BUGFIX] Remove padding of navbar-collapse on desktop                                                                                                                    |
|            | - [!!!][BUGFIX] Streamline grunt less and less.php rendering                                                                                                               |
|            | - [BUGFIX] Remove wrong placed comma in navbar less file - fixes #460                                                                                                      |
|            | - [BUGFIX] Prepare colPos field for proper quoting (#452)                                                                                                                  |
|            | - [BUGFIX] Correct texticon preview paths on windows                                                                                                                       |
|            | - [BUGFIX] Remove .php_cs.dist from export                                                                                                                                 |
|            | - [BUGFIX] Correct less variable: @icon-font-path (#450)                                                                                                                   |
|            | - [BUGFIX] Correct sys_file_referece palettes for tab items                                                                                                                |
|            | - [BUGFIX] Correct sys_file_referece palettes for accordion items                                                                                                          |
|            | - [BUGFIX] Use override child tca for carousel background image                                                                                                            |
|            | - [BUGFIX] Correct value type of data-wrap for bootstrap carousels - fixes #437                                                                                            |
|            | - [BUGFIX] Remove conflicting btn stylings for legacy rtehtmlarea - fixes #447                                                                                             |
|            | - [BUGFIX] Correct dependencies for typo3 cms 9.x                                                                                                                          |
|            | - [CLEANUP] Fix typo by adding missing c to "seletor"                                                                                                                      |
|            | - Use correct closing tag                                                                                                                                                  |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 8.0.0      | - [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead                                                                                                        |
|            | - [FEATURE] Enable compression of generated css files                                                                                                                      |
|            | - [FEATURE] Add bootstrap responsive wrapper to table ce - fixes #385                                                                                                      |
|            | - [FEATURE] Add art direction for image, media, textpic and textmedia                                                                                                      |
|            | - [TASK] Force captions to break                                                                                                                                           |
|            | - [TASK] Make thumbnail menu more flexible                                                                                                                                 |
|            | - [TASK] Apply more flexible style on thumbnail menus                                                                                                                      |
|            | - [TASK] Remove cropping from text an image carousel item                                                                                                                  |
|            | - [TASK] Add missing rte configuration for content element panel                                                                                                           |
|            | - [TASK] Optimize brand placement                                                                                                                                          |
|            | - [TASK] Use SVGs files instead of png for logos in frontend                                                                                                               |
|            | - [TASK] Raise TYPO3 dependency in scrutinizer config                                                                                                                      |
|            | - [TASK] Remove obsolete adjustments for indexed search                                                                                                                    |
|            | - [TASK] Update missleading informations                                                                                                                                   |
|            | - [TASK] Raise TYPO3 Version requirement to 8.7 LTS                                                                                                                        |
|            | - [TASK] Migrate foreign selector to override child tca                                                                                                                    |
|            | - [TASK] Remove default rendering fallback, core provides information already                                                                                              |
|            | - [TASK] Remove deprecated localizationMode from TCA                                                                                                                       |
|            | - [TASK] Use new form framework instead of old mailform element                                                                                                            |
|            | - [TASK] Change seperator of page title                                                                                                                                    |
|            | - [TASK] Remove obsolete typoscript configuration                                                                                                                          |
|            | - [TASK] Adapt generic fluid template to match requirements for plugins                                                                                                    |
|            | - [TASK] Remove obsolete assignment for felogin                                                                                                                            |
|            | - [TASK] Adapt childtca override config for cropping variants                                                                                                              |
|            | - [TASK] Adapt indexed search to CMS8                                                                                                                                      |
|            | - [TASK] Remove obsolete login template                                                                                                                                    |
|            | - [TASK] Adapt frontend login to CMS8                                                                                                                                      |
|            | - [TASK] Add generic template for general usage                                                                                                                            |
|            | - [TASK] Remove obsolete tt_content typoscript configuration                                                                                                               |
|            | - [TASK] Add rte configuration for tabs and accordions                                                                                                                     |
|            | - [TASK] Restore typical content elements panel                                                                                                                            |
|            | - [TASK] Add textpic and textmedia to content element wizard media and text                                                                                                |
|            | - [TASK] Add ckeditor as dependency - fixes #431                                                                                                                           |
|            | - [TASK] Adapt php-cs-fixer configuration                                                                                                                                  |
|            | - [TASK] Remove obsolete canNotCollapse attribute                                                                                                                          |
|            | - [TASK] Resolve deprecation for general language file                                                                                                                     |
|            | - [TASK] Optimize gallery rendering to use flexbox for better performance                                                                                                  |
|            | - [TASK] Enhance gallery template                                                                                                                                          |
|            | - [TASK] Honor CMS8 cache convention for processed less files - fixes #371                                                                                                 |
|            | - [TASK] Resolve deprecation and use f:defaultCase for default in f:switch                                                                                                 |
|            | - [TASK] Remove deprecated TypoScript property config.noScaleUp                                                                                                            |
|            | - [TASK] Enable accessibility options to bypass navigation content elements                                                                                                |
|            | - [TASK] Streamline blockquote RTE rendering                                                                                                                               |
|            | - [TASK] Enable RTE h4 and h5 format tags                                                                                                                                  |
|            | - [TASK] Add table RTE configuration                                                                                                                                       |
|            | - [TASK] Add basic RTE styling                                                                                                                                             |
|            | - [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead                                                                                                        |
|            | - [TASK] Add html tag with namespace definitions to fluid tempaltes                                                                                                        |
|            | - [TASK] Streamline carousel content element                                                                                                                               |
|            | - [TASK] Streamline accordion content element                                                                                                                              |
|            | - [TASK] Remove type from content element configuration comment                                                                                                            |
|            | - [TASK] Streamline tab content element                                                                                                                                    |
|            | - [TASK] Move bullets content element in wizard to text                                                                                                                    |
|            | - [TASK] Streamline bullet content element with fsc                                                                                                                        |
|            | - [TASK] Move table content element to text tab in wizard                                                                                                                  |
|            | - [TASK] Streamline external media element key                                                                                                                             |
|            | - [TASK] Streamline listgroup rendering                                                                                                                                    |
|            | - [TASK] Move image content element in wizard to media tab                                                                                                                 |
|            | - [TASK] Move default content elements in wizard to dedicated tabs                                                                                                         |
|            | - [TASK] Remove header palette override                                                                                                                                    |
|            | - [TASK] Streamline uploads content element with fluid_styled_content                                                                                                      |
|            | - [TASK] Use more simple ctype for text and icon content element                                                                                                           |
|            | - [TASK] Adapt panel element for CMS8                                                                                                                                      |
|            | - [TASK] Move texticon to text palette in content element wizard                                                                                                           |
|            | - [TASK] Streamline default, div, header, and html templates                                                                                                               |
|            | - [TASK] Streamline quote definition and rendering                                                                                                                         |
|            | - [TASK] Remove obsolete thumbnail icon since its now available in core iconset                                                                                            |
|            | - [TASK] Remove obsolete textmedia icon                                                                                                                                    |
|            | - [TASK] Remove obsolete textteaser icon since its now available in core iconset                                                                                           |
|            | - [TASK] Streamline tabecolumn rendering                                                                                                                                   |
|            | - [TASK] Streamline textteaser definition and rendering                                                                                                                    |
|            | - [TASK] Add html tag with fluid namespace to text template                                                                                                                |
|            | - [TASK] Add html tag with fluid namespace to shortcut template                                                                                                            |
|            | - [TASK] Convert new lines to break for captions                                                                                                                           |
|            | - [TASK] Adapt media gallery from fluid_styled_content                                                                                                                     |
|            | - [TASK] Adapt media element for CMS8                                                                                                                                      |
|            | - [TASK] Move external media content element to media group                                                                                                                |
|            | - [TASK] Move audio content element to new media group                                                                                                                     |
|            | - [TASK] Set default header to h2                                                                                                                                          |
|            | - [TASK] Enforce linux lf for xml files                                                                                                                                    |
|            | - [TASK] Update default .htaccess                                                                                                                                          |
|            | - [TASK] Remove RTE HtmlArea config                                                                                                                                        |
|            | - [TASK] Minor cleanups                                                                                                                                                    |
|            | - [TASK] Streamline table rendering with fluid_styled_content                                                                                                              |
|            | - [TASK] Remove indexed search from new content element wizard                                                                                                             |
|            | - [TASK] Cleanup new content element wizard configuration                                                                                                                  |
|            | - [TASK] Move thumbnail menus to menu tab in content element wizard                                                                                                        |
|            | - [TASK] Migrate pages and subpages menus to dedicated content elements                                                                                                    |
|            | - [TASK] Migrate abstract menu to dedicated content element                                                                                                                |
|            | - [TASK] Migrate recently updated pages menu to dedicated content element                                                                                                  |
|            | - [TASK] Migrate related pages menu to dedicated content element                                                                                                           |
|            | - [TASK] Migrate section menus to dedicated content elements                                                                                                               |
|            | - [TASK] Migrate sitemap menus to dedicated content elements                                                                                                               |
|            | - [TASK] Migrate categorized content and pages menus to dedicated menus                                                                                                    |
|            | - [TASK] Migrate thumbnail menus to dedicated menus                                                                                                                        |
|            | - [TASK] Remove obsolete fields from sql file                                                                                                                              |
|            | - [TASK] Remove obsolete tt_content categorizable call                                                                                                                     |
|            | - [TASK] Remove obsolete bullets content element definition                                                                                                                |
|            | - [TASK] Remove obsolete menu content element definition                                                                                                                   |
|            | - [TASK] Remove obsolete table content element definition                                                                                                                  |
|            | - [TASK] Remove obsolete uploads content element definition                                                                                                                |
|            | - [TASK] Remove obsolete textmedia content element definition                                                                                                              |
|            | - [TASK] Remove admin panel pagets configuration                                                                                                                           |
|            | - [TASK] Remove obsolete mailform content element definition                                                                                                               |
|            | - [TASK] Remove obsolete shortcut content element definition                                                                                                               |
|            | - [TASK] Remove obsolete html content element definition                                                                                                                   |
|            | - [TASK] Remove obsolete list content element definition                                                                                                                   |
|            | - [TASK] Remove obsolete div content element definition                                                                                                                    |
|            | - [TASK] Remove obsolete tceform corrections                                                                                                                               |
|            | - [TASK] Remove obsolete image content element definition                                                                                                                  |
|            | - [TASK] Remove obsolete imageorient definition                                                                                                                            |
|            | - [TASK] Remove obsolete textpic content element definition                                                                                                                |
|            | - [TASK] Remove obsolete text content element definition                                                                                                                   |
|            | - [TASK] Remove obsolete header content element definition                                                                                                                 |
|            | - [TASK] Remove obsolete header_position                                                                                                                                   |
|            | - [TASK] Adapt texticon element for CMS 8                                                                                                                                  |
|            | - [TASK] Adapt tab element for CMS 8                                                                                                                                       |
|            | - [TASK] Adapt panel element for CMS 8                                                                                                                                     |
|            | - [TASK] Adapt carousel element for CMS 8                                                                                                                                  |
|            | - [TASK] Adapt accordion element for CMS 8                                                                                                                                 |
|            | - [TASK] Adapt audio element for CMS 8                                                                                                                                     |
|            | - [TASK] Adapt externalmedia element for CMS 8                                                                                                                             |
|            | - [TASK] Adapt listgroup element for CMS 8                                                                                                                                 |
|            | - [TASK] Streamline content element definitions and apply new header                                                                                                       |
|            | - [TASK] Add fallback to header section and remove overrides                                                                                                               |
|            | - [TASK] Update loginscreen and extension configuration experience                                                                                                         |
|            | - [TASK] Enable appearanceLinks palette for all content elements and add footer                                                                                            |
|            | - [TASK] Mark default content element layout sections as optional                                                                                                          |
|            | - [TASK] Adapt DropIn's from Fluid Styled Content                                                                                                                          |
|            | - [TASK] Migrate sectionframe to frame class, enable spacebefore and after                                                                                                 |
|            | - [TASK] Hide accordion-, carousel- and tabitems after copy                                                                                                                |
|            | - [TASK] Migrate requestUpdate to onChange                                                                                                                                 |
|            | - [TASK] Migrate showIconTable to selectIcons configuration                                                                                                                |
|            | - [TASK] Migrate colorChoice wizard to render type colorpicker                                                                                                             |
|            | - [TASK] Migrate TCA field quote_link and link inputLink                                                                                                                   |
|            | - [TASK] Set versioningWS to true                                                                                                                                          |
|            | - [TASK] Remove unused TCA control setting versioning_followPages                                                                                                          |
|            | - [TASK] Migrate TCA field bodytext to match new wizards                                                                                                                   |
|            | - [TASK] Migrate TCA fields starttime and endtime to inputDateTime                                                                                                         |
|            | - [BUGFIX] Adapt thumbnail list template                                                                                                                                   |
|            | - [BUGFIX] Remove all typolinks from backend preview of quote element                                                                                                      |
|            | - [BUGFIX] Remove typolink from backend preview of quote element                                                                                                           |
|            | - [BUGFIX] Add missing data prefix for lightbox caption                                                                                                                    |
|            | - [BUGFIX] Set lightbox caption                                                                                                                                            |
|            | - [BUGFIX] Add missing compiled css                                                                                                                                        |
|            | - [BUGFIX] Correct font size for text and image carousel item                                                                                                              |
|            | - [BUGFIX] Add missing support for subheader on carousel text and image                                                                                                    |
|            | - [BUGFIX] Exclude buttons from section link styling                                                                                                                       |
|            | - [BUGFIX] Add missing link colors to sections                                                                                                                             |
|            | - [BUGFIX] Use correct external media palette                                                                                                                              |
|            | - [BUGFIX] Correct spacing between carousel indicators                                                                                                                     |
|            | - [BUGFIX] Correct sorting in content element type select                                                                                                                  |
|            | - [BUGFIX] Correct resolving of less sourcemaps - fixes #413                                                                                                               |
|            | - [BUGFIX] Set default language value for custom records                                                                                                                   |
|            | - [BUGFIX] Add hammer.js mapping files for debugging - fixes #396                                                                                                          |
|            | - [BUGFIX] Resolve deprecation for language file usage                                                                                                                     |
|            | - [BUGFIX] Remove focus after clicking on scroll-top link - fixes #432                                                                                                     |
|            | - [BUGFIX] Add missing html tags and streamline selfclosing tags                                                                                                           |
|            | - [BUGFIX] Correct hook to clear less caches                                                                                                                               |
|            | - [BUGFIX] Correct relative path for less processing                                                                                                                       |
|            | - [BUGFIX] Ensure correct preformatted text rendering                                                                                                                      |
|            | - [BUGFIX] Correct TCA for parent record in accordion and tab item                                                                                                         |
|            | - [BUGFIX] Correct spelling of temp folder                                                                                                                                 |
|            | - [BUGFIX] Add type to linkVars language parameter                                                                                                                         |
|            | - [REVERT][BUGFIX] Remove tools from scrutinizer config but disable analyzer                                                                                               |
|            | - [BUGFIX] Remove tools from scrutinizer config                                                                                                                            |
|            | - [BUGFIX] Set TYPO3 version for scrutinizer build                                                                                                                         |
|            | - [BUGFIX] Require typo3/cms for scrutinizer build                                                                                                                         |
|            | - [BUGFIX] Restore location of well and jumbotron in frame class                                                                                                           |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 7.1.0      | - [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356                                                                         |
|            | - [!!!][TASK] Reintroduce "no frame" option - fixes #319                                                                                                                   |
|            | - [!!!][FEATURE] Add sections to visually group elements                                                                                                                   |
|            | - [!!!][FEATURE] Adjust make footer color configurable                                                                                                                     |
|            | - [!!!][FEATURE] Add support for google webfonts - fixes #115                                                                                                              |
|            | - [!!!][FEATURE] Add support for spacer in menu processor - fixes #335                                                                                                     |
|            | - [FEATURE] Make language uids for menu configurable                                                                                                                       |
|            | - [FEATURE] Add audio content element - fixes #399                                                                                                                         |
|            | - [FEATURE] Add preview for quote content element                                                                                                                          |
|            | - [FEATURE] rearrange settings for images and media assets (#395)                                                                                                          |
|            | - [FEATURE] Add signal to compile service - fixes #371                                                                                                                     |
|            | - [FEATURE] Add quotation content element                                                                                                                                  |
|            | - [FEATURE] Provide generated link and target from hmenu in menu resultset - fixes #380                                                                                    |
|            | - [FEATURE] Add smothscrolling and back to top link                                                                                                                        |
|            | - [FEATURE] Add content element text with teaser                                                                                                                           |
|            | - [FEATURE] Add constant for absolute favicon path                                                                                                                         |
|            | - [FEATURE] Add subheader to carousel item header                                                                                                                          |
|            | - [FEATURE] Add stickyheader to overlay carousel                                                                                                                           |
|            | - [FEATURE] Add fullscreen variant of carousel                                                                                                                             |
|            | - [FEATURE] Add support for additional iconsets and ionicons - fixes #357                                                                                                  |
|            | - [FEATURE] Add header_link to the icon of text widh icon content element - fixes #154                                                                                     |
|            | - [FEATURE] Add meta navigation support                                                                                                                                    |
|            | - [FEATURE] Add marker for frontendurl                                                                                                                                     |
|            | - [FEATURE] Add content element to display regular text in columns                                                                                                         |
|            | - [FEATURE] Allow html entities in carousel header                                                                                                                         |
|            | - [FEATURE] Colorize text selection in primary color                                                                                                                       |
|            | - [FEATURE] Make imported font weights of google webfonts editable                                                                                                         |
|            | - [FEATURE] Add transition option to switch from fade to slide - #356 #347                                                                                                 |
|            | - [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356                                                                         |
|            | - [!!!][FEATURE] Add sections to visually group elements                                                                                                                   |
|            | - [!!!][FEATURE] Adjust make footer color configurable                                                                                                                     |
|            | - [!!!][FEATURE] Add support for google webfonts - fixes #115                                                                                                              |
|            | - [!!!][FEATURE] Add support for spacer in menu processor - fixes #335                                                                                                     |
|            | - [FEATURE] Add content element for vimeo and youtube videos                                                                                                               |
|            | - [FEATURE] Clear less cache when all caches are cleared                                                                                                                   |
|            | - [TASK] Optimize html output                                                                                                                                              |
|            | - [TASK] Update dependencies                                                                                                                                               |
|            | - [TASK] Add instruction to clear initial TypoScript (#420)                                                                                                                |
|            | - [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5                                                                   |
|            | - [TASK] Update changelog schema                                                                                                                                           |
|            | - [TASK] Optimize travis and composer configuration for automatic ter uploading                                                                                            |
|            | - [TASK] Add TYPO3 8 dev-master to issue template                                                                                                                          |
|            | - [TASK] Add GitHub pull request template                                                                                                                                  |
|            | - [TASK] Add GitHub issue template                                                                                                                                         |
|            | - [TASK] remove uniqueLinkVars (#407)                                                                                                                                      |
|            | - [REVERT][TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5                                                           |
|            | - [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5                                                                   |
|            | - [TASK] Streamline php_cs fixer configuration with TYPO3 core                                                                                                             |
|            | - [TASK] Add checks for TYPO3_MODE to all tca override files configuration files                                                                                           |
|            | - [TASK] Throw exception if invalid arguments are passed to menu processor                                                                                                 |
|            | - [TASK] Drop IE8 and IE9 support for background images in carousel                                                                                                        |
|            | - [TASK] Always trim assigned variables in var viewhelper                                                                                                                  |
|            | - [TASK] Streamline position of columns for images and media to match textpic and textmedia                                                                                |
|            | - [TASK] Use shorthand array syntax in custom record tca                                                                                                                   |
|            | - [TASK] Do not set links bold in navigation bar                                                                                                                           |
|            | - [TASK] Remove obsolete use statement                                                                                                                                     |
|            | - [TASK] Update menu templates to use the generated links and targets from menuDataProcessor                                                                               |
|            | - [TASK] Replace f:link.page with static link (#370)                                                                                                                       |
|            | - [TASK] Exclude fixed navbar from scrolling to anchor                                                                                                                     |
|            | - [TASK] Add border between same sections                                                                                                                                  |
|            | - [TASK] Allow html entities for content element header                                                                                                                    |
|            | - [TASK] Remove obsolete constants                                                                                                                                         |
|            | - [TASK] Update modernizr to 3.3.1                                                                                                                                         |
|            | - [TASK] Adjust section size                                                                                                                                               |
|            | - [TASK] Move icon selector to new tab to have enough space for large icon sets - relates #357                                                                             |
|            | - [TASK] Move icon registration for text with icon to itemsProcFunc - relates #357                                                                                         |
|            | - [TASK] Remove unnessesary margin for last element in texticon content                                                                                                    |
|            | - [TASK] Remove dependency to glyphicons in carousel control - relates #356                                                                                                |
|            | - [TASK] Move carousel controls to partials - relates #356                                                                                                                 |
|            | - [TASK] Adjust indentions                                                                                                                                                 |
|            | - [TASK] Enable default and rename current to normal to ensure it can be overridden without removing the normal template                                                   |
|            | - [!!!][TASK] Reintroduce "no frame" option - fixes #319                                                                                                                   |
|            | - [TASK] Correct indention according to PSR2                                                                                                                               |
|            | - [TASK] Do not exclude composer.json from export                                                                                                                          |
|            | - [TASK] Add CType as class to outer content element frame                                                                                                                 |
|            | - [TASK] Add scaling for text-icon                                                                                                                                         |
|            | - [TASK] Scale headlines on smaller devices                                                                                                                                |
|            | - [TASK] Use dataprocessors instead of viewhelpers for carousel rendering                                                                                                  |
|            | - [TASK] Scale margin of frames                                                                                                                                            |
|            | - [TASK] Move page class and id from section to bodytag                                                                                                                    |
|            | - [TASK] Remove override for hover link decoration and use bootstrap variables instead - fixes #321                                                                        |
|            | - [TASK] Split tt_content overrides                                                                                                                                        |
|            | - [TASK] Optimize images                                                                                                                                                   |
|            | - [TASK] Use correct icons for tt_content imageorient palette - fixes #352                                                                                                 |
|            | - [TASK] Remove bower from travis tests                                                                                                                                    |
|            | - [TASK] Include photoswipe via npm instead of bower                                                                                                                       |
|            | - [TASK] Include hammerjs via npm instead of bower                                                                                                                         |
|            | - [TASK] Include bootstrap via npm instead of bower                                                                                                                        |
|            | - [TASK] Update jquery to 2.2.4                                                                                                                                            |
|            | - [TASK] Update hammer.js to 2.0.8                                                                                                                                         |
|            | - [TASK] Update grunt                                                                                                                                                      |
|            | - [TASK] Correct composer requirements for TYPO3                                                                                                                           |
|            | - [TASK] Remove unit tests from travis                                                                                                                                     |
|            | - [TASK] Fix Travis 2                                                                                                                                                      |
|            | - [TASK] Add color option to phpunit for travis                                                                                                                            |
|            | - [TASK] Add typo3 unit tests to travis                                                                                                                                    |
|            | - [TASK] Remove version from composer.json to prefer git tags                                                                                                              |
|            | - [TASK] Adjust editorconfig                                                                                                                                               |
|            | - [TASK] Add changelog for release 7.0.0                                                                                                                                   |
|            | - [TASK] Add missing changelog entries for 7.1.0                                                                                                                           |
|            | - [TASK] Enable basic frontend editing                                                                                                                                     |
|            | - [TASK] Add missing css fixes for #325                                                                                                                                    |
|            | - [TASK] Accessibility - fix of landmark error added role and aria- labelledby attribute                                                                                   |
|            | - [TASK] Accessabiliy - added role navigation to breadcrumb                                                                                                                |
|            | - [TASK] Accessibility - delete role contentinfo because you cant nest the same landmark in itself                                                                         |
|            | - [TASK] Accessibility - correction of landmark                                                                                                                            |
|            | - [TASK] Accessibility - Add link title attributes to logo constants, setup and html                                                                                       |
|            | - [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options                                                                                                             |
|            | - [BUGFIX] Add missing icon for text & media missing - fixes #417                                                                                                          |
|            | - [BUGFIX] Adapt link tag parsing for RTE fields                                                                                                                           |
|            | - [BUGFIX] Move class alias for menu processor to localconf to ensure correct loading                                                                                      |
|            | - [BUGFIX] Ensure that variables are not converted to strings by variable viewhelper                                                                                       |
|            | - [BUGFIX] Use correct layout (#408)                                                                                                                                       |
|            | - [BUGFIX] Correct position of carousel with fixed transparent header                                                                                                      |
|            | - [BUGFIX] Ensure that navbar-collapse has a maxheight if menu is fixed                                                                                                    |
|            | - [BUGFIX] Enforce checkout with linux lf consistent over all plattforms                                                                                                   |
|            | - [BUGFIX] Respect show in section menus option for pages in section index menu                                                                                            |
|            | - [BUGFIX] Use smooth scroll only on elements that have an hash... (#398)                                                                                                  |
|            | - [BUGFIX] Move temp folder back to root of typo3 temp                                                                                                                     |
|            | - [BUGFIX] Remove double imagecols field in showitem configuration                                                                                                         |
|            | - [BUGFIX] Workaround variable name cut off in CMS8 - fixes #388                                                                                                           |
|            | - [BUGFIX] Use string to identify bootstrap_package for adding static template                                                                                             |
|            | - [BUGFIX] Allow non ID values for language fields to avoid errors on mysql strict mode                                                                                    |
|            | - [BUGFIX] Correct sql definitions for bodytextfields for carousel, accordion and tab content element item                                                                 |
|            | - [BUGFIX] Correct indention of sql definition                                                                                                                             |
|            | - [BUGFIX] Correct teaser sql field definition                                                                                                                             |
|            | - [BUGFIX] Move TCA change in ext_tables.php to Configuration/TCA/Overrides (#389)                                                                                         |
|            | - [BUGFIX] Avoid specific DBMS literals in database queries (#384)                                                                                                         |
|            | - [BUGFIX] Fix inline documentation of MenuProcessor (#369)                                                                                                                |
|            | - [BUGFIX] Correct dependency for namelesscoder/typo3-repository-client                                                                                                    |
|            | - [BUGFIX] Correct positioning of carousel when header is fixed                                                                                                            |
|            | - [BUGFIX] Correct case error in ionicons template                                                                                                                         |
|            | - [BUGFIX] Use correct less variable in font-family-base                                                                                                                   |
|            | - [BUGFIX] Correct position of carousels on sticky header                                                                                                                  |
|            | - [BUGFIX] Add missing active state to stickyheader                                                                                                                        |
|            | - [BUGFIX] Correct navbar z-index in combination with fullscreen carousel in border column                                                                                 |
|            | - [BUGFIX] Ensure color for headlines is correclty inherited in footer sections                                                                                            |
|            | - [BUGFIX] Correct output of texticon if no icon is selected                                                                                                               |
|            | - [BUGFIX] Ensure carousel headline color is inherited                                                                                                                     |
|            | - [BUGFIX] Remove duplicate case in content element layout                                                                                                                 |
|            | - [BUGFIX] Correct paragraph rte classes                                                                                                                                   |
|            | - [BUGFIX] Fix tab elements missing on slided content                                                                                                                      |
|            | - [BUGFIX] Fix carousel elements missing on slided content                                                                                                                 |
|            | - [BUGFIX] Fix accordion elements missing on slided content                                                                                                                |
|            | - [BUGFIX] Correct texticon content element rendering with default layout - fixes #336                                                                                     |
|            | - [BUGFIX] Correct PSR-2 issues                                                                                                                                            |
|            | - [BUGFIX] Tabs, Accordion, and Carousel Items not referencing files on sys_file_reference and sys_refindex - fixes #349                                                   |
|            | - [BUGFIX] Bugfix/menuprocessor (#354)                                                                                                                                     |
|            | - [BUGFIX] Prevent double escaping of menu titles                                                                                                                          |
|            | - [BUGFIX] Remove vendor dir from php lint tests                                                                                                                           |
|            | - [BUGFIX] Load form configuration only if ext:form is installed                                                                                                           |
|            | - [BUGFIX] Respect padding in equalheight script                                                                                                                           |
|            | - [BUGFIX] Correct overlapping of content elements with indention - fixes #325                                                                                             |
|            | - [BUGFIX] Corrected label for attribute                                                                                                                                   |
|            | - [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options                                                                                                             |
|            | - "usind" is wrong                                                                                                                                                         |
|            | - Correct php-cs-fixer command                                                                                                                                             |
+------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| 7.0.0      | - [!!!][TASK] Send cache headers per default                                                                                                                               |
|            | - [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other                                                   |
|            | - [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor                                                                                                            |
|            | - [!!!][TASK] Disable link to top                                                                                                                                          |
|            | - [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts                                                                 |
|            | - [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default                                                                                         |
|            | - [!!!][TASK] Drop IE8 support                                                                                                                                             |
|            | - [!!!][FEATURE] Register optional PageTS config files                                                                                                                     |
|            | - [!!!][TASK] Remove some 6.2 specific fallbacks                                                                                                                           |
|            | - [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4                                                                                                                       |
|            | - [!!!][TASK] Drop TemplateFileResolver fallback for 6.2                                                                                                                   |
|            | - [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now                                                                                                |
|            | - [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev                                                                                                    |
|            | - [FEATURE] Remaining PageTS templates are configurable                                                                                                                    |
|            | - [FEATURE] Allow to disable footer-section with Typoscript constant.                                                                                                      |
|            | - [FEATURE] Allow photoswipe to be opened by url params                                                                                                                    |
|            | - [FEATURE] Add PhotoSwipe as lightbox                                                                                                                                     |
|            | - [FEATURE] Thumbnail Menu                                                                                                                                                 |
|            | - [FEATURE] Include records without default translation in content select                                                                                                  |
|            | - [FEATURE] Allow media content in accordion                                                                                                                               |
|            | - [FEATURE] Allow media content in tabs                                                                                                                                    |
|            | - [!!!][FEATURE] Register optional PageTS config files                                                                                                                     |
|            | - [TASK] Set defaults for backend configuration                                                                                                                            |
|            | - [TASK] Remove backend_layout upgrade wizard                                                                                                                              |
|            | - [TASK] Update hammerjs to 2.0.6                                                                                                                                          |
|            | - [TASK] Update jQuery to 2.2.1                                                                                                                                            |
|            | - [TASK] Update bootstrap to 3.3.6                                                                                                                                         |
|            | - [TASK] Update oyejorge/less.php to 1.7.0.10                                                                                                                              |
|            | - [TASK] Remove unneeded rte_transform options                                                                                                                             |
|            | - [TASK] Optimize export                                                                                                                                                   |
|            | - [TASK] Correct accordion rendering                                                                                                                                       |
|            | - [TASK] Correct tab rendering when no media is selected                                                                                                                   |
|            | - [TASK] Remove realurl autoconfiguration in preparation for realurl 2                                                                                                     |
|            | - [TASK] Add TYPO3 branch for 7.6 and exclude php versions < 7 on master                                                                                                   |
|            | - [TASK] Add php7 to travis                                                                                                                                                |
|            | - [TASK] Fix typo                                                                                                                                                          |
|            | - [TASK] RTE: Classes for links, see benjaminkott#281                                                                                                                      |
|            | - [TASK] Add note to vagrant box                                                                                                                                           |
|            | - [!!!][TASK] Send cache headers per default                                                                                                                               |
|            | - [TASK] Update jQuery to 2.2.0                                                                                                                                            |
|            | - [TASK] Test asset pipe on travis                                                                                                                                         |
|            | - [TASK] Fix Code according to CGL                                                                                                                                         |
|            | - [TASK] Add php cs fixer config                                                                                                                                           |
|            | - [TASK] Add TYPO3 CMS 8 as compatible version                                                                                                                             |
|            | - [TASK] Split source and distribution javascript files and use static paths                                                                                               |
|            | - [TASK] Adjust frontend login configuration                                                                                                                               |
|            | - [TASK] Add basic configuration and template overrides for indexed_search                                                                                                 |
|            | - [TASK] Add notice about content rendering extensions                                                                                                                     |
|            | - [TASK] Add header palette to cType list                                                                                                                                  |
|            | - [TASK] Use default layout as identifier when not backend_layout is selected                                                                                              |
|            | - [TASK] Use use titlefield instead of raw data in menus - fixes #273                                                                                                      |
|            | - [TASK] Add escaped class to example in lib.dynamicContent                                                                                                                |
|            | - [TASK] Use fluidtemplate for languagemenu rendering                                                                                                                      |
|            | - [TASK] Use fluidtemplate for breadcrumb rendering                                                                                                                        |
|            | - [TASK] Use fluidtemplate for mainnavigation rendering                                                                                                                    |
|            | - [TASK] Use fluidtemplate for subnavigation rendering                                                                                                                     |
|            | - [TASK] Add configuration for felogin                                                                                                                                     |
|            | - [TASK] Remove unneeded typo3_mode check                                                                                                                                  |
|            | - [TASK] Add textmedia content element                                                                                                                                     |
|            | - [TASK] Add typoscript parse functions                                                                                                                                    |
|            | - [TASK] Add basic FluidTemplate for mailform and set paths                                                                                                                |
|            | - [TASK] Add FluidTemplate for list                                                                                                                                        |
|            | - [TASK] Add typoscript setup as content rendering template                                                                                                                |
|            | - [TASK] Add FluidTemplate for shortcut                                                                                                                                    |
|            | - [TASK] Add description to menu processor                                                                                                                                 |
|            | - [TASK] Add FluidTemplate for menus                                                                                                                                       |
|            | - [TASK] Move uploads to typical page content tab                                                                                                                          |
|            | - [TASK] Remove unnessesary adjustment of the header palette                                                                                                               |
|            | - [TASK] Remove leftover mention of css_styled_content                                                                                                                     |
|            | - [TASK] Add FluidTemplate for uploads content element                                                                                                                     |
|            | - [TASK] Add TCA and wizard for content element div                                                                                                                        |
|            | - [TASK] Add TCA and wizard for content element html                                                                                                                       |
|            | - [TASK] Add content element wizard items for table                                                                                                                        |
|            | - [TASK] Add FluidTemplate for table content element                                                                                                                       |
|            | - [TASK] Add TCA for content element bullet list                                                                                                                           |
|            | - [TASK] Enable header position again                                                                                                                                      |
|            | - [TASK] Enable section frame again                                                                                                                                        |
|            | - [TASK] Add TCA for content element header                                                                                                                                |
|            | - [TASK] Add TCA for content element image                                                                                                                                 |
|            | - [TASK] Add content element wizard items for header, text, textpic                                                                                                        |
|            | - [TASK] Add TCA for content element textpic                                                                                                                               |
|            | - [TASK] Add TCA for content element text                                                                                                                                  |
|            | - [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other                                                   |
|            | - [TASK] Add case for tt_content rendering                                                                                                                                 |
|            | - [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor                                                                                                            |
|            | - [TASK] Drop experimental OnePage setup                                                                                                                                   |
|            | - [TASK] Flatten content element setup and add layouts and sections                                                                                                        |
|            | - [TASK] Several adjustments                                                                                                                                               |
|            | - [TASK] Make css adjustments                                                                                                                                              |
|            | - [TASK] Remove unnessesary column classes                                                                                                                                 |
|            | - [TASK] Move section frames to fluid                                                                                                                                      |
|            | - [!!!][TASK] Disable link to top                                                                                                                                          |
|            | - [TASK] Add FluidTemplate for image content element                                                                                                                       |
|            | - [TASK] Flatten content element rendering                                                                                                                                 |
|            | - [TASK] Steamline header usage templates                                                                                                                                  |
|            | - [TASK]  Add FluidTemplate for image content element                                                                                                                      |
|            | - [TASK]  Add FluidTemplate for textpic content element                                                                                                                    |
|            | - [TASK]  Add FluidTemplate for text content element                                                                                                                       |
|            | - [TASK]  Add FluidTemplate for header content element                                                                                                                     |
|            | - [TASK]  Add FluidTemplate for bullets content element                                                                                                                    |
|            | - [TASK] Add FluidTemplate for html content element                                                                                                                        |
|            | - [TASK] Remove dependency to styles.content.get definition                                                                                                                |
|            | - [TASK] Add FluidTemplate for divider content element                                                                                                                     |
|            | - [TASK] Migrate reference to "wizard_element_browser" to new "wizard_link" - fixes #258                                                                                   |
|            | - [TASK] Harden template names for page module previews                                                                                                                    |
|            | - [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts                                                                 |
|            | - [TASK] Use dataprocessing in listgroup content element                                                                                                                   |
|            | - [TASK] Use fluid template name for panel content element                                                                                                                 |
|            | - [TASK] Use fluid template name for list group content element                                                                                                            |
|            | - [TASK] Use fluid template name for external media content element                                                                                                        |
|            | - [TASK] Use fluid template name for default content element                                                                                                               |
|            | - [TASK] Use fluid template name for tab content element                                                                                                                   |
|            | - [TASK] Use fluid template name for carousel content element                                                                                                              |
|            | - [TASK] Use fluid template name for accordion content element                                                                                                             |
|            | - [TASK] Move css_styled_content typoscript configuration                                                                                                                  |
|            | - [TASK] Extract lib.dynamicContent from Base.ts                                                                                                                           |
|            | - [TASK] Remove iconInOptionTags and noIconsBelowSelect - fixes #243                                                                                                       |
|            | - [TASK] Add preview for content element list-group                                                                                                                        |
|            | - [TASK] Reduce size of external media preview                                                                                                                             |
|            | - [TASK] Update less.php to 1.7.0.9                                                                                                                                        |
|            | - [TASK] Update jQuery to 2.1.4                                                                                                                                            |
|            | - [TASK] Add recommended apache modules                                                                                                                                    |
|            | - [TASK] Enable async loading for modernizr and windowsphone-fix                                                                                                           |
|            | - [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default                                                                                         |
|            | - [!!!][TASK] Drop IE8 support                                                                                                                                             |
|            | - [TASK] Harden expression in PreProcessHook                                                                                                                               |
|            | - [TASK] Register content element listgroup icon                                                                                                                           |
|            | - [TASK] Register content element external-media icon                                                                                                                      |
|            | - [TASK] Register icon for element accordion-item                                                                                                                          |
|            | - [TASK] Adjust icons for element carousel-item types                                                                                                                      |
|            | - [TASK] Register icons for element carousel-item types                                                                                                                    |
|            | - [TASK] Register content element carousel icon                                                                                                                            |
|            | - [TASK] Register content element accordion                                                                                                                                |
|            | - [TASK] Register content element panel                                                                                                                                    |
|            | - [TASK] Register content element texticon                                                                                                                                 |
|            | - [TASK] Register content element tab-item icon                                                                                                                            |
|            | - [TASK] Register content element tab icon                                                                                                                                 |
|            | - [TASK] Harden expression in ExternalMediaUtility                                                                                                                         |
|            | - [!!!][TASK] Remove some 6.2 specific fallbacks                                                                                                                           |
|            | - [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4                                                                                                                       |
|            | - [!!!][TASK] Drop TemplateFileResolver fallback for 6.2                                                                                                                   |
|            | - [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now                                                                                                |
|            | - [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev                                                                                                    |
|            | - [TASK] Add preview for external media content element in page module - CMS7 only                                                                                         |
|            | - [TASK] Keep additional params for youtube urls                                                                                                                           |
|            | - [TASK] Add psr-4 autoload config to ext_emconf                                                                                                                           |
|            | - [TASK] add classes to containers useful to better select them with CSS and Javascript                                                                                    |
|            | - [TASK] fix tag closure for HTML5 head meta and link                                                                                                                      |
|            | - [TASK] breadcrumb: include the homepage link at the beginning of the breadcrumb.                                                                                         |
|            | - [TASK] breadcrumb: for the content of the links use alternative navigation title if it is set, else use page title.                                                      |
|            | - [BUGFIX] Remove skin setting from RTE configuration to ensure correct file is loaded in cms 8                                                                            |
|            | - [BUGFIX] Disable output escaping for viewhelpers                                                                                                                         |
|            | - [BUGFIX] Remove spaceless viewhelper                                                                                                                                     |
|            | - [BUGFIX] gallery in 2 cols also for devices >= 768px and < 992px                                                                                                         |
|            | - [BUGFIX] use the correct Typoscript constant in setup                                                                                                                    |
|            | - [BUGFIX] Correct grunt watch tasks                                                                                                                                       |
|            | - [BUGFIX] Add header to cType List                                                                                                                                        |
|            | - [BUGFIX] Respect sorting for tab items                                                                                                                                   |
|            | - [BUGFIX] Respect sorting for accordion items                                                                                                                             |
|            | - [BUGFIX] Correct PSR2  issue                                                                                                                                             |
|            | - [BUGFIX] Add missing column overrides for text and textpic content elements                                                                                              |
|            | - [BUGFIX] Check if content element type exists before merging                                                                                                             |
|            | - [BUGFIX] Merge type configuration in TCA instead of overriding                                                                                                           |
|            | - [BUGFIX] Add missing comma in uploads field selection                                                                                                                    |
|            | - [BUGFIX] Correct accordion content element markup                                                                                                                        |
|            | - [BUGFIX] Add missing showIconTable setting for field icon                                                                                                                |
|            | - [BUGFIX] Adjust imagepath and wizard settings for carousel links                                                                                                         |
|            | - [BUGFIX] Adapt moved language file                                                                                                                                       |
|            | - [BUGFIX] Add missing renderTypes to tt_content fields                                                                                                                    |
|            | - [BUGFIX] Add missing renderTypes to tab item                                                                                                                             |
|            | - [BUGFIX] Add missing renderTypes to accordion item                                                                                                                       |
|            | - [BUGFIX] Add missing renderTypes to carousel item                                                                                                                        |
|            | - [BUGFIX] Correct typoscript paths                                                                                                                                        |
|            | - [BUGFIX] Add missing link for media type image in tabs                                                                                                                   |
|            | - [BUGFIX] Add missing link for media type image in accordion                                                                                                              |
|            | - [BUGFIX] Correct composer branch-alias                                                                                                                                   |
|            | - [BUGFIX] Make links visible in jumbotron - fixes #248                                                                                                                    |
|            | - [BUGFIX] Fix behaviour of strictly allowed RTE classes                                                                                                                   |
|            | - [BUGFIX] Add the table colspan and rowspan attributes to allowed attributes in RTE configuration                                                                         |
|            | - [BUGFIX] Correct height operator for opengraph image - fixes #227                                                                                                        |
|            | - Fix more typos / grammar issues                                                                                                                                          |
|            | - Fix typos found by codespell                                                                                                                                             |
|            | - Followup: Use spaces instead of tabs                                                                                                                                     |
|            | - Fix grammar                                                                                                                                                              |
|            | - Removed duplicate "List Group" entry                                                                                                                                     |
|            | - add static to getVariablesFromConstants() because of deprecation notice                                                                                                  |
|            | - Add crop to carousel background image                                                                                                                                    |
|            | - Use settings instead of variables for configuration in FLUIDTEMPLATE                                                                                                     |
|            | - [WIP] Image rendering                                                                                                                                                    |
|            | - [WIP] Adjust Tab Rendering                                                                                                                                               |
|            | - [CLEANUP] Bootstrap Package external media item                                                                                                                          |
|            | - [CLEANUP] Bootstrap Package list group item                                                                                                                              |
|            | - [CLEANUP] Rendering definition for default content element                                                                                                               |
|            | - [CLEANUP] Remove unused header partial                                                                                                                                   |
|            | - Add namespace to ext_update class                                                                                                                                        |
|            | - Update constants.txt                                                                                                                                                     |
|            | - Update CssStyledContent.txt                                                                                                                                              |
|            | - Add data-preload to force image preload                                                                                                                                  |
|            | - Merge remote-tracking branch 'upstream/master'                                                                                                                           |
|            | - [CLEANUP] Remove unused file                                                                                                                                             |
|            | - [CLEANUP] Correct email in bower setup                                                                                                                                   |
|            | - Merge remote-tracking branch 'upstream/master' into disable-meta-section                                                                                                 |
|            | - Add mod_filter to apache recommendations                                                                                                                                 |
|            | - [CLEANUP] Correct Readme                                                                                                                                                 |
|            | - [CLEANUP] PSR-2 stuff                                                                                                                                                    |
|            | - [CLEANUP] Remove unused use statements in install service                                                                                                                |
|            | - [TROLL] Update copyright text                                                                                                                                            |
|            | - [CLEANUP] Initialize fieldsToUpdate in ext_update                                                                                                                        |
|            | - Merge remote-tracking branch 'upstream/master' into disable-meta-section                                                                                                 |
|            | - [CLEANUP] Remove unused Hooks and Xclass                                                                                                                                 |
|            | - [CLEANUP] Remove TYPO3 6.2 and PHP5.3 and PHP5.4 from Travis CI                                                                                                          |
|            | - [CLEANUP] Remove unused use statements in realurl autoconfig                                                                                                             |
|            | - bring metaSection enable setting to constants                                                                                                                            |
|            | - Update setup.txt with default meta section enabled                                                                                                                       |
|            | - change Footer.html to disable meta output                                                                                                                                |
|            | - Fixed typos                                                                                                                                                              |
|            | - Fixed typos                                                                                                                                                              |
|            | - Correction of minor typo                                                                                                                                                 |
|            | - Force preload images to allow print                                                                                                                                      |
|            | - Add useful RTE buttons                                                                                                                                                   |
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
