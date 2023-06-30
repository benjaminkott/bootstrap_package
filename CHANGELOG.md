# 13.0.5

## BUGFIX

- 9c7bbe6f [BUGFIX] Make IconWizard compatible with v11

## Contributors

- Benjamin Kott

# 13.0.4

## TASK

- 96b3a914 [TASK] Improve icon selector performance in backend (#1392)

## BUGFIX

- f02e24bc [BUGFIX] Correct docs for overrideParserVariables

## Contributors

- Benjamin Kott

# 13.0.3

## TASK

- 2fbfd0c0 [TASK] Add tests for update scripts (#1388)
- d08447ae [TASK] Add display: swap to iconfont
- acbc2ee6 [TASK] Add label to extended resume form field of indexed search
- 029df1d0 [TASK] Remove obsolete intrinsicsize attribute (#1380)
- 9579cf7f [TASK] Optimize indexed search form
- 2f078474 [TASK] Enable functional tests for v12 (#1219)
- 61640d1e [TASK] Drop legacy path include test
- 37ce7eb1 [TASK] Set dev env to 8.2
- 22fd5cb7 [TASK] Update php-cs-fixer
- 618ce0ee [TASK] Add aria-hidden to social-media icons
- e8ed7295 [TASK] Move Registering of Icons to ServiceContainer  (#1374)
- 9eeb6486 [TASK] Add aria-labels for main and sub navigation (#1363)
- 70b2e188 [TASK] Drop link decoration settings from constant editor
- 968ea224 [TASK] Only use aria-current for the last item in breadcrumb (#1359)
- 13eb6dcd [TASK] Add meaningful label to each second field in a group in extended search form (#1351)
- 8247f48e [TASK] Duplicate css class removed (#1345)
- ada51882 [TASK] Add aria-hidden attributes for decorative icons (#1336)
- 344fef87 [TASK] Update bundled scssphp to v1.11.0
- e75e83e3 [TASK] Update popper.js and some build deps
- 89c2228b [TASK] Update to Bootstrap 5.3.0

## BUGFIX

- e6f69713 [BUGFIX] Make screenreader current label translatable
- 08cb3706 [BUGFIX] Align sitemap behavior with core
- 5181da79 [BUGFIX] Remove unwanted vertical gap on sections
- 1657d99c [BUGFIX] Correct scroll position and prevent click if target exists on site
- d4f9792e [BUGFIX] Correct column gap count for 3 column layout
- a45f0187 [BUGFIX] Drop obsolete felogin config
- cb43c6c8 [BUGFIX] Correct media position in accordion and tab items (#1384)
- 4d8b8436 [BUGFIX] Restore search rules functionality
- 5f208050 [BUGFIX] Correct search form classes
- 160319f0 [BUGFIX] Use contextual icon color for system information icon (#1377)
- 3d96d245 [BUGFIX] Correct path to photoswipe assets
- 002dd8fc [BUGFIX] Fix access to overrideParserVariables
- 4128f24a [BUGFIX] Handle allowed file extensions for TYPO3 v12 (#1365)
- 9ce3b0b1 [BUGFIX] Fix Sticky Header (#1362)
- 52a834fd [BUGFIX] Source mapping is now public path agnostic (#1352)
- 0187b254 [BUGFIX] Fix missing spaces in the output of content elements (#1343)
- 5ffa09cc [BUGFIX] Add title to social links
- 7d4e95ca [BUGFIX] Avoid text-muted for unavailable languages
- 55ca8360 [BUGFIX] Undefined array keys in Compile Service

## Contributors

- Benjamin Kott
- Eike Starkmann
- Elias Häußler
- Felix Althaus
- Lina Wolf
- Oliver Thiele
- Simon Praetorius
- Sven Jürgens
- Uwe
- jwundermann
- schmigotzki
- undkonsorten

# 13.0.2

## TASK

- 8118d41d [TASK] Update frontend dependencies (#1272)
- 794eefd6 [TASK] Make test dataprovider static (#1271)
- 51be7197 [TASK] add additionalAttributes to FrameViewHelper (#1268)
- fd10bf81 [TASK] Streamline TypoScript comments (#1267)
- 87536c14 [TASK] Support CSP for background images in v12 (#1265)
- c0ea6dae [TASK] Adjust phpstan (#1266)
- c5b078c5 [TASK] Allow 12.4 in ext_emconf.php

## BUGFIX

- ee768c2d [BUGFIX] Correct multiplier value float type being transformed to integer. (#1270)
- 278d0fb0 [BUGFIX] Add missing no-cookie to media additionalConfig (#1122)
- 9e8fce09 [BUGFIX] Set testing framework versions (#1269)
- 6e8c4a59 [BUGFIX] Correct duplicate constant editor categories
- 339a381c [BUGFIX] Fix undefined variables access (PHP 8+ compatibility) (#1218)
- 0a970663 [BUGFIX] Wrong constant label (#1227)
- 056c6f37 [BUGFIX] Allow to disable backend layouts (#1242)
- a7e05232 [BUGFIX] Render "hidden" fields as `checkboxToggle` (#1247)

## Contributors

- Andreas Fernandez
- Benjamin Kott
- Christian Kuhn
- François Suter
- Patrick Lenk
- Sven Petersen
- Thomas Kieslich

# 13.0.1

## BREAKING

- e852dc36 [!!!][BUGFIX] Correct responsive image config for backend layouts (#1232)

## BUGFIX

- 55b4e934 [BUGFIX] Correct image scaling in thumbnail menus
- 4ffcea6a [BUGFIX] Correct image scaling in card menus
- fd3ba341 [BUGFIX] Correct image scaling in card groups
- dcc08bb3 [BUGFIX] Correct image scaling in accordions
- 195f60cc [BUGFIX] Correct image scaling in tabs
- e852dc36 [!!!][BUGFIX] Correct responsive image config for backend layouts (#1232)
- 4d5c8d46 [BUGFIX] Use extension configuration service to access config

## Contributors

- Benjamin Kott

# 13.0.0

## BREAKING

- b3cdba77 [!!!][TASK] Drop jquery (#1212)
- ec37abf5 [!!!][FEATURE] Introduce Google Tag Manager support
- 61f5957d [!!!][TASK] Adapt useragent to fetch woff2 - fixes #840

## FEATURE

- ec37abf5 [!!!][FEATURE] Introduce Google Tag Manager support
- 028a786b [FEATURE] Use translatable labels for container names and columns (#1110)
- 67fee214 [FEATURE] Introduce implode vh and make explode vh more useful
- 600372b9 [FEATURE] Introduce frame options
- d513638b [FEATURE] Add repeat option for frame background images
- c293241b [FEATURE] Add footer navigation and contact area (#1054)

## TASK

- b1e50ad9 [TASK] Adapt dependencies
- 8c5ab0dc [TASK] Use actions/cache@v3
- 7ac2d5cd [TASK] Replace deprecated set-output command (#1213)
- b21ed664 [TASK] Update build dependencies
- 3c64f9f3 [TASK] Update fantasticon to 2.0.0
- c280e6a4 [TASK] Update bootstrap to 5.2.3
- 99bd5458 [TASK] Bump actions/checkout to v3 (#1214)
- 954dbb8d [TASK] Remove leftover legacy popper.js
- c51b3568 [TASK] Remove leftovers from bootstrap 4 removal
- 36836fb6 [TASK] Update dependencies
- b3cdba77 [!!!][TASK] Drop jquery (#1212)
- 1449d020 [TASK] Update Bootstrap to 5.2.2
- 6e5da6d8 [TASK] Drop Bootstrap 4
- f2827223 [TASK] Update action and node version
- e4c3b5fe [TASK] Make Bootstrap Package TYPO3 v12 compatible (#1201)
- cfed9c0e [TASK] Remove obsolte whitespaces in readme
- aad164e5 [TASK] Make paginator v12 compatible (#1209)
- 8b1a05cd [TASK] Update compatibility chart
- 614cb769 [TASK] Drop obsolete sql definitions
- fd6f747b [TASK] Streamline contact form example
- 11e706eb [TASK] Apply TCA changes
- 53536ddd [TASK] Drop v10 support (#1206)
- 8268cd2b [TASK] Streamline upgrade wizards
- 527f7dbd [TASK] Use public directory for setup instead of web
- 441f76c5 [TASK] Execute all tests if basic setup was sucessful
- b7dfea8f [TASK] Move test scss resources to public
- 6f202344 [TASK] Fix indention
- dddf5f28 [TASK] Upgrade version of phpstan
- 3119d53e [TASK] Store composer-cache to speed up CI (#1172)
- 844305ea [TASK] Add PHP 8.1 to CI (#1171)
- 0aebd8d6 [TASK] Remove obsolete labeler config
- 0089702e [TASK] Update frontend dependencies
- 39210d64 [TASK] Update bootstrap versions to 4.6.1 and 5.1.3
- fb8aff15 [TASK] Update ddev config
- 33325b9a [TASK] Drop commit message check and labeler to avoid unnessesary long ci runs
- e4bc3649 [TASK] Adapt pull request template to match current ci
- 24167a70 [TASK] Adapt PHPDoc annotation in ScssParserTest
- e0d69522 [TASK] Adjust handling of ExtensionConfiguration version differences for phpstan
- 7ac32dfd [TASK] Allow composer plugins
- 61f5957d [!!!][TASK] Adapt useragent to fetch woff2 - fixes #840
- 36a8ddb0 [TASK] Update scssphp to v1.8.1 (#1114)
- df63feaa [TASK] Use @import syntax for TS includes (#1090)
- 6cd7bd98 [TASK] Update deployment
- 0f3c0350 [TASK] Require at least v11.5 LTS on the 11 cycle
- fa979f2c [TASK] Migrate form definition (#1095)
- 82273ebb [TASK] Accept frame height in frame vh config
- 70ce6fee [TASK] Update frontend dependencies
- f0f91258 [TASK] Update scssphp to v1.7.0
- 6dc537d6 [TASK] Move frame rendering to vh (#1081)
- 3017050d [TASK] Allow pagination template to be overwritten (#1080)
- 33cd9112 [TASK] Checkstyle typoscript
- 96577b42 [TASK] Allow menu pages/subpages to render recursive by default
- 65967f12 [TASK] Update Bug Report template (#1069)
- c799bbce [TASK] Provide frontend build custom commands (#1068)
- 02171318 [TASK] Split mainnavigation into multiple templates
- 0ce5eb8a [TASK] Exclude submenues from indexing (#1061)
- 911de9c3 [TASK] Move env vars to DDEV config (#1059)
- 84786da8 [TASK] Add .build/bin to $PATH (#1058)
- 6ff633e8 [TASK] Update readme to include v12
- f62618a0 [TASK] Update .gitattributes (#1051)
- 5cf397f2 [TASK] Normalize composer.json (#1050)
- caa290a8 [TASK] Update branch alias (#1047)
- 32a05bd6 [TASK] correct Photoswipe opening animation (#941)

## BUGFIX

- 744c0c4b [BUGFIX] Adapt phpstan annotations
- 39fcbacd [BUGFIX] Add figure tag to external blocks in rte parsing
- 6214e23a [BUGFIX] Use padding instead of margin for RTE spacing
- cd051feb [BUGFIX] Use new rendering context for pagination view
- 6dc2ac6f [BUGFIX] Prevent PHP Warning: Undefined array key (#1208)
- 94afc27f [BUGFIX] PHPStan return types (#1199)
- e1c8684f [BUGFIX] Swap caption and title in photoswipe if no title is given (#1181)
- f535de10 [BUGFIX] Correct type issue in upgrade wizard one more more time
- 779fae94 [BUGFIX] Correct type issue in upgrade wizard one more time
- 32994827 [BUGFIX] Correct type issue in upgrade wizard
- e2bde3ec [BUGFIX] Replace deprecated PHP 8.1 filter FILTER_SANITIZE_STRING
- abfe2d9d [BUGFIX] Avoid unitialized variable in VersionToolbarItem (#1167)
- 318e2c4a [BUGFIX] Avoid early fatal with TYPO3 v12 (#1166)
- b0b3f6aa [BUGFIX] Respect target and add rel in all page template menus
- 2fe6da33 [BUGFIX] PHPStan issues (#1133)
- 0507bb52 [BUGFIX] Register classes in DI container (#1129)
- 1dbb1ab2 [BUGFIX] Add missing xlarge crop variant - fixes #1088
- bedac0cd [BUGFIX] Respect icon config in footer navigation - fixes #1109
- 25efe3ea [BUGFIX] Do not call "libxml_disable_entity_loader" in PHP 8 (#1105)
- 3c6c1040 [BUGFIX] Respect and adjust responsive image configuration for carousel background_image
- 9b04c8b8 [BUGFIX] Respect theme configuration in footer navigation
- 750c2067 [BUGFIX] Get frontend controller from request if available
- 5bde1c56 [BUGFIX] Use bootstrap 5 styles in RTE (#1091)
- 77ce933c [BUGFIX] Do not pass absolute path to resource factory
- b1ad3814 [BUGFIX] BrandingService conditions (#1094)
- 0eccc6af [BUGFIX] Remove pollution of global scss variables
- 686dd1d2 [BUGFIX] Ensure accordion elements collapse as intended with bootstrap 5
- 127c3afc [BUGFIX] Avoid overrides of global scss variables within card-panel comonent
- 0c8e4a2e [BUGFIX] Allow labeler from forks (#1085)
- ad453360 [BUGFIX] Fix breadcrumb when "breadcrumbExtendedValue" is used
- 04574fa7 [BUGFIX] Wrong default
- 7c454771 [BUGFIX] Set correct classes for background image options in frame viewhelper
- 02b0c5fd [BUGFIX] Add automatic contrast calculations again for backgrounds - fixes #1057
- 94f3fff4 [BUGFIX] Change initialization of ConfigurationManager to make it compatible with 10.4
- c44ade43 [BUGFIX] Change initialization of ConfigurationManager to make it compatible with 10.4
- 116ebebd [BUGFIX] Hide header for container elements - fixes #1079
- 32d26092 [BUGFIX] Ensure spacing for frames is applied when set to none
- 8f8e41d9 [BUGFIX] Correct spacing for embedded frames
- a5c1e26f [BUGFIX] phpstan baseline
- 136f2d98 [BUGFIX] Missing theme colors (#1067)
- 91161e6a [BUGFIX] Array access warnings in PHP 8 (#1063)
- 8b5c3910 [BUGFIX] CGL in CI workflow (#1064)
- 3bc7af8c [BUGFIX] Docs rendering (#1062)
- 36ea7ddd [BUGFIX] Mark menu items correctly as closed - fixes #1052
- b59e5bbf [BUGFIX] Include correct popper.js version for bootstrap 5
- b9ef0cec [BUGFIX] Wrong table classes and add missing ones (#927)
- 2593545f [BUGFIX] Remove obsolete margin removal of contact address
- 45f0d3fd [BUGFIX] Preserve custom layout values (#1055)
- 9e34f8e9 [BUGFIX] Correct versions after #1047
- 262899e3 [BUGFIX] Add Bootstrap v5 options to Fullscreen and Small carousel (#1053)
- 5c419c5a [BUGFIX] Remove deprecated softref `images` (#1046)
- 33447518 [BUGFIX] Make embedded layouts mote strict and reset backgrounds properly
- af347d59 [BUGFIX] Let image service resolve svgicon - fixes #1042
- d5d0590d [REVERT][BUGFIX] Update doctrine usages (#1037) (#1044)
- 78dc6133 [BUGFIX] Add missing embed css to bootstrap 5 (#1043)
- e687172a [BUGFIX] Remove external softref to ext:rtehtmlarea (#1039)

## MISC

- 20ef22e5 Exclude Tests folder for export (#1157)
- 9b1814b4 [DOCS] Align with new TYPO3 documentation standards (#1158)
- a67e374b [DOCS] Update Bootstrap version

## Contributors

- Alexander Nitsche
- Andreas Fernandez
- Andreas Fernandez
- Benjamin Kott
- Christian Kuhn
- Frank Nägler
- Gilbertsoft
- Patrick Lenk
- Simon Schaufelberger
- Stephan Sellner
- Sven Burkert
- Sven Jürgens
- eckard gehrke

# 12.0.0

## SECURITY

- de3a568f [SECURITY] Ensure content element subheader is HTML encoded

## BREAKING

- 8c63fd58 [!!!][TASK] Add support for Bootstrap v5 (#1016)
- f5657558 [!!!][TASK] Replace fluid pagination widget (#1012)
- e4c07088 [!!!][TASK] Drop webfontloader (#1011)
- 8323a17b [!!!][FEATURE] Introduce embedded frames and improve rendering
- 34a9680b [!!!][TASK] Replace deprecated lastImageInfo access (#1005)
- 82b21786 [!!!][TASK] Remove TYPO3 9.5 support (#979)
- c0ba1c96 [!!!][TASK] Remove InstallService (#977)
- 35fdfd78 [!!!][TASK] Remove bootstrap3 (#826)

## FEATURE

- 0e55bdc0 [FEATURE] Improve icon registry (#1038)
- bd1e172d [FEATURE] Add container support (#1035)
- 35fd14b1 [FEATURE] Add tca defaults for imagecol
- ef50a0cb [FEATURE] Make theme colors selectable for carousel items (#1032)
- 1801887d [FEATURE] Extend RTE config for links and lists (#1031)
- dde661e1 [FEATURE] Extend color palette (#1030)
- 5207c194 [FEATURE] Add new DropIns to page before and after
- 8323a17b [!!!][FEATURE] Introduce embedded frames and improve rendering
- 3a809980 [FEATURE] Set font display to swap by default
- cd08510a [FEATURE] Add gallery content block (#765)
- 561c9298 [FEATURE] Add header position for carousel items

## TASK

- 317595f4 [TASK] Raise version constraints to support released v11
- b65e3044 [TASK] Remove workaround for v11 (#1036)
- 2ff1b43a [TASK] Upgrade bootstrap to 5.1
- 74ba9040 [TASK] Streamline bp icons
- f6d8de81 [TASK] Reduce default size of gallery-gap
- 86b596d0 [TASK] Use fantasticon to build icon font (#1028)
- 0c6d842f [TASK] Allow REVERT key word in commit messages (#1026)
- 8c63fd58 [!!!][TASK] Add support for Bootstrap v5 (#1016)
- 5188f94f [TASK] Upgrade bundled and minimum required version of scssphp/scssphp to ^1.6.0
- 04efddec [TASK] Remove all showRemovedLocalizationRecords occurrences (#1019)
- f31359d3 [TASK] Use SiteConfiguration for website title
- 357bc410 [TASK] Remove obsolete hammer.js polyfill for swipe gestures on carousel
- 49af9a0f [TASK] Reduce jquery usage on navbar
- 52c99601 [TASK] Remove jquery from lightbox (#1014)
- 4560df58 [TASK] Drop yarn as dependency manager (#1013)
- 48d98cc5 [TASK] Remove jquery from form custom file input
- f5657558 [!!!][TASK] Replace fluid pagination widget (#1012)
- e4c07088 [!!!][TASK] Drop webfontloader (#1011)
- 203668a9 [TASK] Drop feedit
- ae3aced3 [TASK] Disable deployment and publish workflows for forks (#1010)
- fdeaf209 [TASK] Don´t continue on PHPStan errors
- 34a9680b [!!!][TASK] Replace deprecated lastImageInfo access (#1005)
- 4ccae72b [TASK] PHPStan clean ups (#1004)
- 48ae9da1 [TASK] Allow tests to pass for phpstan and build result for now (#1003)
- 1f753fb2 [TASK] Add phpstan
- 966b8f9d [TASK] Update scssphp/scssphp
- b442b35b [TASK] Update phplint
- 247cddab [TASK] Update php-cs-fixer
- 3df72439 [TASK] Upgrade frontend dependencies
- 36f60ba0 [TASK] Setup mysql server in docker container
- d2bfa0a9 [TASK] Update ddev config
- 31b8a64f [TASK] Upgrade dependencies
- 511db515 [TASK] Upgrade ddev config
- 76cec4ec [TASK] Remove yarn ddev wrapper
- f1c86d8f [TASK] Add extension-key to demo package
- f4f6ad21 [TASK] Enable deployment again (#985)
- c703ad7b [TASK] Replace TYPO3_MODE and TYPO3_REQUESTTYPE (#984)
- 3f8e38a6 [TASK] Migrate signals to PSR-14 events (#983)
- b0e10f5e [TASK] Update branch-alias and package sorting (#982)
- dbabe541 [TASK] Remove TYPO3 9 from CI (#981)
- 82b21786 [!!!][TASK] Remove TYPO3 9.5 support (#979)
- c0ba1c96 [!!!][TASK] Remove InstallService (#977)
- 35fdfd78 [!!!][TASK] Remove bootstrap3 (#826)
- 6d4fd9dd [TASK] Allow installation with testing framework ^6.4
- db0ad783 [TASK] Update bundled scssphp to 1.4.1
- db8fc926 [TASK] Let all actions run
- c2da8dcf [TASK] Remove travis and scrutinizer from readme
- a38ad36c [TASK] drop scrutinizer
- f9201716 [TASK] Drop travis ci
- 4c546808 [TASK] Update actions
- ab622fe4 [TASK] Update dependencies
- ed1f28e9 [TASK] Remove tempfs for dev environment
- f77265bb [TASK] Add publishing TER workflow
- 77488690 [TASK] Allow installation on TYPO3 v11 for development purposes
- d5e9632b [TASK] Update DDEV configuration (#962)
- 8a1beef2 [TASK] WSL2 support (#961)
- 209753a8 [TASK] Reintroduce prefer-stable (#960)
- 34fc1bd9 [TASK] Bump labeler to v3 and enable sync-labels (#952)
- f7b08da6 [TASK] Update Pull Request template (#950)
- 26d5ae30 [TASK] Update pull request types for Check PR workflow (#949)
- 240e2dfb [TASK] Replace GeneralUtility::getUrl by RequestFactory (#910)
- c2b2918b [TASK] Migrate to afterExtensionInstall signal (#909)
- d5af9cfd [TASK] Update README.rst (#900)
- 000bc1bc [TASK] Add workspaces as dev dependency
- bf94f47b [TASK] Bump actions/checkout to v2
- f13a42dd [TASK] Move path repository for testing to Tests (#882)
- 4527808a [TASK] Downgrade to labeler v2 (#881)
- 85b0dcae [TASK] Use v3-preview labeler (#880)
- c3dfcf41 [TASK] Add functional test setup (#879)
- 4651154e [TASK] Add typo3fluid/fluid to composer dependencies (#876)
- ecdb0252 [TASK] Update frontend build dependencies
- 9175ab4a [TASK] Update ddev to 1.14.0
- becff742 [TASK] Add missing extension key (#874)
- aca79603 [TASK] Bump DDEV to 1.13.1 (#863)
- 47b2a3da [TASK] Add PHP 7.4 to workflow (#855)
- 477c7c4e [TASK] Ignore false positives in extension scanner (#854)
- 051f3f0c [TASK] Update DDEV to 1.13.0 (#853)
- 2deb9684 [TASK] Slim down documentation configuration
- b5a591b2 [TASK] Remove path in ExtensionConfiguration::set call (#836)
- 7f5ffb1f [TASK] Update bootstrap 4.1 constants (#831)
- 8dc2ab29 [TASK] Remove scssphp/scssphp conflict (#832)
- 5e2881c2 [TASK] Add check commit message workflow for pull requests (#828)
- 6f30d904 [TASK] Add Github workflow badge (#824)
- 255407cb [TASK] Update bootstrap.stickyheader.min.js (#823)
- c0a3d485 [TASK] Rename DDEV build command to yarn (#821)
- f41102e0 [TASK] Bump modernizr to version 3.8.0  (#820)
- 689784dc [TASK] Bump grunt-stylelint to version 0.11.1 (#819)
- 41475573 [TASK] Bump grunt-sass to version 3.1.0  (#818)
- 8bce4872 [TASK] Bump bootstrap 4 to version 4.4.1 (#817)
- 861b43bc [TASK] Bump popperjs to version 1.16.0 (#816)
- be48491d [TASK] Add lowlevel module as dev dependency for debugging (#810)
- be12760a [TASK] Configure markdown lint (#811)
- 2473a78e [TASK] Add info module as dev dependency for debugging (#809)
- 00f77921 [TASK] Update labeler to version 2.1.0 (#812)
- 2d49db12 [TASK] Introduce DDEV build script (#808)
- 69843d4f [TASK] Update ddev to 1.12.0 (#783)
- b18d7755 [TASK] Change build order (#793)
- 76061f01 [TASK] Automatic label dependency changes (#796)
- d863cc7d [TASK] Remove deprecated translateToHidden option (#800)
- b9b6ba3c [TASK] Update issue and pull request templates (#795)
- 9d444b13 [TASK] Remove double inclusion of content elements (#792)
- 71c4da3f [TASK] Update build dependencies (#790)
- c6c7ea69 [TASK] Add DDEV custom command description (#782)
- 8d9143e4 [TASK] Fix typo in image variants view helper (#769)
- d8799321 [TASK] Update bundled scssphp/scssphp version to 1.0.4
- d9a9ac48 [TASK] Add width, height and intrinsicsize to images
- 770fc438 [TASK] Remove update build script
- 88ca8d91 [TASK] Extend CI to 10.x and master (#755)
- 7114b00f [TASK] Make typo3/cms-* requirements less strict
- 6e8ddee7 [TASK] Update ddev to 1.11.1
- 87222fc7 [TASK] Use github actions for ci (#741)
- 2a294542 [TASK] Disable xdebug by default for dev environment
- 5a82470b [TASK] Update ddev to 1.10.2
- 2847fd3e [TASK] Streamline database field types
- ac916e7b [TASK] Enable tmpfs for dev environment

## BUGFIX

- 0398bebb [BUGFIX] Add space between gallery and navigaiton
- de2c69c2 [BUGFIX] Update doctrine usages (#1037)
- 8c4e4cab [BUGFIX] Correct image calculation
- 34fb30af [BUGFIX] Streamline card paddings
- a6aa8244 [BUGFIX] Ignore phpstan error for dom_import_simplexml (#1033)
- f3959528 [BUGFIX] Update icon css (#1034)
- 0ecbeb8c [BUGFIX] Ensure correct correct scaling of special links
- df42070f [BUGFIX] Remove obsolete margin from gallery
- 4c514238 [BUGFIX] SassError: compound selectors may no longer be extended. #1023 (#1029)
- 18af0848 [REVERT][BUGFIX] SassError: compound selectors may no longer be extended. Consider `@extend .form-control, .is-invalid` instead. https://sass-lang.com/documentation/breaking-changes/extend-compound (#1023) (#1025)
- 834a1576 [BUGFIX] Remove wrong !default from monospace (#1024)
- d8350fef [BUGFIX] SassError: compound selectors may no longer be extended. Consider `@extend .form-control, .is-invalid` instead. https://sass-lang.com/documentation/breaking-changes/extend-compound (#1023)
- fcbcbe5e [BUGFIX] Workaround core issue #94422 in ci (#1020)
- b14e4adf [BUGFIX] Migrate phpunit functional test configuration
- 7174037b [BUGFIX] Correct default image height calculation
- 28446c5a [BUGFIX] Correct frame collapsing for no backgrounds
- 7b522d97 [BUGFIX] Restore grouping in ctype selector
- 238f48e0 [BUGFIX] Only call getIcons if value is not null
- bd81170d [BUGFIX] Correct label for processing css files
- b5107f2a [BUGFIX] Adapt to changes in fluid contexts between v10 and v11
- abc20109 [BUGFIX] Add missing spacers for frames aagain
- b73c95c1 [BUGFIX] Minor fixes to frame layout
- 78a2bd94 [BUGFIX] Revert unintended revert of TYPO3 constant (#1008)
- 34ef3de5 [BUGFIX] Respect gallery size settings instead of beeing smart
- e4623ce3 [BUGFIX] Correct extension manager dependencies to match composer requirements
- 1a951398 [BUGFIX] Update form definition (#980)
- 1238613b [BUGFIX] Apply latest scssphp changes to import behavior (#948)
- 4543ad16 [BUGFIX] Remove minimum stability dev from composer.json (#936)
- 1c590d82 Revert "[BUGFIX] Use image vh for image types to enable thumbnails for non images like PDF files (#913)" (#914)
- 826f6beb [BUGFIX] Use image vh for image types to enable thumbnails for non images like PDF files (#913)
- d5af3aac [BUGFIX] Introduce table-condensed class again for compatibility (#908)
- 6c1e3da1 [BUGFIX] Missing body class for current language (#906)
- 41879dba [BUGFIX] Fix paths in url() statements (#868)
- 063af998 [BUGFIX] Do not force a specific RTE configuration for content elements
- b5c83cfc [BUGFIX] Change controllerActionName in extbase configuration of gallery (#890)
- 6cded416 [BUGFIX] Adapt server ip address for deployment
- 245c8f89 [BUGFIX] Correct path to temp directory in compile service (#884)
- 1e4d71ed [BUGFIX] Resolve SCSS files correctly when using symlinked paths (#866)
- cb712010 [BUGFIX] Correct test location
- 6b3237af [BUGFIX] Add missing extension dependencies (#871)
- 5b40d7ab [BUGFIX] Add missing filter extension dependency (#870)
- 50f45603 [BUGFIX] Change TCA escaping for database compatibility (#865)
- b9124c3b [BUGFIX] Ensure correct field casing and escaping in TCA for database compatibility (#862)
- b9ac3bb0 [BUGFIX] Update dependencies and rebuild assets
- 453f56e1 [BUGFIX] Add compiled css
- 5da26ce3 [BUGFIX] Restrict fixed menu overflows to mobile resolutions - fixes #837
- 7d6597ab [BUGFIX] Hide link text for carousel bg image
- 631161b7 [BUGFIX] Ensure elements exist before accessing
- ed586c88 [BUGFIX] Conflict scssphp/scssphp 1.0.4 and 1.0.5 for composer installs (#764)
- 9c26f626 [BUGFIX] Escape special chars in bootstrap.smoothscroll.js (#786)
- da4d4436 [BUGFIX] Use correct category for texticon constants (#781)
- 4c0bff4d [BUGFIX] Resolve plain bootstrap 4 accordion conflicts (#775)
- 4850c2db [BUGFIX] Ensure frame collapsing for node-sass compilations on theme
- b00bda82 [BUGFIX] Add missing compiled and minified assets for for gallery
- 124b4fad [BUGFIX] Include autoloader for parser class check (#776)
- db2c2487 [BUGFIX] Correct pseudo controller for pagination
- b448c076 [BUGFIX] Force node version during build (#771)
- cc8d51fe [BUGFIX] Disable RTE for carousel type html - fixes #770
- 740d9fe2 [BUGFIX] Correct feature flag evaluation
- 50110eee [BUGFIX] Respect sorting in section menus
- 94a14e8b [BUGFIX] Set default header position for carousel items
- bbe6f235 [BUGFIX] Add check for cached file in GoogleFont Service again
- 2ace8816 [BUGFIX] Switch GoogleFont Cache to woff for broader support - fixes #751
- b4e04b0c [BUGFIX] Keep viewbox attribute for photoswipe skin
- a4b9e1bb [BUGFIX] Restore missing viewBox attribute for glyphicon icons
- 089ff319 [BUGFIX] Use correct constant for texticon width (#736)
- a4e0276f [BUGFIX] Remove invalid date default value for timeline item
- 42386ff2 [BUGFIX] Ensure timeline item can be translated
- 96aaa454 [BUGFIX] Remove default alignment of carousel header item
- ab6a7d74 [BUGFIX] Correct wrapping for icongroup with less

## MISC

- 3c501e44 [DOCS] Fix some typos (#1001)
- bd79929d [DOCS] Fix bullet lists (#1000)
- bc68d846 [DOCS] Fix typo (#998)
- 6d0a6581 [DOCS] Add render-docs helpers (#901)
- 4bca8502 [DOCS] Fix code blocks (#825)
- 279c9761 [DOCS] Add documentation hints to README (#802)
- 016bf027 Fix Header on PageLoad if scrolled (#784)
- 2058d12a [DOCS] Add Image Rendering (#767)
- cde513ac [DOCS] Fix duplicated label (#772)
- fae0ae81 [REVERT] "Update _texticon.scss"
- 8015f856 Update _texticon.scss

## Contributors

- Andrea Moroni
- Andreas Fernandez
- Benjamin Kott
- Daniel Haupt
- David Zach
- Franz Holzinger
- Gilbertsoft
- Helmut Hummel
- MartinH0
- Nikita Hovratov
- Oliver Hader
- Son Tung Ngo
- Tomas Norre Mikkelsen
- jonaseberle

# 11.0.0

## BREAKING

- 1dc73ff4 [!!!][TASK] Drop seo related meta tag settings
- b47e8480 [!!!][TASK] Section Menu hides single page header and empty entries (#707)
- e4a6434d [!!!][FEATURE] Make timeline more flexible
- 0f449765 [!!!][FEATURE] Enable time settings for timeline
- 207de1cf [!!!][TASK] Drop jquery dependency from cookie consent wrapper
- a18c46d4 [!!!][TASK] Drop data relation viewhelper
- d3fcd7d3 [!!!][TASK] Remove fallback for extension configuration
- 6989ed65 [!!!][TASK] Drop automatic language menu polyfill

## FEATURE

- 2a7e5299 [FEATURE] Introduce text carousel item
- 3049b345 [FEATURE] Enable rich text editor for call to action carousel item
- 76d883a4 [FEATURE] Make media renderer options configurable
- 04225dc1 [FEATURE] Make header display date format configurable
- d05ca34f [FEATURE] Add make icon position in icongroup configurable
- 77549d30 [FEATURE] Allow processing of configured file types (#709)
- e4a6434d [!!!][FEATURE] Make timeline more flexible
- 57c71ddc [FEATURE] Make icon spacing configurable in timeline
- 0039dc64 [FEATURE] Add variables to configure timeline headline and date size
- 0f449765 [!!!][FEATURE] Enable time settings for timeline
- b8f7d912 [FEATURE] Add support for highres images (#678)
- 13f70718 [FEATURE] Support class attribute in inline svg viewhelper
- eb1508d1 [FEATURE] Add rss social media icon - fixes #629
- 9fcf8dec [FEATURE] Add vk social media icon - fixes #651
- 159dda4d [FEATURE] Allow content slide configuration for all layouts and colPos
- f7672c3c [FEATURE] Make icongroup more usable by allowing to change visual behaviour
- a530ee95 [FEATURE] Enable links in icon group
- 4a128363 [FEATURE] Collapsible in accordion should scroll to the top of its contents (#589)

## TASK

- ff143de6 [TASK] Add linter configuration for less files
- 1dc73ff4 [!!!][TASK] Drop seo related meta tag settings
- a7da4e2f [TASK] Remove obsolete useCacheHash option for pagebrowser
- 14b7e8da [TASK] Add stylelint for scss linting (#711)
- ab93487c [TASK] Mark TYPO3 v10.0.0 as compatible
- 7fb656dc [TASK] Add dependency to scssphp/scssphp and update bundled code
- e7a0b2bc [TASK] Configure app-dir
- 4d196f02 [TASK] Set loading attribute to lazy for images
- 6c69d817 [TASK] Optimize cardgroup and menus
- 1a51d24e [TASK] Bump stringstream from 0.0.5 to 0.0.6 (#713)
- d786efcc [TASK] Bump lodash.mergewith from 4.6.1 to 4.6.2 (#730)
- 41dc8da7 [TASK] Add FUNDING.yml
- 48b881ae [TASK] Bumb bootstrap3 to 3.4.1
- cefce3a3 [TASK] Bumb popperjs to 1.15.0
- eb3ce179 [TASK] Update slack register link (#722)
- e1ec2e40 [TASK] Bumb cookieconsent to 3.1.1
- 8b073ba2 [TASK] Bumb jQuery to 3.4.1
- f84b1a3d [TASK] Update ddev to 1.9.1
- b47e8480 [!!!][TASK] Section Menu hides single page header and empty entries (#707)
- 08a4487f [TASK] Update ddev to 1.8.0
- 5c4ed238 [TASK] Bump tar from 2.2.1 to 2.2.2 (#694)
- c063b54e [TASK] Bump fstream from 1.0.11 to 1.0.12 (#700)
- 97d9da82 [TASK] Bump sshpk from 1.13.1 to 1.16.1 (#702)
- 1b81159b [TASK] Update ddev to 1.7.1
- aa76461f [TASK] Disable deploy stage on forks
- 292a489b [TASK] Extract cookie consent from main setup and constants
- f4f6815f [TASK] Add watch task to package.json
- 207de1cf [!!!][TASK] Drop jquery dependency from cookie consent wrapper
- 5c881c96 [TASK] Use file objects for logo
- 386ca145 [TASK] Cleanup svg viewhelper
- e632786c [TASK] Add cgl command to composer.json
- e46a2ba2 [TASK] Change build order
- 75941808 [TASK] Optimize all SVGs
- d252cb09 [TASK] Update build dependencies
- df9f64f2 [TASK] Remove unused image lazyload css
- 8c0b16d7 [TASK] Expose grunt build tasks to yarn
- 625902bf [TASK] Remove changelog from documentation and refer to release notes on github
- 9fe82881 [TASK] Use bk2k/extension-helper for release support
- 991f2d40 [TASK] Enable xdebug for development setup
- a8f15484 [TASK] Require seo extension
- 0e4f4438 [TASK] Update modernizr to 3.7.0
- 292ef67a [TASK] Update photoswipe to 4.1.3
- 7ab26105 [TASK] Require supported core extensions in development mode
- 849b941b [TASK] Update to bootstrap 4.3.1
- 15957604 [TASK] Update scssphp and use fork to apply patches.
- c1f4cb89 [TASK] Ensure scss and lf files are checked out with lf
- c382b4fe [TASK] Add ddev development configuration
- fbc40d09 [TASK] Strip pagets_ from pagelayout variable and set default if empty
- 95a30c73 [TASK] Remove typolinkEnableLinksAcrossDomains since its obsolete with siteconfiguration
- 14115584 [TASK] Enable css und js compression by default
- c1a5d22f [TASK] Remove obsolete realurl setting
- a18c46d4 [!!!][TASK] Drop data relation viewhelper
- f980445e [TASK] Cleanup extension configuration
- 3267945d [TASK] Include seo extension by default if installed
- fd28722d [TASK] Use symfony expression language for typoscript conditions
- 962a84c6 [TASK] Remove legacy config settings from documentation
- a788f76a [TASK] Remove deprecated TCA options - fixes #543
- 68d7bb12 [TASK] Use UpgradeWizardInterface in upgrade wizards
- b33103f2 [TASK] Drop usage of PATH_site
- d3fcd7d3 [!!!][TASK] Remove fallback for extension configuration
- 6989ed65 [!!!][TASK] Drop automatic language menu polyfill
- 6c8395e5 [TASK] Adjust to use Core's FlexFormService directly
- 9ea0cb13 [TASK] Adjust to use Fluid's AbstractViewHelper directly
- ba8dbc33 [TASK] Adjust for removed code in TemplateService
- 9f55be45 [TASK] Remove PHP 7.3 from travis until php-cs-fixer is compatible
- 9abfd3b5 [TASK] Update travis configuration
- 6ee8af67 [TASK] Adjust version constraints for TYPO3 v10
- 94b5e1be [TASK] Add config directory to demo site deployment
- ac6541ab [TASK] Update bootstrap to 4.2.1 - fixes #627
- e50ea553 [TASK] Add vscode to gitignore
- 3ed67ceb [TASK] Update npm dependencies
- 030e972d [TASK] Update Bootstrap 3.x to 3.4.0
- 270616e7 [TASK] Update leafo/scssphp to v0.7.7 - fixes #612
- 17072560 [TASK] Name hooks and always register them, regardless of context
- b3bfa57a [TASK] Add option to disable the web font loader
- a9890dca [TASK] Mention site introduction repository in readme
- 88492bc5 [TASK] Cleanup issue templates
- 6983c7aa [TASK] Update issue template (#599)
- 93731a7c [TASK] Include TYPO3 v9.5 in pull request template
- 579da24b [TASK] Include TYPO3 v9.5 in issue template
- 078950ef [TASK] Add minimum scale to viewport configuration
- f69e9644 [TASK] Use ip instead of url for deployment travis ssh known hosts
- 67ab683d [TASK] Remove install notification for unsupported webservers - fixes #562
- 7f0ba945 [TASK] Add forgotten textpic and textmedia alignment

## BUGFIX

- bcf69eb5 [BUGFIX] Make UpgradeWizards repeatable (#720)
- f348098c [BUGFIX] Add missing aria-label translations for breadcrumb and nav toggle
- 76e8add0 [BUGFIX] Add missing space correction for icongroup in scss
- c37061e1 [BUGFIX] Correct false typoscript default for 'custom-select-indicator' (#724)
- ba633faf [BUGFIX] Avoid spooky random fluid compilation errors
- 867b2927 [BUGFIX] Avoid card-header link color inheritance
- c9d4862f [BUGFIX] Remove travis deploy stage for pull requests (#710)
- 538d3a7d [BUGFIX] Add remove obsolete comma
- 0fffbbd1 [BUGFIX] Add missing default parameter for icongroup
- d0efeeb0 [BUGFIX] Add fontloader css and js only to header if content exists - fixes #703
- 24da8939 [BUGFIX] Make cookieconsent variables overwriteable - fixes #704
- 9280a6df [BUGFIX] Add missing description field to timeline images
- eaf0c40f [BUGFIX] Correct icon placement in navbar
- 201969b7 [BUGFIX] Correct variable spelling error and set variables of timeline to default
- 961ebcc6 [BUGFIX] Use full datetime format for timeline items
- e4b9f5ba [BUGFIX] $_EXTKEY is not available anymore in v10
- 7f2225c9 [BUGFIX] Respect target option for title link in card-group
- 132a5d32 [BUGFIX] Respect target option for links in card-group
- 95d45cf5 [BUGFIX] Restore IE11 compatibility for cookie consent
- 82e8fd19 [BUGFIX] Prevent collapsing of frames - fixes #618
- 571dbf88 [BUGFIX] Add missing crop variants to carousel image - fixes #665
- 55a6eb9d [BUGFIX] Disable rendering of footer-section-meta if all containing elements are disabled - fixes #657
- 716f8074 [BUGFIX] Remove obsolete/invalid replacements in composer.json
- 0f4a2633 [BUGFIX] Correct comment formatting
- 24e38e18 [BUGFIX] Use lf instead of crlf in tab svg
- 25af394a [BUGFIX] htaccess does not allow pages that end with "rc" - fixes #652
- 26b2fa91 [BUGFIX] Use error object in form field template (#641)
- 15b6626a [BUGFIX] Ensure type safety for ViewHelper calling ImageService (#640)
- 409ddd4d [BUGFIX] Ensure type safety for ViewHelper calling ImageService (#639)
- ab754c69 [BUGFIX] Render data-interval only on carousel if value exists
- bd8169c5 [BUGFIX] Do not process svg file if it does not contain content
- fcd180a0 [BUGFIX] Add table context to typoscriptObjectPath for tt_content rendering
- e04fd7c7 [BUGFIX] ce uploads accepts sorting direction (#630)
- a459c577 [BUGFIX] Correct spelling error in install service
- 39f19fcb [BUGFIX] Remove empty line to match cgl
- de164cea [BUGFIX] Enable basic tests again (#628)
- 10295654 [BUGFIX] Correct dependencies in composer.json
- 2bd79cdd [BUGFIX] Show caption in lightbox when title is empty - fixes #626
- ed1c0fb0 [BUGFIX] Minimize word breaks in figure captions (#621)
- 9b7c43f0 [BUGFIX] Typo: 'boostrap' should be 'bootstrap' (#625)
- 1cf21edc [BUGFIX] Do not overwrite button stylings in footer sections
- 4e532573 [BUGFIX] Make Less Parser PHP 7.3 compatible (#617)
- e912374b [BUGFIX] Ensure parallax effect works across all desktop browsers - fixes #610
- 8f8c0c80 [BUGFIX] Keep page accessible on early javascript errors
- 021a9a5f [BUGFIX] Catch exception in TYPO3 8.7 backend on database configuration missmatch
- a2d31480 [BUGFIX] Minor fixes to wording - fixes #606
- 465f5e1e [BUGFIX] Avoid update problems and always include sql adjustments for sys_language
- bb7f3a8d [BUGFIX] Move parsefunc and dynamic content to content rendering definition
- 6cf28f73 [BUGFIX] Use typolink instead of page viewhelper for wizard fields
- dcbc912b [BUGFIX] Do not use rem in bootstrap 3 context - part 2
- 4ebffc55 [BUGFIX] Do not use rem in bootstrap 3 context
- f21b759b [BUGFIX] Make standalone element configuration availabe as rendering template
- 91a1b681 [BUGFIX] Remove obsolete unsetting of the list content element for plugins
- 4c9fd781 [BUGFIX] Correct path in comment to bootstrap resource files - fixes #590
- c0ed7e59 [BUGFIX] Respect title configuration in menu card and menu thumbnail elements - fixes #591
- 1325f3e1 [BUGFIX] Streamline file property access to also lead sys_file data - #578
- 535596db [BUGFIX] Add fallback handling for unsupported pointer events in safari - #571
- 6ed0e904 [BUGFIX] Correct styling of accordion - fixes #579
- a301039c [BUGFIX] Ensure element browser links working in carousel - fixes #575
- f0df62c3 [BUGFIX] Adjust comment in ext_tables.php
- 166a63d1 [BUGFIX] Fix typo in comment  (#580)
- 4837b063 [BUGFIX] Ensure photoswipe scss vars can be adjusted
- ced0fd77 [BUGFIX] Adapt navigation documentation for TypoScript changes since v9 (#567)
- 72427d02 [BUGFIX] Correct placement of main navigation dropdowns on small viewports - fixes #561, #565
- 2d6754fc [BUGFIX] Respect overrides for enable-rounded scss variable - #558
- 6c8a631a [BUGFIX] Correct TCA for carousel small (#557)
- d378b0ab [BUGFIX] use correct default value for texticon icon type (#559)
- 4d23a561 [BUGFIX] Correct link color bubbling for sections in bootstrap 4
- 8ab40f07 [BUGFIX] Prevent color bubbling for cards
- ee8a02b3 [BUGFIX] Correct primary label in bs4 typoscript constants (#554)

## MISC

- 63029706 Update issue templates

## Contributors

- Anja
- Benjamin Kott
- Charles Coleman
- Christian Kuhn
- Dennis Metz
- Gilbertsoft
- Jacob Dreesen
- Oliver Hader
- Patrick Lenk
- Ralf Merz
- Seb Red
- Stephan Großberndt
- Susi
- Sven Burkert
- cristianbuja
- dependabot[bot]
- dependabot[bot]
- eckard gehrke
- florian-nolte
- jazzica
- jokumer
- wow-solution

# 10.0.0

## BREAKING

- 6dee2d12 [!!!][FEATURE] Use bootstrap 4 the default frontend framework
- 3f837892 [!!!][TASK] Use dedicated thumbnail field for card menu thumbnails
- c3ad7208 [!!!][TASK] Drop signal to modify less settings
- 5331a4c9 [!!!][FEATURE] Provide new design for thumbnail menu content element
- ea583f11 [!!!][TASK] Use dedicated thumbnail field for thumbnail menu content element
- c9e9a12f [!!!][FEATURE] Allow multiple icon sources for text and icon - fixes #504
- c49ff60f [!!!][TASK] Ensure classes and ids on template areas are unique
- 14584e13 [!!!][TASK] Use .form.yaml instead of .yaml
- a8381110 [!!!][TASK] Add google webfont support for bs4 and add option to disable them
- 2a69a265 [!!!][TASK] Move navigation constants to dedicated namespace
- 67a16bfb [!!!][TASK] Enable css und js concatenation by default
- 0d35fdcb [!!!][FEATURE] Improve responsive image rendering (#517)
- 7adb559a [!!!][TASK] Move footer column rendering to page templates
- 0a67f114 [!!!][TASK] Drop clean backendlayout in favor of simple
- 8b36dea0 [!!!][TASK] Move border column rendering to new section above breadcrumb
- 92ad8d7c [!!!][TASK] Migrate frame classes well and jumbotron to background color classes
- 0603d551 [!!!][TASK] Make mainnavigation compatible with bs3 and bs4
- 6495106d [!!!][TASK] Use theme constants instead of settings
- 367bce19 [!!!][TASK] Drop show footer option

## FEATURE

- 6dee2d12 [!!!][FEATURE] Use bootstrap 4 the default frontend framework
- 72e7d85a [FEATURE] Enable responsive images for carousel item text and image - #552
- 73610170 [FEATURE] Enable responsive images for carousel item image - #552
- bca28395 [FEATURE] Enable responsive images for carousel backgrounds - #552
- 01c43298 [FEATURE] Enable responsive images for content element background images - #552
- 13ce83b6 [FEATURE] Enable responsive images for timeline - #552
- a477eab3 [FEATURE] Enable responsive images for card menu
- d4a8579f [FEATURE] Make columns and alignment of card menu configurable
- 76306b15 [FEATURE] Enable responsive images for tab items
- e2c66719 [FEATURE] Enable crop variants for tab items
- ec36d86d [FEATURE] Enable columns and image zoom for tab items
- 00bb80da [FEATURE] Allow multiple assets rendered in tab item
- bf3712aa [FEATURE] Add additional media positions to tab content element
- 26d4df87 [FEATURE] Enable crop variants for carousel items
- 269cf956 [FEATURE] Enable responsive images for accordion items #552
- 0dcfc49d [FEATURE] Enable columns and image zoom for accordion items
- 2f068bfb [FEATURE] Allow multiple assets rendered in accordion item
- 2b516cbd [FEATURE] Enable more image positions for accordion content element
- 5b2a6e52 [FEATURE] Add gutter support for image variants utility
- 5331a4c9 [!!!][FEATURE] Provide new design for thumbnail menu content element
- 66bb5d91 [FEATURE] Add dedicated thumbnail fied to pages
- 7dad8771 [FEATURE] Add card group content element
- b56137c6 [FEATURE] Add trim viewhelper
- c9e9a12f [!!!][FEATURE] Allow multiple icon sources for text and icon - fixes #504
- 1b00a01e [FEATURE] Add more content positions to existing layouts
- 0cf36666 [FEATURE] Add static file processor
- 2f322aec [FEATURE] Add DropIn locations to page footer
- b43d641f [FEATURE] Make frame inner and outer spacing configurable
- f089fcac [FEATURE] Add secondary colors and introduce outline buttons
- 1eb026fd [FEATURE] Add folder support for textpic content element
- 394cfce7 [FEATURE] Add text indention plugin to ckeditor
- 426fb781 [FEATURE] Add options to disable icon rendering in main and subnavigation
- 1a85bb06 [FEATURE] Add optional nav icon rendering to card menu
- 57b7af70 [FEATURE] Add css columns to ckeditor - fixes #386 #387
- f5c34ea2 [FEATURE] Add background image effects to content elements and carousel
- 6bd31e52 [FEATURE] Add src support for inline svg viewhelper
- 043e18c1 [FEATURE] Add content element to render csv files
- 42ac9416 [FEATURE] Add navigation icon support in dropdown
- 0d35fdcb [!!!][FEATURE] Improve responsive image rendering (#517)
- 873cfd19 [FEATURE] Add automatic local google font cache (#522)
- f5d2b862 [FEATURE] Add typoscript condition to check typo3 core version
- c00e337b [FEATURE] Add popup close and open events to cookieconsent - fixes (#526)
- 4c0eb29b [FEATURE] Add support for folders in image and media element
- 5333b3bb [FEATURE] Add data processor to filter files by extension
- 5acd6904 [FEATURE] Make lightbox max image dimensions configurable
- cf9df4d1 [FEATURE] Automatic language menus and configuration for TYPO3 8.7 and >= 9.3 (#511)
- 9d72dbde [FEATURE] Add placeholder for google analytics opt-out / opt-in
- 408d9aef [FEATURE] Introduce template blocks
- fcebc2ac [FEATURE] Add cookieconsent
- b4780c2d [FEATURE] Add additional header and subheader classes for carousel items
- 49566185 [FEATURE] Make timeline sorting direction adjustable
- b211afc1 [FEATURE] Add timeline content element
- 6a59f738 [FEATURE] Add drop-in support for main navigation
- c9d9b25f [FEATURE] Add border column to all simple layouts - fixes #235
- bd4ef154 [FEATURE] Allow navigation icons in breadcrumb
- b26225c9 [FEATURE] Add call to action carousel item
- eb0b5ddc [FEATURE] Add ckeditor plugin to insert address
- a01e493d [FEATURE] Add social links content element
- 983f1692 [FEATURE] Add simple backendlayout without container
- 4ceaa7b1 [FEATURE] Provide form styling for bs3 and bs4 and add basic contact form
- f3cfc372 [FEATURE] Add typoscript constant viewhelper
- 03c1bde0 [FEATURE] Add lowercase dashed formatting viewhelper
- b673ffbb [FEATURE] Allow to set width and height to inline svgs
- 567ac5f6 [FEATURE] Add anchor classes to linkbrowser
- e1a612ff [FEATURE] Add icon group content element
- 44d2562b [FEATURE] Add viewhelper to render inline svgs
- b9425dde [FEATURE] Add card menu
- cb2d6cae [FEATURE] Add social media channels to page footer
- c5ce95f8 [FEATURE] Add processor to make typoscript constants available in templates
- 744d2066 [FEATURE] Add bootstrap 4 sources
- 50a88494 [FEATURE] Load webfonts via fontloader to avoid blocking rendering - fixes #491
- b725c3b9 [FEATURE] Enable scss and less processing for includeCSSLibs
- e0e487da [FEATURE] Introduce new parser for scss css files

## TASK

- c8e036f6 [TASK] Enable ckeditor autolink plugin per default
- 3871e4df [TASK] Add rel noopener to links in default copyright text
- 3a3699ee [TASK] Update webserver configs to mach typo3 v9 defaults
- b0b29c01 [TASK] Optimize modernizr footprint
- 6e9fcbfd [TASK] Update frontend build chain to latest versions
- 2cb81a65 [TASK] Update grunt-webfont to 1.7.2 and rebuild assets
- 2efd4f31 [TASK] Update popper.js to 1.14.4
- a6cf9707 [TASK] Update cookieconsent to 3.1.0
- 4b3c8fb4 [TASK] Optimize backgroundimages to avoid frame overflows
- 5a00518c [TASK] Add TypoScript variables for Bootstrap 4 (#500)
- 89239ace [TASK] Streamline database definition with TYPO3 v9
- 210ecacb [TASK] Use rel noopener for social links
- 11c38ed3 [TASK] Streamline placement of background image templates
- 3e189728 [TASK] Add tests for ExternalMediaUtility
- 3f837892 [!!!][TASK] Use dedicated thumbnail field for card menu thumbnails
- 24cb62c1 [TASK] Code cleanups
- 541e6aaf [TASK] Streamline less and scss caching
- c3ad7208 [!!!][TASK] Drop signal to modify less settings
- a3dbc22f [TASK] Prefer wording gutters over gutter to show that this are multiple
- 0260c4b4 [TASK] Optimize CSS compiler code and caches (#550)
- 4d19411a [TASK] Harden image variants utility
- c4281da8 [TASK] Add first unit tests for image variants utility
- 2066dd13 [TASK] Optimize responsive image rendering of thumbnail menu
- ea583f11 [!!!][TASK] Use dedicated thumbnail field for thumbnail menu content element
- 31271643 [TASK] Improve config scoping of textpic and textmedia responsive image settings
- 892055b8 [TASK] Streamline card link classes with rte buttons
- d75bbcaf [TASK] Remove misleading doccomments in viewhelpers
- 3cf162e0 [TASK] Slightly improve gallery image handling
- c9abe8ec [TASK] Simplify Icon Group handling
- 4a6b07e5 [TASK] Cleanup install service
- 21d424bf [TASK] Make list-inline compatible
- fd09a19c [TASK] Use typo3 v9 minimal distribution for scrutinizer
- c9d1507f [TASK] Correct CGL
- ace965d5 [TASK] Add svgo config
- f1624c9a [TASK] Cleanup glyphicons and ensure all icons are correctly rendered
- 4c1b1c37 [TASK] Cleanup ionicons and ensure all icons are correctly rendered
- 6a306ddc [TASK] Add fill currentColor to all svg icons
- 3ccac18e [TASK] Optimize svg images
- c20e6285 [TASK] Use svgs as backend icons for ionicons
- 7b62c2c1 [TASK] Use svgs as backend icons for glyphicons
- 1c4ce066 [TASK] Migrate text and icon types to string classes
- 1d24a7b6 [TASK] Migrate text and icon sizes to string classes
- 099e4597 [TASK] Migrate textteaser
- 4b225eac [TASK] Prefix region classes to avoid conflics with bootstrap 3
- c49ff60f [!!!][TASK] Ensure classes and ids on template areas are unique
- 1c9acdb1 [TASK] Add missing html tags to page layout
- 23bef5a1 [TASK] Make page footer more easy to identify
- 147a0170 [TASK] Streamline navbar fixed behaviour
- d8704eb8 [TASK] Enhance placement of carousel content for overlays
- d708838c [TASK] Add border column to simple layout
- 9708334b [TASK] Migrate well styling to bs4
- 44ec77c0 [TASK] Update bootstrap 4 to 4.1.3
- cacbfd67 [TASK] Use .tsconfig fileending and official structure for page tsconfig
- 67a7e7d7 [TASK] Seperate the configuration of content elements
- 679d40f5 [TASK] Change primary default color
- 672c495d [TASK] Make translations more easy and hide layout fields in irre records
- e59e818d [TASK] Add NetBeans IDE configuration to gitignore - fixes #539 (#540)
- 34960362 [TASK] Sort typoscript constants to make them more accessible
- d388cbc7 [TASK] Add sudo command again
- f0e058c3 [TASK] Use sudo for deployment stage
- cc7f1b42 [TASK] Split deploy scripts
- 14584e13 [!!!][TASK] Use .form.yaml instead of .yaml
- 3660b3a8 [TASK] Simplify icon registration
- c0b131fd [TASK] Optimize content element header spacing
- a8381110 [!!!][TASK] Add google webfont support for bs4 and add option to disable them
- 9801de64 [TASK] Make subnavigation compatible with bs 4 and 3
- 2a69a265 [!!!][TASK] Move navigation constants to dedicated namespace
- 44d55a70 [TASK] Remove copyright from custom js files
- 50face99 [TASK] Only keep minified contrib libs and remove sourcemaps
- 618aec9d [TASK] Update grunt-modules and recompile sources
- 9d88f30d [TASK] Update bootstrap to 4.1.1
- 6bf0e920 [TASK] Improve quality of PHP code (#534)
- 6572d347 [TASK] Use travis build stages - fixes #531 (#533)
- 68ba47cb [TASK] Add AdditionalConfiguration.php as shared file to deployment script
- 67a16bfb [!!!][TASK] Enable css und js concatenation by default
- ae0176df [TASK] Remove deployer configuration from scrutinizer analysis
- f2e0fd17 [TASK] Remove unused code in DataRelationViewHelper
- fb832331 [TASK] Use local webfontloader library
- 736a403d [TASK] Add php version and TYPO3 dev-master prerequisites to pull request template (#527)
- d33a2449 [TASK] Use youtube-nocookie url in external media utility
- c9579ed6 [TASK] Migrate headline styling scaling to bs4
- ee1504d3 [TASK] Streamline container width between bootstrap 3 and 4
- dab69c2c [TASK] Simplify image gallery column rendering
- c558c631 [TASK] Extract setup and constants for content elements
- 85e2edf8 [TASK] Drop obsolete constant
- 0b094476 [TASK] Add picture support for figures
- 94b98fc3 [TASK] Use local ratio labels for image croppings
- b19b234e [TASK] Remove unused $rootPage
- c6df2ccf [TASK] Trigger plain js cookie consent events
- 37d58a43 [TASK] Optimize typoscript constants for cookie consent
- eb322f14 [TASK] Update node dependencies
- 2e68b65f [TASK] Reduce webfont loader timeout to one second
- 3cc31760 [TASK] Remove role from carousel-inner
- 56eb6fdd [TASK] Mention bootstrap-package.com in default header comment
- 4eb0562e [TASK] Remove whitespace from header layouts
- 7f9ebc6b [TASK] Always anonymize ip if google analytics is used
- 10a00ca1 [TASK] Update bootstrap 4 branch to 4.1.0
- d47ba6d4 [TASK] Add date to timeline label
- e2538f36 [TASK] Make textpic and textmedia positions compatible with bs3 and bs4
- 86d80760 [TASK] Optimize space usage of frame indentions
- 160c5223 [TASK] Add additional stylings for file and mail links
- f438e726 [TASK] Add card menu styling for bs4
- 5a8036cf [TASK] Remove obsolete container wrappings for single columns
- 7adb559a [!!!][TASK] Move footer column rendering to page templates
- 0e44a772 [TASK] Add robots.txt symlink in deployment
- daa5e2c6 [TASK] Change default copyright text
- 0a67f114 [!!!][TASK] Drop clean backendlayout in favor of simple
- 8b36dea0 [!!!][TASK] Move border column rendering to new section above breadcrumb
- 6942d61a [TASK] Drop hardcoded template column sizes from templates - fixes #391
- 6527c8a1 [TASK] Migrate panel element to bs4
- 97343a06 [TASK] Add additional css classes to teaser elements
- ef345269 [TASK] Add additional css classes to footer columns
- e9568713 [TASK] Split footer sections into dedicated partials
- 973aa54f [TASK] Migrate frames and sections to bs4
- 80d7233b [TASK] Map button default to secondary in bs4
- 5bd887fc [TASK] Add migration wizard for frame classes
- 92ad8d7c [!!!][TASK] Migrate frame classes well and jumbotron to background color classes
- 6136dfc4 [TASK] Split sections in special feature template
- 4302fb9a [TASK] Migrate uploads to bs4
- db2591cf [TASK] Rename socialmedia icons to bootstrappackageicon
- b6dd3687 [TASK] Migrate quote to bs4
- 3796c740 [TASK] Migrate text in columns to bs4
- 6ef8f486 [TASK] Adjust default variables in bs4
- 2bb85568 [TASK] Adjust indentions of scss variables
- 0feccd00 [TASK] Migrate thumbnail menu to bs4
- 652775d1 [TASK] Update modernizr to 3.6.0 and add css/focuswithin test
- 99d001b5 [TASK] Add more meaningful defaults for contactform
- 47ccec07 [TASK] Move form configuration file
- ab7f64e3 [TASK] Disable obsolete share element in lightbox
- 52f3aabf [TASK] Migrate photoswipe lightbox to bs4
- 8bb2325e [TASK] Make gallery compatible with bs3 and bs4
- 9dfbca1a [TASK] Make accordion compatible with bs3 and bs4
- 0603d551 [!!!][TASK] Make mainnavigation compatible with bs3 and bs4
- dc75c4a9 [TASK] Move active bar styling of mainnavigation to pseudo element
- c969834b [TASK] Streamline behaviour of icongroup
- 7d949b24 [TASK] Finetune styling of icongroup content element
- 05d6a80e [TASK] Migrate navbar toggle to bs4
- 02714085 [TASK] Reduce timeout for font loading
- 7ce6b005 [TASK] Migrate texticon styling to bs4
- 6495106d [!!!][TASK] Use theme constants instead of settings
- 367bce19 [!!!][TASK] Drop show footer option
- ff157633 [TASK] Streamline usages of frames
- f69ee8f6 [TASK] Migrate figure styling to bs4
- b2c1244e [TASK] Migrate carousel base styling to bs4
- 67d0551a [TASK] Adjust audio styling in bs4
- d0d872c1 [TASK] Migrate scroll-top styling to bs4
- 6ebf8668 [TASK] Streamline rendering of breadcrump in bs3 and bs4
- 93ab4137 [TASK] Include framework name and version in generated css files
- 390bb387 [TASK] Load bootstrap 3 with a different package name to avoid later conflicts
- 3aa8a39e [TASK] Move ionicons to contrib folder
- be3dc438 [TASK] Move all bootstrap 3 resources to contrib
- 617911fc [TASK] Move bootstrap 3 includes to dedicated folders
- 9959417a [TASK] Move bootstrap 3.x specific constants
- 6fea42d1 [TASK] Drop empty line in minified js files
- 3ea9aa5c [TASK] Move javascript assets to contrib avoid naming conflicts
- 02665eac [TASK] Update jquery to 3.3.1
- d8f151a2 [TASK] Replace npm with yarn to ensure correct versions are always loaded
- 68039777 [TASK] Cleanup gitignore
- 07e55d58 [TASK] Remove TYPO3-9.x from testing until new testing setup available

## BUGFIX

- 667ca02a [BUGFIX] Ensure popper.js is loaded before bootstrap.js
- 8154ef41 [BUGFIX] Get rid of warning for count() thrown in less compiler with PHP 7.2
- 30a93524 [BUGFIX] Ensure condition matching assigns correct matches
- 3d212b9b [BUGFIX] Correct loading order of content elements in type select
- 71e4b681 [BUGFIX] Google font hook must modify setup after caching font files
- bc9442fa [BUGFIX] Fix issue in ChangeLogScript after cleanup
- 836dbb6a [BUGFIX] Ensure ensure typoscript language hook is working correctly
- 78a33947 [BUGFIX] Do not override function param
- 8ed59cc0 [BUGFIX] Correct CGL
- 53cf8ac4 [BUGFIX] Remove unsupported rendertype checkboxtoggle in accordion item
- 479963b6 [BUGFIX] Correct defaults for accordion item
- 4c4a221b [BUGFIX] Correct relative urls
- d744e1c8 [BUGFIX] Respect backendlayout gutter in image generation
- b91bc79c [BUGFIX] Correct phpunit call in composer json
- 12890b8a [BUGFIX] Correct cgl in unit test
- 94a4038b [BUGFIX] Use full command to run unit tests
- bb610941 [BUGFIX] Correct travis config
- 1a417fae [BUGFIX] Correct menu thumbnail constant assignments
- cc12bc3f [BUGFIX] Use correct storage for media assets crop configuration
- df6de77d [BUGFIX] Use correct interface in data relation viewhelper
- a2c5588c [BUGFIX] Remove unused code in texticon utility
- acf91f2c [BUGFIX] Add missing namespace declaration in google font service
- f1268e8b [BUGFIX] Adapt icon type checks in text icon partials
- 019fa878 [BUGFIX] Add missing frame layout class
- 95f0940d [BUGFIX] Correct typo in docheader of file filter processor (#545)
- 4103992f [BUGFIX] Add missing color information for navbar toggler in bs3
- 9348605b [BUGFIX] Correct position of above and below rendering in textpic and textmedia
- dd195c60 [BUGFIX] Correct grouping of icon enable toggle for subnavigation
- 85958995 [BUGFIX] Make complete background transparent if navigation is in transition mode
- 337728e4 [BUGFIX] Remove obsolete console.log from box plugin
- 04efa9ec [BUGFIX] Use TsConfig instead of TSconfig
- 4db1d7f8 [BUGFIX] Correct CGL
- bc894830 [BUGFIX] Ensure correct positioning of preloader
- a9595535 [BUGFIX] Process fieldName correctly in flexform data processor
- 67e6d65d [BUGFIX] Enable translations of timeline content element
- e4c992fa [BUGFIX] Add missing sorting field for timeline item
- d5691ecd [BUGFIX] Add missing system information icon
- 84ae0e8e [BUGFIX] Respect conditions in webfont includes
- 75d222be [BUGFIX] Use correct namespace for navigation constants in layout
- 21984c17 [BUGFIX] Override width and height attributes correctly in InlineSvgViewHelper
- 70de407e [BUGFIX] Correct docheader of CoreVersionCondition
- b0fe904d [BUGFIX] Load extension configuration only when extensions are installed
- a6b972b8 [BUGFIX] Correct return type in GoogleFontService
- 4bc84b4b [BUGFIX] Correct typo in AdditionalFieldInformation
- 92673368 [BUGFIX] Correct parsefunc to allow address tags outside p tags
- d2483f32 [BUGFIX] Correct ckeditor address plugin to allow links for mail and www
- 53ecaaf6 [BUGFIX] Resolve deprecation for EXT:lang in TYPO3 v9.x
- f4281b22 [BUGFIX] Correct return types in GoogleFontHook and PreProcessHook
- cf067eab [BUGFIX] Correct doc comments in LanguageMenuProcessor
- 82704b5e [BUGFIX] Correct return type in ConstantsProcessor
- d68a3cbc [BUGFIX] Update scrutinizer configuration (#532)
- 34a276fe [BUGFIX] Correct CGL
- aba2db81 [BUGFIX] Use .typoscript fileeindng for configuratio files in TYPO3 >= 9.3 for external includes
- fdd59ef5 [BUGFIX] Remove double BackendLayouts in comment (#528)
- 04c8039b [BUGFIX] Remove unavailable return type void to support php < 7.2.x
- 6d00567f [BUGFIX] Correct several typos - fixes #525
- ac3e4be9 [BUGFIX] Add missing height and width attributes to backend layout icons
- f7876d99 [BUGFIX] Ensure links have adjustable colors for frame backgrounds
- cdc5b127 [BUGFIX] Strip new lines before and after pre tag
- 3e297f68 [BUGFIX] Correct spacings
- 34fc0d95 [BUGFIX] Caption alignment should follow image alignment - fixes #515
- 4f315c39 [BUGFIX] Rename folder to macht includes
- 9a423a06 [BUGFIX] Ensure language typoscript is added correctly
- 38b17767 [BUGFIX] Check if array is empty in language utility
- 0dce3aaf [BUGFIX] Use twoLetterIsoCode instead of language field
- a32f777e [BUGFIX] Ensure language configuration is not overwritten
- 0d447094 [BUGFIX] Correct syntax error in php 7.0 in LanguageMenuProcessor
- 1800e07a [BUGFIX] Correct comment
- bbb2069d [BUGFIX] Make datefield required again
- 617e5227 [BUGFIX] Use datefield to save date values in timeline
- c0715ca1 [BUGFIX] Correct php-cs-fixer command in github issue template - fixes #512
- 92953da0 [BUGFIX] Properly close html tag in navigation partial
- 10554117 [BUGFIX] Add missing compiled css files
- 18faa42a [BUGFIX] Ensure that em is used instead of rem in bs3 card layouts
- ae4eb8c4 [BUGFIX] Ensure section index menu is also available for hidden pages if directly assigned
- df258c96 [BUGFIX] Correct calculations for border radius
- e08f1c3b [BUGFIX] Correct language label
- 2eea1879 [BUGFIX] Correct identifier for button text in call to action item
- 86f03457 [BUGFIX] Properly close html tag in content element dropins
- 89709cd7 [BUGFIX] Correct cgl violations
- f409290e [BUGFIX] Remove obsolete class from footer section meta frame
- 4989d842 [BUGFIX] Ensure that selected pages are shown in menu content elements
- 836ad213 [BUGFIX] Adjust form override key to avoid conflicts with introduction
- a0240a95 [BUGFIX] Add active state to meta menu
- dd6ba018 [BUGFIX] Add default if background color class is not set
- 68f5f5a7 [BUGFIX] Remove debug message
- 272052f4 [BUGFIX] Use english in contact form subject
- b672ac93 [BUGFIX] Correct icongroup css
- b052c855 [BUGFIX] Use href instead of data attribute to avoid messing of urls
- 4c63f0ac [BUGFIX] Remove testing console.log calls
- 0e1d92b2 [BUGFIX] Correct toggle selector for main navigation hover
- b6720e5b [BUGFIX] Use correct accordion_item language label in Backend.xlf (#490)
- 42e1fd94 [BUGFIX] Show navigation toggler only above grid float breakpoint
- d02ed354 [BUGFIX] Remove wrong placed closing html tag in copyright partial
- 1307dd7d [BUGFIX] Remove wrong placed space
- a8b11121 [BUGFIX] Attributes on breadcrumb list item should be separated by whitespace
- 08a45ed7 [BUGFIX] Remove false condition for abstracts in card menus
- b45b3bd5 [BUGFIX] Unset file array in css processing hook
- 0ae48e6d [BUGFIX] Correct CGL
- fdd2b8ed Revert "[BUGFIX] Set correct type for svg files in apache configuration"
- 2d90873f [BUGFIX] Set correct type for svg files in apache configuration
- e950b85b [BUGFIX] Set correct type for javascript files in apache configuration

## MISC

- d900028c [CLEANUP] Move additional field information node to language compat
- d6462e4b [CLEANUP] Move extension icon
- a7f5f09c [CLEANUP] Correct text and icon migration leftovers
- edd29832 [CLEANUP] Correct class comment in abstract parser
- 6f0d9786 [CLEANUP] Minor cleanups
- f2d0be5c [CLEANUP] Remove obsolete background image width settings

## Contributors

- Ben Abbott
- Benjamin Kott
- Benjamin Kott
- Dennis
- Dennis Pfahlbusch
- Frank Naegler
- Frank Nägler
- Frans Saris
- Georg Ringer
- Gilbertsoft
- Jacob Dreesen
- buechlerpro
- netbrothers-tr
- ute-arbeit

# 9.1.0

## BREAKING

- c00049b0 [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine.
- 7b1fbdfe [!!!][FEATURE] Add auto lookup for page templates

## FEATURE

- 7b1fbdfe [!!!][FEATURE] Add auto lookup for page templates
- 2505133a [FEATURE] Add auto lookup for page templates

## TASK

- ec395387 [TASK] Raise allowed TYPO3 version to 9.5.99
- c489860b [TASK] Add travis tests for php 7.2 on typo3 master
- c677ad9f [TASK] Move CMS9 backend branding to service that is only called on installation
- c7d0fc17 [TASK] Only write backend configuration if it has changes
- b8f92490 [TASK] Remove correct addStaticFile function from extension scanner
- edf09e63 [TASK] Move icon registration to localconf
- da16625d [TASK] Exclude php less libary from extension scanner

## BUGFIX

- c00049b0 [!!!][BUGFIX] Make DataRelationViewHelper compatible with doctrine.
- 98680104 [BUGFIX] Set default backend configuration for CMS9
- 00a28673 [REVERT][BUGFIX] Install php extension intl on travis ci
- 33330645 [BUGFIX] Install php extension intl on travis ci
- 80121cd8 [BUGFIX] Adapt travisci build configuration to documentation
- 2fc802bd [BUGFIX] Ensure page layout class is never empty

## Contributors

- Benjamin Kott

# 9.0.0

## BREAKING

- 20124b9a [!!!][TASK] Remove obsolete pagetype popup - fixes #476
- a500b6d6 [!!!][FEATURE] Make css classes of footer columns directly addressable
- 625af26f [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core
- da1db9d8 [!!!][TASK] Remove mod_filter check by default
- 4036bd30 [!!!][FEATURE] Load bootstrap rte configuration for all records by default
- 4b8baeec [!!!][FEATURE] Enable links on dropdown menus in main navigation
- 25b731d4 [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level
- 9583970b [!!!][TASK] Use .typoscript instead of .txt for configuration files
- 3123bd22 [!!!][BUGFIX] Streamline grunt less and less.php rendering
- a2f9deaf [!!!][TASK] Drop obsolete windows phone fix
- 835b16b3 [!!!][TASK] Drop equalheight script

## FEATURE

- 450e4651 [FEATURE] Pass current element on trigger loaded.bk2k.responsiveimage - fixes #471
- 33e6ffeb [FEATURE] Allow links on carousel type background image - fixes #455
- 48ef140a [FEATURE] Enable frontend editing for pages
- 8d064573 [FEATURE] Enable frontend editing for content elements
- dca76d18 [FEATURE] Make open accordion item configurable
- e5d9cade [FEATURE] Make gallery item column sizes configurable - fixes #465
- 6fbd0f29 [FEATURE]  Add table class in ckeditor by default
- a54478ba [FEATURE] Add ckeditor plugin to insert boxes
- e85c213f [FEATURE] Add carousel item type image
- e13a417f [FEATURE] Add configurable header and subheader css classes
- 5a60918f [FEATURE] Add additional inline text style classes to editor config
- a9bd8c59 [FEATURE] Add background image and base coloring support for content elements
- 34e00390 [FEATURE] Introduce frame-container and frame-inner for more detailed control options
- 42a676db [FEATURE] Add auto lookup for carousel item templates and move wrapping links to partials
- 7b0f4067 [FEATURE] Add UpperCamelCaseViewHelper
- 88e86ecf [FEATURE] Add option to show navigation title in carousel navigation
- 642eaff7 [FEATURE] Add navigation icons for main navigation
- aad4bf53 [FEATURE] Add current version to system information toolbar
- 4be3c373 [FEATURE] Make scaling options for headlines configurable
- a500b6d6 [!!!][FEATURE] Make css classes of footer columns directly addressable
- 0d6c2ebe [FEATURE] Make footer meta section colors configurable
- 57ca0055 [FEATURE] Make breadcrumb extendable to show title of single records
- 33d85248 [FEATURE] Add example configuration for Microsoft-IIS
- 7a19e6e2 [FEATURE] Add support for google-site-verification meta tag
- 4f93616d [FEATURE] add element wrap in lib.dynamicContent
- 4036bd30 [!!!][FEATURE] Load bootstrap rte configuration for all records by default
- 4b8baeec [!!!][FEATURE] Enable links on dropdown menus in main navigation
- 25b731d4 [!!!][FEATURE] Split menus instead of adding text when adding a spacer on main level
- cd475449 [FEATURE] Make config.typolinkEnableLinksAcrossDomains available through constant
- 770c96ae [FEATURE] Enable cropping of carousel background image
- 42558aec [FEATURE] Enable cropping for image in carousel

## TASK

- 20124b9a [!!!][TASK] Remove obsolete pagetype popup - fixes #476
- cf4cefc1 [TASK] Push notifications to slack
- ba56d072 [TASK] Register bk2k as global namespace for viewhelpers
- 849d9dd4 [TASK] Check for explicit for null value in version toolbar item
- 6da63b5c [TASK] Adjust scrutinizer build
- b9c14b20 [TASK] Remove obsolete divider to tabs option
- 22077d2b [TASK] Rename ckeditor box plugin to avoid naming conflicts
- 4245a426 [TASK] Reduce form css to minimum and adapt to new form elements
- 8299c8c2 [TASK] Update package-lock
- ff4d2f7e [TASK] Remove obsolete watch task for viewportfix
- a5628c4e [TASK] Add small option to ckeditor
- fff4b2c3 [TASK] Add default css class to unordered lists from rte
- 2104e7ba [TASK] Reduce default fields of carousel item
- 3d2c4b00 [TASK] Streamline element quote TCA
- 014fb170 [TASK] Hide relation tables to avoid problems when managed without proper context
- 7d66f2ee [TASK] Remove authors from phpdoc
- ddd4880b [TASK] Streamline php header comments and add fixer rule
- c991413d [TASK] Remove obsolete margin bottom from breadcrumb
- b13a1bd2 [TASK] Enhance positioning of scroll to top button
- b839cb20 [TASK] Avoid ambiguous "uid" error (#480)
- 430fb3a3 [TASK] Use initialize arguments instead of render arguments in FalViewHelper
- 769928f4 [TASK] Use initialize arguments instead of render arguments in DataRelationViewHelper
- 60eb7600 [TASK] Use initialize arguments instead of render arguments in ExplodeViewHelper
- 092eb3a8 [TASK] Add mini section styling
- e9394bb1 [TASK] Use initialize arguments instead of render arguments in ExternalMediaViewHelper
- 228aeb8c [TASK] Use initialize arguments instead of render arguments in LastImageInfoViewHelper
- cc8328e1 [TASK] Remove obsolete tt_content palettes
- 625af26f [!!!][TASK] Remove fallback menu processor since it was merged into TYPO3 core
- d70b031b [TASK] Update readme and include frontend screenshot
- d0bf8348 [TASK] Add .rst and .typoscript to editorconfig
- 1d36a5bf [TASK] Add deployment for www.bootstrap-package.com
- da1db9d8 [!!!][TASK] Remove mod_filter check by default
- 9e13ae1f [TASK] Ensure link target attribute is only rendered if target is set - fixes #468
- 9583970b [!!!][TASK] Use .typoscript instead of .txt for configuration files
- a702b26a [TASK] Update npm dependencies
- a2f9deaf [!!!][TASK] Drop obsolete windows phone fix
- 835b16b3 [!!!][TASK] Drop equalheight script
- 528b8510 [TASK] Remove release commit from changelog
- 61ce04b2 [TASK] Replace unwanted characters in commit messages
- bdef9ab9 [TASK] Add composer changelog script
- 9e1456f9 [TASK] Drop development affix for version numbers
- cb2480b2 [TASK] Add composer version script
- 2c224fd3 [TASK] Cleanup code formatting for palette configuration
- c22ff319 [TASK] Use php-cs-fixer instead of php-codesniffer
- 6773db49 [TASK] Adjust composer keywords
- c1007227 [TASK] Raise php dependency to 7.x
- 05c42f69 [TASK] Remove not working ter upload
- 88fa5d67 [TASK] Add typo3 8.7 to travis

## BUGFIX

- c105a130 [BUGFIX] Correct css selector for carousel item type text and image
- bb499d76 [BUGFIX] Correct indentions
- 54dc3d26 [BUGFIX] Show correct translations in language menu (#487)
- 6b0551a6 [BUGFIX] Ensure aria-expanded is correctly set for accordion items
- e0b8ceff [BUGFIX] Ensure selected tab item is shown in the backend
- a5925b1c [BUGFIX] Only support hover for on navbar toggle if hover is completely supported - fixes #459
- 5e4a16dd [BUGFIX] Add missing namespaces to carousel small and fullscreen templates
- 6cd74910 [BUGFIX] Use self instead of static in DataRelationViewHelper
- 617e8981 [BUGFIX] Add css to precompiled css files
- 3fd55f64 [BUGFIX] Correct jumbotron button styling
- 47bfded3 [BUGFIX] Add missing list styles to rte configuration
- c8ae888b [BUGFIX] Correct bootstraps calculation of container widths
- 537fe9d6 [BUGFIX] Ensure correct link colors are loaded for footer meta section
- 84a6674e [BUGFIX] Ensure footer list are actually centered
- b441bc8c [BUGFIX] Correct preview template assignments for listgroup and external_media
- 1f8fb5c4 [BUGFIX] Set default value for tt_content reference fields in *_item tables (#482)
- 34834d8f [BUGFIX] Add parseFunc handling to pre tags
- 7e3565d2 [BUGFIX] Correct rendering method of LastImageInfoVIewHelper
- 7267a2e3 [BUGFIX] Correct indention in generic template
- c9cd0a0e [BUGFIX] Limit media element to youtube and vimeo
- 49f894f5 [BUGFIX] Display cropping variants for textmedia - fixes #438
- 8411a1d5 [BUGFIX] Ensure link is displayed correctly in readme
- e842ce9c [BUGFIX] Correct image link in readme
- fa32c509 [BUGFIX] Add boostrap-package.com as known host
- c0826c4d [BUGFIX] Specify Deployer file
- 5a91e6fe [BUGFIX] Fix sys_language_uid when adding item to translated tt_content (#458)
- 7f7b7888 [BUGFIX] Only show content in MenuSectionPages that is marked for section index - fixes #466
- 191395dc [BUGFIX] Close tags in meta menu properly - fixes #469
- 024c5325 [BUGFIX] Remove unused constant assignments - fixes #477
- 9bf16d50 [BUGFIX] Remove padding of navbar-collapse on desktop
- 3123bd22 [!!!][BUGFIX] Streamline grunt less and less.php rendering
- afead779 [BUGFIX] Remove wrong placed comma in navbar less file - fixes #460
- 498f9700 [BUGFIX] Prepare colPos field for proper quoting (#452)
- d9a56f4b [BUGFIX] Correct texticon preview paths on windows
- 439c38eb [BUGFIX] Remove .php_cs.dist from export
- 13edd339 [BUGFIX] Correct less variable: @icon-font-path (#450)
- a740752d [BUGFIX] Correct sys_file_referece palettes for tab items
- ef33c3e1 [BUGFIX] Correct sys_file_referece palettes for accordion items
- e6871525 [BUGFIX] Use override child tca for carousel background image
- dc47cc99 [BUGFIX] Correct value type of data-wrap for bootstrap carousels - fixes #437
- ce256fe3 [BUGFIX] Remove conflicting btn stylings for legacy rtehtmlarea - fixes #447
- 9ce70d27 [BUGFIX] Correct dependencies for typo3 cms 9.x

## MISC

- 448d684d [CLEANUP] Fix typo by adding missing c to "seletor"
- 8ae85ef1 Use correct closing tag

## Contributors

- Anja
- Benjamin Kott
- Benjamin Kott
- Cedric Ziel
- Mathias Brodala
- Oliver Hader
- Pat
- Sascha Egerer
- Tymoteusz Motylewski
- mickenorlen

# 8.0.0

## BREAKING

- e33f0ed8 [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead

## FEATURE

- 4b39a415 [FEATURE] Enable compression of generated css files
- caac09a6 [FEATURE] Add bootstrap responsive wrapper to table ce - fixes #385
- efde1cb1 [FEATURE] Add art direction for image, media, textpic and textmedia

## TASK

- d1594b66 [TASK] Force captions to break
- a122f485 [TASK] Make thumbnail menu more flexible
- 7fd49b6f [TASK] Apply more flexible style on thumbnail menus
- 0fd71212 [TASK] Remove cropping from text an image carousel item
- 7431a082 [TASK] Add missing rte configuration for content element panel
- 4c3209f3 [TASK] Optimize brand placement
- 2dd177b7 [TASK] Use SVGs files instead of png for logos in frontend
- c751d36d [TASK] Raise TYPO3 dependency in scrutinizer config
- 13837b08 [TASK] Remove obsolete adjustments for indexed search
- 54b46e5c [TASK] Update missleading informations
- 7ff8f0dc [TASK] Raise TYPO3 Version requirement to 8.7 LTS
- 65315cdb [TASK] Migrate foreign selector to override child tca
- 215fb15e [TASK] Remove default rendering fallback, core provides information already
- d761f7d2 [TASK] Remove deprecated localizationMode from TCA
- d0d5ef42 [TASK] Use new form framework instead of old mailform element
- 2d28eee0 [TASK] Change seperator of page title
- 760f7ebd [TASK] Remove obsolete typoscript configuration
- 960d40fe [TASK] Adapt generic fluid template to match requirements for plugins
- 17071d44 [TASK] Remove obsolete assignment for felogin
- f50b57f1 [TASK] Adapt childtca override config for cropping variants
- c9ce1dd2 [TASK] Adapt indexed search to CMS8
- 0ed67059 [TASK] Remove obsolete login template
- 75ea29eb [TASK] Adapt frontend login to CMS8
- d55863b0 [TASK] Add generic template for general usage
- c3b01a98 [TASK] Remove obsolete tt_content typoscript configuration
- b84a29dc [TASK] Add rte configuration for tabs and accordions
- 5b5fca09 [TASK] Restore typical content elements panel
- 7672bfd4 [TASK] Add textpic and textmedia to content element wizard media and text
- ad73b38e [TASK] Add ckeditor as dependency - fixes #431
- 47410a83 [TASK] Adapt php-cs-fixer configuration
- 6547a491 [TASK] Remove obsolete canNotCollapse attribute
- d83b10e6 [TASK] Resolve deprecation for general language file
- 743782cf [TASK] Optimize gallery rendering to use flexbox for better performance
- 0fc62dac [TASK] Enhance gallery template
- 3e08b28f [TASK] Honor CMS8 cache convention for processed less files - fixes #371
- 2c635f0c [TASK] Resolve deprecation and use f:defaultCase for default in f:switch
- 60dd67fd [TASK] Remove deprecated TypoScript property config.noScaleUp
- 18e4d890 [TASK] Enable accessibility options to bypass navigation content elements
- b76d3550 [TASK] Streamline blockquote RTE rendering
- 69fa8326 [TASK] Enable RTE h4 and h5 format tags
- 043ef722 [TASK] Add table RTE configuration
- aae55947 [TASK] Add basic RTE styling
- e33f0ed8 [!!!][TASK] Drop obsolete var viewhelper - use f:variable instead
- 09d97efd [TASK] Add html tag with namespace definitions to fluid tempaltes
- 85d2dbff [TASK] Streamline carousel content element
- 3b310f45 [TASK] Streamline accordion content element
- 0ea92635 [TASK] Remove type from content element configuration comment
- 33dc2fff [TASK] Streamline tab content element
- a4686fe6 [TASK] Move bullets content element in wizard to text
- a0b94c45 [TASK] Streamline bullet content element with fsc
- 53a574ef [TASK] Move table content element to text tab in wizard
- d2394149 [TASK] Streamline external media element key
- ed8c8e79 [TASK] Streamline listgroup rendering
- 3a73d617 [TASK] Move image content element in wizard to media tab
- 4c086721 [TASK] Move default content elements in wizard to dedicated tabs
- dd81e21e [TASK] Remove header palette override
- 9e9b6c8d [TASK] Streamline uploads content element with fluid_styled_content
- caec788e [TASK] Use more simple ctype for text and icon content element
- d0ce21ae [TASK] Adapt panel element for CMS8
- d277dea7 [TASK] Move texticon to text palette in content element wizard
- e75c292d [TASK] Streamline default, div, header, and html templates
- ab971f69 [TASK] Streamline quote definition and rendering
- 5d5cdddb [TASK] Remove obsolete thumbnail icon since its now available in core iconset
- 11fb8efa [TASK] Remove obsolete textmedia icon
- 105c6901 [TASK] Remove obsolete textteaser icon since its now available in core iconset
- f2dedfad [TASK] Streamline tabecolumn rendering
- 6eea9543 [TASK] Streamline textteaser definition and rendering
- 079f7bb2 [TASK] Add html tag with fluid namespace to text template
- 7b307864 [TASK] Add html tag with fluid namespace to shortcut template
- c79fed5c [TASK] Convert new lines to break for captions
- 80901d17 [TASK] Adapt media gallery from fluid_styled_content
- 6952b1eb [TASK] Adapt media element for CMS8
- 1fb86cf3 [TASK] Move external media content element to media group
- 7a6e6034 [TASK] Move audio content element to new media group
- 1c8eb6a0 [TASK] Set default header to h2
- ec2a31d2 [TASK] Enforce linux lf for xml files
- 5445e4bb [TASK] Update default .htaccess
- e0d1f40b [TASK] Remove RTE HtmlArea config
- 7dfee8fa [TASK] Minor cleanups
- 0de50f80 [TASK] Streamline table rendering with fluid_styled_content
- 1d92fe4d [TASK] Remove indexed search from new content element wizard
- 12a9269a [TASK] Cleanup new content element wizard configuration
- c36fb42e [TASK] Move thumbnail menus to menu tab in content element wizard
- 58effa99 [TASK] Migrate pages and subpages menus to dedicated content elements
- 4b602622 [TASK] Migrate abstract menu to dedicated content element
- f1ea58a7 [TASK] Migrate recently updated pages menu to dedicated content element
- e0399886 [TASK] Migrate related pages menu to dedicated content element
- 1e6844ab [TASK] Migrate section menus to dedicated content elements
- 0eae5023 [TASK] Migrate sitemap menus to dedicated content elements
- 043e07e9 [TASK] Migrate categorized content and pages menus to dedicated menus
- fefdc5b9 [TASK] Migrate thumbnail menus to dedicated menus
- 3f6571e0 [TASK] Remove obsolete fields from sql file
- 26d12f4f [TASK] Remove obsolete tt_content categorizable call
- c53d6cb0 [TASK] Remove obsolete bullets content element definition
- 20206b23 [TASK] Remove obsolete menu content element definition
- 708f6d2e [TASK] Remove obsolete table content element definition
- ecebab1f [TASK] Remove obsolete uploads content element definition
- 02e0101e [TASK] Remove obsolete textmedia content element definition
- 68f62f5b [TASK] Remove admin panel pagets configuration
- 5f9a4f18 [TASK] Remove obsolete mailform content element definition
- b0742436 [TASK] Remove obsolete shortcut content element definition
- e655ea37 [TASK] Remove obsolete html content element definition
- 7e4ae2f9 [TASK] Remove obsolete list content element definition
- 9d536a3e [TASK] Remove obsolete div content element definition
- a5a3eb0f [TASK] Remove obsolete tceform corrections
- 2efd5fd3 [TASK] Remove obsolete image content element definition
- c0bd8fc7 [TASK] Remove obsolete imageorient definition
- 792f857b [TASK] Remove obsolete textpic content element definition
- aa884691 [TASK] Remove obsolete text content element definition
- bf467eb9 [TASK] Remove obsolete header content element definition
- 355afcdd [TASK] Remove obsolete header_position
- 97cba7d7 [TASK] Adapt texticon element for CMS 8
- 1fd6e966 [TASK] Adapt tab element for CMS 8
- a11094b1 [TASK] Adapt panel element for CMS 8
- e2b86797 [TASK] Adapt carousel element for CMS 8
- 9cc5d981 [TASK] Adapt accordion element for CMS 8
- 4eb7fa6f [TASK] Adapt audio element for CMS 8
- dfcd4d26 [TASK] Adapt externalmedia element for CMS 8
- b3d49090 [TASK] Adapt listgroup element for CMS 8
- 2443f84f [TASK] Streamline content element definitions and apply new header
- e383d975 [TASK] Add fallback to header section and remove overrides
- d7d72d08 [TASK] Update loginscreen and extension configuration experience
- 872afa4e [TASK] Enable appearanceLinks palette for all content elements and add footer
- 2299ebe6 [TASK] Mark default content element layout sections as optional
- 682c36f9 [TASK] Adapt DropIn's from Fluid Styled Content
- 1b0d8527 [TASK] Migrate sectionframe to frame class, enable spacebefore and after
- 607de8f0 [TASK] Hide accordion-, carousel- and tabitems after copy
- 12dd0438 [TASK] Migrate requestUpdate to onChange
- 5055e31d [TASK] Migrate showIconTable to selectIcons configuration
- 0584b7fe [TASK] Migrate colorChoice wizard to render type colorpicker
- 92cd67d7 [TASK] Migrate TCA field quote_link and link inputLink
- 5d0d01f0 [TASK] Set versioningWS to true
- 2f8cafba [TASK] Remove unused TCA control setting versioning_followPages
- c1438159 [TASK] Migrate TCA field bodytext to match new wizards
- 35135f5f [TASK] Migrate TCA fields starttime and endtime to inputDateTime

## BUGFIX

- 85429004 [BUGFIX] Adapt thumbnail list template
- 12946cd2 [BUGFIX] Remove all typolinks from backend preview of quote element
- 2306885d [BUGFIX] Remove typolink from backend preview of quote element
- 179e73fa [BUGFIX] Add missing data prefix for lightbox caption
- 6a8037d9 [BUGFIX] Set lightbox caption
- c59d57d0 [BUGFIX] Add missing compiled css
- 14150c00 [BUGFIX] Correct font size for text and image carousel item
- 50256dab [BUGFIX] Add missing support for subheader on carousel text and image
- c25bfe94 [BUGFIX] Exclude buttons from section link styling
- d6237f37 [BUGFIX] Add missing link colors to sections
- e339b4c7 [BUGFIX] Use correct external media palette
- ee95762c [BUGFIX] Correct spacing between carousel indicators
- 7e909ea0 [BUGFIX] Correct sorting in content element type select
- 49318ceb [BUGFIX] Correct resolving of less sourcemaps - fixes #413
- 571192e5 [BUGFIX] Set default language value for custom records
- 99fbf8ff [BUGFIX] Add hammer.js mapping files for debugging - fixes #396
- 5d7521c6 [BUGFIX] Resolve deprecation for language file usage
- f9b5e59f [BUGFIX] Remove focus after clicking on scroll-top link - fixes #432
- eaa579fc [BUGFIX] Add missing html tags and streamline selfclosing tags
- e890dc88 [BUGFIX] Correct hook to clear less caches
- 324e83ff [BUGFIX] Correct relative path for less processing
- a4f0a2a3 [BUGFIX] Ensure correct preformatted text rendering
- b3ca827a [BUGFIX] Correct TCA for parent record in accordion and tab item
- f05fc557 [BUGFIX] Correct spelling of temp folder
- 0f0e61b4 [BUGFIX] Add type to linkVars language parameter
- a49c3995 [REVERT][BUGFIX] Remove tools from scrutinizer config but disable analyzer
- b74c7d0e [BUGFIX] Remove tools from scrutinizer config
- 4d0453f3 [BUGFIX] Set TYPO3 version for scrutinizer build
- fa4c2787 [BUGFIX] Require typo3/cms for scrutinizer build
- a65475ec [BUGFIX] Restore location of well and jumbotron in frame class

## Contributors

- Andrea Moroni
- Benjamin Kott

# 7.1.0

## BREAKING

- d2b23d1f [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356
- f2b06d7d [!!!][TASK] Reintroduce "no frame" option - fixes #319
- eedb60dc [!!!][FEATURE] Add sections to visually group elements
- 9001189d [!!!][FEATURE] Adjust make footer color configurable
- 7d58ac63 [!!!][FEATURE] Add support for google webfonts - fixes #115
- 5d0a76cd [!!!][FEATURE] Add support for spacer in menu processor - fixes #335

## FEATURE

- d07e219a [FEATURE] Make language uids for menu configurable
- c7ac13dd [FEATURE] Add audio content element - fixes #399
- add8bc0d [FEATURE] Add preview for quote content element
- 3c2ddf2c [FEATURE] rearrange settings for images and media assets (#395)
- 2b0e5772 [FEATURE] Add signal to compile service - fixes #371
- 1b528c48 [FEATURE] Add quotation content element
- 0f206e87 [FEATURE] Provide generated link and target from hmenu in menu resultset - fixes #380
- d5218b19 [FEATURE] Add smothscrolling and back to top link
- 477a83e1 [FEATURE] Add content element text with teaser
- 41f2413a [FEATURE] Add constant for absolute favicon path
- 9d54f211 [FEATURE] Add subheader to carousel item header
- ceaa9695 [FEATURE] Add stickyheader to overlay carousel
- b6518150 [FEATURE] Add fullscreen variant of carousel
- c5c6f615 [FEATURE] Add support for additional iconsets and ionicons - fixes #357
- b34960fa [FEATURE] Add header_link to the icon of text widh icon content element - fixes #154
- 66c76500 [FEATURE] Add meta navigation support
- 8f23e439 [FEATURE] Add marker for frontendurl
- ef7bcf09 [FEATURE] Add content element to display regular text in columns
- f043d601 [FEATURE] Allow html entities in carousel header
- 9430c1e9 [FEATURE] Colorize text selection in primary color
- 37658b84 [FEATURE] Make imported font weights of google webfonts editable
- 7da14da1 [FEATURE] Add transition option to switch from fade to slide - #356 #347
- d2b23d1f [!!!][FEATURE] Use explicit templates instead of conditions in carousel templates - relates #356
- eedb60dc [!!!][FEATURE] Add sections to visually group elements
- 9001189d [!!!][FEATURE] Adjust make footer color configurable
- 7d58ac63 [!!!][FEATURE] Add support for google webfonts - fixes #115
- 5d0a76cd [!!!][FEATURE] Add support for spacer in menu processor - fixes #335
- d36a8b22 [FEATURE] Add content element for vimeo and youtube videos
- ad695e01 [FEATURE] Clear less cache when all caches are cleared

## TASK

- 63fa499f [TASK] Optimize html output
- bcfd9ef1 [TASK] Update dependencies
- 5cd45254 [TASK] Add instruction to clear initial TypoScript (#420)
- 93e55e84 [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5
- 82be428f [TASK] Update changelog schema
- ad98cd53 [TASK] Optimize travis and composer configuration for automatic ter uploading
- 6deb2785 [TASK] Add TYPO3 8 dev-master to issue template
- 0bb032e0 [TASK] Add GitHub pull request template
- 722b4426 [TASK] Add GitHub issue template
- 7e79b774 [TASK] remove uniqueLinkVars (#407)
- 4921d82a [REVERT][TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5
- 7537983c [TASK] Use typo3/cms classname for menu processor and provide alias as fallback for versions below 8.5
- fb6467b2 [TASK] Streamline php_cs fixer configuration with TYPO3 core
- 60beeb92 [TASK] Add checks for TYPO3_MODE to all tca override files configuration files
- 8979cb4c [TASK] Throw exception if invalid arguments are passed to menu processor
- 53ea6d26 [TASK] Drop IE8 and IE9 support for background images in carousel
- 62e88701 [TASK] Always trim assigned variables in var viewhelper
- af899668 [TASK] Streamline position of columns for images and media to match textpic and textmedia
- b74db027 [TASK] Use shorthand array syntax in custom record tca
- 25797b05 [TASK] Do not set links bold in navigation bar
- 82e3c2a0 [TASK] Remove obsolete use statement
- 9cfb3659 [TASK] Update menu templates to use the generated links and targets from menuDataProcessor
- 1ce0019d [TASK] Replace f:link.page with static link (#370)
- eae382e0 [TASK] Exclude fixed navbar from scrolling to anchor
- 0946712d [TASK] Add border between same sections
- f9920241 [TASK] Allow html entities for content element header
- b7b67d5a [TASK] Remove obsolete constants
- 15a6926d [TASK] Update modernizr to 3.3.1
- 1fa43ee8 [TASK] Adjust section size
- 19d15904 [TASK] Move icon selector to new tab to have enough space for large icon sets - relates #357
- c43ab1ea [TASK] Move icon registration for text with icon to itemsProcFunc - relates #357
- 1cb56ab9 [TASK] Remove unnessesary margin for last element in texticon content
- 8b1ae0a3 [TASK] Remove dependency to glyphicons in carousel control - relates #356
- 9a573c1e [TASK] Move carousel controls to partials - relates #356
- 145e1645 [TASK] Adjust indentions
- 83baee48 [TASK] Enable default and rename current to normal to ensure it can be overridden without removing the normal template
- f2b06d7d [!!!][TASK] Reintroduce "no frame" option - fixes #319
- 89cb1f8f [TASK] Correct indention according to PSR2
- 7827744b [TASK] Do not exclude composer.json from export
- 86306a43 [TASK] Add CType as class to outer content element frame
- 8f982e48 [TASK] Add scaling for text-icon
- 2fff83a0 [TASK] Scale headlines on smaller devices
- 468c5ad3 [TASK] Use dataprocessors instead of viewhelpers for carousel rendering
- 148b159a [TASK] Scale margin of frames
- 1740c475 [TASK] Move page class and id from section to bodytag
- b714e05c [TASK] Remove override for hover link decoration and use bootstrap variables instead - fixes #321
- cde7cf04 [TASK] Split tt_content overrides
- 9ae55e7a [TASK] Optimize images
- 10c8ce0c [TASK] Use correct icons for tt_content imageorient palette - fixes #352
- eb7036dd [TASK] Remove bower from travis tests
- 96c2a40a [TASK] Include photoswipe via npm instead of bower
- 283fce82 [TASK] Include hammerjs via npm instead of bower
- 9f8820d2 [TASK] Include bootstrap via npm instead of bower
- 389afc83 [TASK] Update jquery to 2.2.4
- cda5f1ee [TASK] Update hammer.js to 2.0.8
- 6af9bbaa [TASK] Update grunt
- 9a43942a [TASK] Correct composer requirements for TYPO3
- d5c20452 [TASK] Remove unit tests from travis
- 374250e8 [TASK] Fix Travis 2
- 000d0d83 [TASK] Add color option to phpunit for travis
- ad0828b1 [TASK] Add typo3 unit tests to travis
- dfe05c93 [TASK] Remove version from composer.json to prefer git tags
- b58e6299 [TASK] Adjust editorconfig
- b8fe3c75 [TASK] Add changelog for release 7.0.0
- 3ceaaf1e [TASK] Add missing changelog entries for 7.1.0
- 00d42a06 [TASK] Enable basic frontend editing
- c49042da [TASK] Add missing css fixes for #325
- c733ffdd [TASK] Accessibility - fix of landmark error added role and aria- labelledby attribute
- bef517e2 [TASK] Accessabiliy - added role navigation to breadcrumb
- 9a5a6a8c [TASK] Accessibility - delete role contentinfo because you cant nest the same landmark in itself
- a2810cb2 [TASK] Accessibility - correction of landmark
- 2c9ee0e2 [TASK] Accessibility - Add link title attributes to logo constants, setup and html
- bf80fe37 [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options

## BUGFIX

- ec643241 [BUGFIX] Add missing icon for text & media missing - fixes #417
- 46697bdc [BUGFIX] Adapt link tag parsing for RTE fields
- a04a6c7f [BUGFIX] Move class alias for menu processor to localconf to ensure correct loading
- cdd2005d [BUGFIX] Ensure that variables are not converted to strings by variable viewhelper
- 72bb577c [BUGFIX] Use correct layout (#408)
- c0c3cc55 [BUGFIX] Correct position of carousel with fixed transparent header
- b698328f [BUGFIX] Ensure that navbar-collapse has a maxheight if menu is fixed
- 6886bc8e [BUGFIX] Enforce checkout with linux lf consistent over all plattforms
- 0dff0700 [BUGFIX] Respect show in section menus option for pages in section index menu
- a91373e8 [BUGFIX] Use smooth scroll only on elements that have an hash... (#398)
- dd66961d [BUGFIX] Move temp folder back to root of typo3 temp
- 485ab966 [BUGFIX] Remove double imagecols field in showitem configuration
- b27d0173 [BUGFIX] Workaround variable name cut off in CMS8 - fixes #388
- ed63827f [BUGFIX] Use string to identify bootstrap_package for adding static template
- f46a6317 [BUGFIX] Allow non ID values for language fields to avoid errors on mysql strict mode
- 4b855079 [BUGFIX] Correct sql definitions for bodytextfields for carousel, accordion and tab content element item
- 0645bb31 [BUGFIX] Correct indention of sql definition
- f1b42b47 [BUGFIX] Correct teaser sql field definition
- e0892160 [BUGFIX] Move TCA change in ext_tables.php to Configuration/TCA/Overrides (#389)
- c0ba7863 [BUGFIX] Avoid specific DBMS literals in database queries (#384)
- 64f98070 [BUGFIX] Fix inline documentation of MenuProcessor (#369)
- bcddcaf5 [BUGFIX] Correct dependency for namelesscoder/typo3-repository-client
- cc39afcc [BUGFIX] Correct positioning of carousel when header is fixed
- 8ac31002 [BUGFIX] Correct case error in ionicons template
- 9553484d [BUGFIX] Use correct less variable in font-family-base
- 566d1352 [BUGFIX] Correct position of carousels on sticky header
- 90fb0b24 [BUGFIX] Add missing active state to stickyheader
- e6cc5ab5 [BUGFIX] Correct navbar z-index in combination with fullscreen carousel in border column
- 446435fe [BUGFIX] Ensure color for headlines is correclty inherited in footer sections
- aa388a27 [BUGFIX] Correct output of texticon if no icon is selected
- eb894e19 [BUGFIX] Ensure carousel headline color is inherited
- c2db0763 [BUGFIX] Remove duplicate case in content element layout
- c04e2b02 [BUGFIX] Correct paragraph rte classes
- ac12a519 [BUGFIX] Fix tab elements missing on slided content
- a994f777 [BUGFIX] Fix carousel elements missing on slided content
- ddaab8b8 [BUGFIX] Fix accordion elements missing on slided content
- 5fb24e9d [BUGFIX] Correct texticon content element rendering with default layout - fixes #336
- 08f69947 [BUGFIX] Correct PSR-2 issues
- a39c6bb5 [BUGFIX] Tabs, Accordion, and Carousel Items not referencing files on sys_file_reference and sys_refindex - fixes #349
- 9413d781 [BUGFIX] Bugfix/menuprocessor (#354)
- 58824f97 [BUGFIX] Prevent double escaping of menu titles
- 63909ec4 [BUGFIX] Remove vendor dir from php lint tests
- e39df3fc [BUGFIX] Load form configuration only if ext:form is installed
- a8bb806f [BUGFIX] Respect padding in equalheight script
- 9b16ef3f [BUGFIX] Correct overlapping of content elements with indention - fixes #325
- 17bf663e [BUGFIX] Corrected label for attribute
- bf80fe37 [BUGFIX][REVERT][TASK] Remove unneeded rte_transform options

## MISC

- 0459bd33 "usind" is wrong
- 0a22336a Correct php-cs-fixer command

## Contributors

- Andrea Moroni
- Benjamin Kott
- Benjamin Kott
- Cedric Ziel
- Christian Kuhn
- Christian Toffolo
- Frans Saris
- Franz Holzinger
- Georg Ringer
- Martin Bless
- Nicole Cordes
- Oliver Hader
- s-leger

# 7.0.0

## BREAKING

- 9b9f9452 [!!!][TASK] Send cache headers per default
- 5ecadef4 [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other
- 22d60c8b [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor
- bd62ef80 [!!!][TASK] Disable link to top
- 1761622a [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts
- fe5b5b88 [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default
- c9a9ffb5 [!!!][TASK] Drop IE8 support
- e9caa18c [!!!][FEATURE] Register optional PageTS config files
- 8ade18a3 [!!!][TASK] Remove some 6.2 specific fallbacks
- 569df457 [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4
- d70ee66d [!!!][TASK] Drop TemplateFileResolver fallback for 6.2
- dd81e0c1 [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now
- 0bc14990 [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev

## FEATURE

- 7806d37a [FEATURE] Remaining PageTS templates are configurable
- 561cb0ed [FEATURE] Allow to disable footer-section with Typoscript constant.
- 317032be [FEATURE] Allow photoswipe to be opened by url params
- a00e0117 [FEATURE] Add PhotoSwipe as lightbox
- b6bdc425 [FEATURE] Thumbnail Menu
- 9ffce33a [FEATURE] Include records without default translation in content select
- a16b6255 [FEATURE] Allow media content in accordion
- 9ccf082c [FEATURE] Allow media content in tabs
- e9caa18c [!!!][FEATURE] Register optional PageTS config files

## TASK

- 42001a96 [TASK] Set defaults for backend configuration
- bdd51ada [TASK] Remove backend_layout upgrade wizard
- a2f2e591 [TASK] Update hammerjs to 2.0.6
- 977a9977 [TASK] Update jQuery to 2.2.1
- fa1f19f3 [TASK] Update bootstrap to 3.3.6
- 4a28bad3 [TASK] Update oyejorge/less.php to 1.7.0.10
- 070ad6cf [TASK] Remove unneeded rte_transform options
- b7012da5 [TASK] Optimize export
- 444df863 [TASK] Correct accordion rendering
- f3a4be1d [TASK] Correct tab rendering when no media is selected
- b44a7983 [TASK] Remove realurl autoconfiguration in preparation for realurl 2
- 34640fd5 [TASK] Add TYPO3 branch for 7.6 and exclude php versions < 7 on master
- 9f51a7e1 [TASK] Add php7 to travis
- 89906d1a [TASK] Fix typo
- 55c4a1e6 [TASK] RTE: Classes for links, see benjaminkott#281
- 5ddf090a [TASK] Add note to vagrant box
- 9b9f9452 [!!!][TASK] Send cache headers per default
- bee69553 [TASK] Update jQuery to 2.2.0
- 91496d3d [TASK] Test asset pipe on travis
- 9a20304c [TASK] Fix Code according to CGL
- a334f7fb [TASK] Add php cs fixer config
- ccbbd11d [TASK] Add TYPO3 CMS 8 as compatible version
- 291e83bc [TASK] Split source and distribution javascript files and use static paths
- 4182473c [TASK] Adjust frontend login configuration
- 9bb70a91 [TASK] Add basic configuration and template overrides for indexed_search
- 1a479e19 [TASK] Add notice about content rendering extensions
- 7d4cb61a [TASK] Add header palette to cType list
- fc228b00 [TASK] Use default layout as identifier when not backend_layout is selected
- 36b9428f [TASK] Use use titlefield instead of raw data in menus - fixes #273
- 0217d687 [TASK] Add escaped class to example in lib.dynamicContent
- 35c2cedc [TASK] Use fluidtemplate for languagemenu rendering
- 51b40492 [TASK] Use fluidtemplate for breadcrumb rendering
- f3998640 [TASK] Use fluidtemplate for mainnavigation rendering
- a6b62f1d [TASK] Use fluidtemplate for subnavigation rendering
- 57e2acc7 [TASK] Add configuration for felogin
- b772f398 [TASK] Remove unneeded typo3_mode check
- aa91cb09 [TASK] Add textmedia content element
- 7cb7fa1f [TASK] Add typoscript parse functions
- abae4dc9 [TASK] Add basic FluidTemplate for mailform and set paths
- 540e7df8 [TASK] Add FluidTemplate for list
- 9b06797e [TASK] Add typoscript setup as content rendering template
- bade03ab [TASK] Add FluidTemplate for shortcut
- d417401f [TASK] Add description to menu processor
- 37676d76 [TASK] Add FluidTemplate for menus
- 0e4fe0b2 [TASK] Move uploads to typical page content tab
- 34483ee8 [TASK] Remove unnessesary adjustment of the header palette
- cc096ca1 [TASK] Remove leftover mention of css_styled_content
- 06f96ad3 [TASK] Add FluidTemplate for uploads content element
- 40ceba9c [TASK] Add TCA and wizard for content element div
- 5e20f7f4 [TASK] Add TCA and wizard for content element html
- a2a3a120 [TASK] Add content element wizard items for table
- eee3c634 [TASK] Add FluidTemplate for table content element
- 47396322 [TASK] Add TCA for content element bullet list
- 1257178d [TASK] Enable header position again
- feaf2e3b [TASK] Enable section frame again
- fb6ba2aa [TASK] Add TCA for content element header
- dc99388d [TASK] Add TCA for content element image
- 455cbdbe [TASK] Add content element wizard items for header, text, textpic
- bd201a54 [TASK] Add TCA for content element textpic
- 863c9fd9 [TASK] Add TCA for content element text
- 5ecadef4 [!!!][TASK] Conflict css_styled_content and fluid_styled_content due inconsistencies and incompatability to each other
- 2f6db377 [TASK] Add case for tt_content rendering
- 22d60c8b [!!!][TASK] Replace FlexFormViewHelper with FlexFormProcessor
- b8281971 [TASK] Drop experimental OnePage setup
- a110a615 [TASK] Flatten content element setup and add layouts and sections
- ce1abd1b [TASK] Several adjustments
- b9f023bb [TASK] Make css adjustments
- a7f894e5 [TASK] Remove unnessesary column classes
- d5c1071d [TASK] Move section frames to fluid
- bd62ef80 [!!!][TASK] Disable link to top
- ba7d160c [TASK] Add FluidTemplate for image content element
- b418c7fc [TASK] Flatten content element rendering
- 6e0a8823 [TASK] Steamline header usage templates
- bc5183e9 [TASK]  Add FluidTemplate for image content element
- df93601d [TASK]  Add FluidTemplate for textpic content element
- c032f2c0 [TASK]  Add FluidTemplate for text content element
- a43eb908 [TASK]  Add FluidTemplate for header content element
- c39d30bb [TASK]  Add FluidTemplate for bullets content element
- 5bbc988b [TASK] Add FluidTemplate for html content element
- 8aa6302a [TASK] Remove dependency to styles.content.get definition
- c13ffdd2 [TASK] Add FluidTemplate for divider content element
- 7f11f4d6 [TASK] Migrate reference to "wizard_element_browser" to new "wizard_link" - fixes #258
- 3db17119 [TASK] Harden template names for page module previews
- 1761622a [!!!][TASK] Use more strict template names and flatten folder structure for templates to avoid conflicts
- 4fcbcbf1 [TASK] Use dataprocessing in listgroup content element
- 737797d3 [TASK] Use fluid template name for panel content element
- f5c02601 [TASK] Use fluid template name for list group content element
- 3fd77ae9 [TASK] Use fluid template name for external media content element
- 64142fc8 [TASK] Use fluid template name for default content element
- d370a037 [TASK] Use fluid template name for tab content element
- f3e9c385 [TASK] Use fluid template name for carousel content element
- 5e2836f0 [TASK] Use fluid template name for accordion content element
- 2c6bde2d [TASK] Move css_styled_content typoscript configuration
- 174fa1be [TASK] Extract lib.dynamicContent from Base.ts
- 4c39c52e [TASK] Remove iconInOptionTags and noIconsBelowSelect - fixes #243
- 50242215 [TASK] Add preview for content element list-group
- 729d4a8f [TASK] Reduce size of external media preview
- 4adf3956 [TASK] Update less.php to 1.7.0.9
- f93cb034 [TASK] Update jQuery to 2.1.4
- e42c4e60 [TASK] Add recommended apache modules
- 823460f9 [TASK] Enable async loading for modernizr and windowsphone-fix
- fe5b5b88 [!!!][TASK] Disable compressing and concatenation of CSS and JS files by default
- c9a9ffb5 [!!!][TASK] Drop IE8 support
- 2f0d6693 [TASK] Harden expression in PreProcessHook
- f7954151 [TASK] Register content element listgroup icon
- 72c29292 [TASK] Register content element external-media icon
- 500bf8e6 [TASK] Register icon for element accordion-item
- 73145e59 [TASK] Adjust icons for element carousel-item types
- 13eb28dd [TASK] Register icons for element carousel-item types
- 37c46b2b [TASK] Register content element carousel icon
- f66d935d [TASK] Register content element accordion
- 3db5c2a4 [TASK] Register content element panel
- b4734d93 [TASK] Register content element texticon
- 92e017a3 [TASK] Register content element tab-item icon
- 286d4418 [TASK] Register content element tab icon
- bffb89b6 [TASK] Harden expression in ExternalMediaUtility
- 8ade18a3 [!!!][TASK] Remove some 6.2 specific fallbacks
- 569df457 [!!!][TASK] Drop TypoScript fallbacks for 6.2, 7.4
- d70ee66d [!!!][TASK] Drop TemplateFileResolver fallback for 6.2
- dd81e0c1 [!!!][TASK] Drop BackendLayoutDataProvider since its part of the core now
- 0bc14990 [!!!][TASK] Dropping TYPO3 6.2 support and raise version to 7.0.0-dev
- e4bbd6ce [TASK] Add preview for external media content element in page module - CMS7 only
- 8c96100a [TASK] Keep additional params for youtube urls
- 2a4aa973 [TASK] Add psr-4 autoload config to ext_emconf
- 8ef1ecdd [TASK] add classes to containers useful to better select them with CSS and Javascript
- 1a007489 [TASK] fix tag closure for HTML5 head meta and link
- b7511944 [TASK] breadcrumb: include the homepage link at the beginning of the breadcrumb.
- 4e01a9e4 [TASK] breadcrumb: for the content of the links use alternative navigation title if it is set, else use page title.

## BUGFIX

- 3a6d10a6 [BUGFIX] Remove skin setting from RTE configuration to ensure correct file is loaded in cms 8
- c8b881a0 [BUGFIX] Disable output escaping for viewhelpers
- cd18e0ee [BUGFIX] Remove spaceless viewhelper
- be974578 [BUGFIX] gallery in 2 cols also for devices >= 768px and < 992px
- 3a5c5a79 [BUGFIX] use the correct Typoscript constant in setup
- 49abd2e5 [BUGFIX] Correct grunt watch tasks
- 5c64e395 [BUGFIX] Add header to cType List
- 2f4d942f [BUGFIX] Respect sorting for tab items
- 4e1895c3 [BUGFIX] Respect sorting for accordion items
- d2f3858f [BUGFIX] Correct PSR2  issue
- 0e750f0f [BUGFIX] Add missing column overrides for text and textpic content elements
- f59acadd [BUGFIX] Check if content element type exists before merging
- fef0fc6e [BUGFIX] Merge type configuration in TCA instead of overriding
- 9a6506c1 [BUGFIX] Add missing comma in uploads field selection
- 3e87fca5 [BUGFIX] Correct accordion content element markup
- 142a0400 [BUGFIX] Add missing showIconTable setting for field icon
- 003489f6 [BUGFIX] Adjust imagepath and wizard settings for carousel links
- b44bcf36 [BUGFIX] Adapt moved language file
- 2bd94955 [BUGFIX] Add missing renderTypes to tt_content fields
- f460fa78 [BUGFIX] Add missing renderTypes to tab item
- 553f48f7 [BUGFIX] Add missing renderTypes to accordion item
- 39ec0279 [BUGFIX] Add missing renderTypes to carousel item
- 534fa91e [BUGFIX] Correct typoscript paths
- 3ddad628 [BUGFIX] Add missing link for media type image in tabs
- a9bf6dff [BUGFIX] Add missing link for media type image in accordion
- 353e3b50 [BUGFIX] Correct composer branch-alias
- 9bf49a18 [BUGFIX] Make links visible in jumbotron - fixes #248
- 3bef8e04 [BUGFIX] Fix behaviour of strictly allowed RTE classes
- 46f24a1c [BUGFIX] Add the table colspan and rowspan attributes to allowed attributes in RTE configuration
- 0da305fc [BUGFIX] Correct height operator for opengraph image - fixes #227

## MISC

- ce3f8df6 Fix more typos / grammar issues
- 3b25d805 Fix typos found by codespell
- a50ed6e4 Followup: Use spaces instead of tabs
- 62ade32e Fix grammar
- 2edeebce Removed duplicate "List Group" entry
- b917eaef add static to getVariablesFromConstants() because of deprecation notice
- fbbe0cf9 Add crop to carousel background image
- f0966b5a Use settings instead of variables for configuration in FLUIDTEMPLATE
- c596fd73 [WIP] Image rendering
- 663af6aa [WIP] Adjust Tab Rendering
- 01a006c8 [CLEANUP] Bootstrap Package external media item
- 66e3090d [CLEANUP] Bootstrap Package list group item
- ea5db05c [CLEANUP] Rendering definition for default content element
- bec55b68 [CLEANUP] Remove unused header partial
- 1c2db8b7 Add namespace to ext_update class
- 6c19cf4b Update constants.txt
- 57a6a177 Update CssStyledContent.txt
- fddd5e23 Add data-preload to force image preload
- 3205507e Merge remote-tracking branch 'upstream/master'
- 12e6e6e6 [CLEANUP] Remove unused file
- 09711654 [CLEANUP] Correct email in bower setup
- e1df0753 Merge remote-tracking branch 'upstream/master' into disable-meta-section
- 7998c5bd Add mod_filter to apache recommendations
- 7cc4feee [CLEANUP] Correct Readme
- f8475694 [CLEANUP] PSR-2 stuff
- 1cb8469e [CLEANUP] Remove unused use statements in install service
- fba18057 [TROLL] Update copyright text
- 020bf697 [CLEANUP] Initialize fieldsToUpdate in ext_update
- b91e71d1 Merge remote-tracking branch 'upstream/master' into disable-meta-section
- 7f2b9d7a [CLEANUP] Remove unused Hooks and Xclass
- 7897a86e [CLEANUP] Remove TYPO3 6.2 and PHP5.3 and PHP5.4 from Travis CI
- a75a0278 [CLEANUP] Remove unused use statements in realurl autoconfig
- 83088bba bring metaSection enable setting to constants
- fb68e002 Update setup.txt with default meta section enabled
- 100a1084 change Footer.html to disable meta output
- 2cf4e9ba Fixed typos
- aa88fbbc Fixed typos
- db95d9ab Correction of minor typo
- 1b5581d8 Force preload images to allow print
- fbb6fa12 Add useful RTE buttons

## Contributors

- Benjamin Kott
- Benjamin Kott
- Benjamin Kott
- Cedric Ziel
- Ian Excedo
- Markus Dreyer
- Peter Kühn
- Stefan Weil
- Stephan Großberndt
- Steven Strehl
- Sven Burkert
- buffcode
- metaxos
- phvt
- s-leger
- sebastianseidelmann

# 6.2.15

## TASK

- 3e5f00f2 [TASK] Add travis-ci build status image
- f0ef2c5f [TASK] Remove unused coverage from travis
- 50d372c3 [TASK] Add phpcs as dev dependency to composer.json
- 3dc0c1df [TASK] Remove TYPO3 dependencies and conflicts from composer.json
- b103871a [TASK] Add travis-ci support
- 1737339c [TASK] Unify license comment
- aaad7a4f [TASK] Static declaration should come after the visibility declaration
- a8a589e4 [TASK] Apply PSR-2
- 023b9859 [TASK] Add scrutinizer code style fixer for psr-2
- 42381a08 [TASK] Convert tabs to spaces 2
- 82ee78a6 [TASK] Convert tabs to spaces
- 4dac59ff [TASK] Add scrutinizer psr-2 settings
- ab4dcafe [TASK] Add braces in condition
- e4e3e9b0 [TASK] Add code quality section to readme
- 82bae492 [TASK] Add YML to editorconfig
- 756f96ab [TASK] Add scrutinizer configuration
- 6c9570f0 [TASK] Change TYPO3 composer dependency to typo3-cms
- d359261c [TASK] Update less.php to 1.7.0.5

## BUGFIX

- aa587827 [BUGFIX] Ignore PSR-2 check for legacy core classes
- d176687a [BUGFIX] Use camel caps format for functions in external media utility
- f15a896f [BUGFIX] PSR-2 Violations
- 914a4254 [BUGFIX] Add composer self-update to travis
- da8c97d0 [BUGFIX] Correct indention
- 1e798736 [BUGFIX] Use correct assignment for TypoScript value
- b8d89b14 [BUGFIX] Make class.ext_update.php work on PHP 
- 1cf9b927 [BUGFIX] There is no boostrap package

## MISC

- ffe5e3e4 Scrutinizer Auto-Fixes
- 3d6b3427 Scrutinizer Auto-Fixes
- 6bd65dd0 Scrutinizer Auto-Fixes

## Contributors

- Benjamin Kott
- Cedric Ziel
- Scrutinizer Auto-Fixer
- Stefan Neufeind

# 6.2.14

## FEATURE

- 2734c162 [FEATURE] Add advanced Open Graph support, support new meta notation for 7.4

## TASK

- ad9f9282 [TASK] Add migration information for backend layout prefix change
- fc482ca9 [TASK] Add missing changelog for 6.2.12 and 6.2.13
- 5162b178 [TASK] Update TypoScript template mapping for backend layouts
- fe57d19c [TASK] Add update script to migrate old backend layout prefix to new prefix in table pages
- d467590b [TASK] Disable BackendLayoutDataProvider for TYPO3 versions below 7.4 and adapt registration to core provider prefix for PageTS
- b90c08db [TASK] Move column labels for border, normal, left, right to bootstrap_package, files moved in CMS 7
- 99c82668 [TASK] fix whitespaces
- eb23a66f [TASK] Add 'active' class for shortcuts in sub navigation

## BUGFIX

- f0f8c620 [BUGFIX] Use always $GLOBALS[TCA]
- b0bde8ab [BUGFIX] fix missing TYPO3SEARCH_end marker

## MISC

- 04d164d9 Update Index.rst
- 63473434 Rename index.rst to Index.rst
- 9826f5ab Update Index.rst
- bf873ff4 Create index.rst

## Contributors

- Anja Leichsenring
- Benjamin Kott
- Benjamin Kott
- Ian Excedo
- Philipp Roski
- s-leger

# 6.2.13

## TASK

- 4f031d5d [TASK] Include css_styled_content and form in static template

## BUGFIX

- 92c7c219 [BUGFIX] Remove leading slash from classnames in typoscript setup
- 287e8df7 [BUGFIX] Restrict options for default tab to currently assigned items - fixes #197

## MISC

- 76a411b0 Fix 'overridden' typos
- e27b03e4 Multiple fixes to composer.json
- e141e230 Fix whitespace in ext_emconf.php

## Contributors

- Benjamin Kott
- Benjamin Kott
- Florian Fida
- Helmut Hummel

# 6.2.12

## BUGFIX

- 9347264e [BUGFIX] Add missing static template for bootstrap package

## Contributors

- Benjamin Kott

# 6.2.11

## BREAKING

- 987c2032 [!!!][TASK] Remove compatibility to ext:themes through lack of resources
- 4b16e85f [!!!][TASK] Cleanup deprecated template fallbacks
- 20ec25cf [!!!][FEATURE] Add template fallback support
- 729e9667 [!!!][BUGFIX] Wrong path to font files - fixes #139
- c43a35e4 [!!!][TASK] Make less files public available
- 305139fc [!!!][TASK] Move lightbox implemantation to a own file and remove main.js
- f0bee946 [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup
- 3f8f04c6 [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3
- 1f861227 [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186

## FEATURE

- 20ec25cf [!!!][FEATURE] Add template fallback support
- 45ffc2c6 [FEATURE] Make DynamicContent wrappable
- 94b74d51 [FEATURE] Add swipe support for carousels - fixes #161
- 1c50ebcf [FEATURE] Add new page type for popup usage without header and footer typeNum 1000 - fixes #70
- 8975391d [FEATURE] Enable support in lib.dynamicContent to support content from pid - fixes #185
- 78c19a7b [FEATURE] Make breadcrumb enable treelevel configurable - fixes #191
- aa242026 [FEATURE] Add TypoScript TYPO3 version condition
- 13d4410a [FEATURE] Add selectivizr to add CSS3 pseudo selector support to IE8
- 1f861227 [!!!][FEATURE] Support multilevel tree in subnavigation - fixes #186
- 8a1f1837 [FEATURE] Add carousel type backgroundimage - #188
- 224287ab [FEATURE] Make carousel header layout configurable - #188
- 7d2c7c9c [FEATURE] Add CSS status classes to content wrappers - #fixes 85
- 993eb4f6 [FEATURE] Add tab content element
- 02ec26fb [FEATURE] Add external media content element for youtube and vimeo videos
- 77639ab9 [FEATURE] New advanced constant to enable/disable CSS source mapping

## TASK

- ed01b96e [TASK] Update Documentation for TypoScript constants
- 0eeeac64 [TASK] Update Documentation
- 987c2032 [!!!][TASK] Remove compatibility to ext:themes through lack of resources
- 13ac5ee6 [TASK] Use TCA renderTypes - fixes #192
- 4b16e85f [!!!][TASK] Cleanup deprecated template fallbacks
- 2f207e70 [TASK] Copy Bootstrap font files during build process
- 27d47b7a [TASK] Update Bootstrap to 3.3.5
- c43a35e4 [!!!][TASK] Make less files public available
- 0e48e798 [TASK] Use absRefPrefix = auto instead of baseURL in TYPO3 CMS 7
- 0d727e22 [TASK] Add application context examples to .htaccess file
- 305139fc [!!!][TASK] Move lightbox implemantation to a own file and remove main.js
- 882bfb50 [TASK] Add hires extension icon
- f0bee946 [!!!][TASK] Make navbar toggle button compatible with bootstrap default markup
- a8aed629 [TASK] Add grunt watcher for JavaScript files
- ad3b9928 [TASK] Add RespondJs to Bower
- 3f8f04c6 [!!!][TASK] Use version number independent filename for jQuery and update to v1.11.3
- 40e41071 [TASK] Include bootstrap with Bower and Grunt
- a761175d [TASK] Add Grunt uglify for JavaScripts
- d8881b36 [TASK] Add initial Grunt setup for RTE and precompiled theme
- db6a5c30 [TASK] Add less variables file to bootstrap theme
- 3c4cec5e [TASK] Unify namespace name in templates
- 328e3596 [TASK] Make ContextualClassViewHelper compilable
- a233f389 [TASK] Make FalViewHelper compilable
- fb7f968a [TASK] Make ExternalMediaViewHelper compilable
- 95d83e96 [TASK] Make VarViewHelper compilable
- 92eafd19 [TASK] Make ExplodeViewHelper compilable
- 9e2c3f1e [TASK] Make DataRelationViewHelper compilable
- fc62a800 [TASK] Remove leftover FormEngineViewHelper
- bd5d285f [TASK] Make FlexFormViewHelper compilable
- b15ee411 [TASK] Update jquery.responsiveimages.js
- 09434679 [TASK] Reintroduce css class for first headline in column rendering
- 9ba2483b [TASK] Move custom content element renderings to typoscript folder
- 848ec4ef [TASK] Cleanup extension declaration file to match documentation
- 6767c334 [TASK] Add individual icons for content elements in wizard
- 35a6156f [TASK] Added missing description to Bootstrap elements
- 7d6e5fc7 [TASK] Add field subheader to header palette of tt_content
- ea2a5296 [TASK] Remove csc-firstHeader CSS class in lib.stdHeader
- 473ccd24 [TASK] Use references instead of hard copies in lib.stdheader
- c2367fdc [TASK] Use ExtensionManagementUtility in autoload.php - fixes #172
- 791356db [TASK] Update bootstrap to 3.3.4

## BUGFIX

- e84055e3 [BUGFIX] Add disablePageTsRTE option to extension configuration again
- 729e9667 [!!!][BUGFIX] Wrong path to font files - fixes #139
- 10a0d604 [BUGFIX] Correct overflow problem
- 9273d3e8 [BUGFIX] Deprecation of page.includeJSlibs in TYPO3 CMS 7
- 566968ec [BUGFIX] Ensure column CSS class is also set for imagecols set to 1 - fixes #138
- 9be58651 [BUGFIX] Set BackendLayouts columns correctly if PageTs is set via page record
- 61a3fc85 [BUGFIX] Section Index content item produces incorrect links - fixes #150
- bf4b1815 [BUGFIX] Correct OnePage Markup
- c6f65941 [BUGFIX] Add missing restore register in text with icon - fixes #174

## MISC

- 825d4b26 slightly smarter TypoScript
- 193983b8 FLUIDTEMPLATE.templateName and templateRootPaths
- a066650a Update jquery.responsiveimages.js
- 10f0fbcb Collision with jQuery width and height methods
- 7ee19d4b Update jquery.responsiveimages.js
- 8fddd3b1 Update jquery.responsiveimages.js
- 496e017d Update jquery.responsiveimages.js
- a2bf2d30 Update jquery.responsiveimages.js
- b0a54d66 Event optimisation
- cdefdf81 Fine tune jquery.responsiveimage.js
- 36b97037 Update jquery.responsiveimages.js
- fe803ca5 Update jquery.responsiveimages.js
- 3ab416b1 Update jquery.responsiveimages.js
- fcef312b Fix indents in tab feature

## Contributors

- Benjamin Kott
- Benjamin Kott
- Harry Glatz
- Ian Excedo
- Konstantin Krauter
- s-leger
- till busch

# 6.2.10

## FEATURE

- e01b136d [FEATURE] New advanced constant to enable/disable the use of Typoscript constants as Less variables
- a7544c25 [FEATURE] new constant $page.logo.alt used to overwrite the default alt attribute of the logo image
- 5e1d06f6 [FEATURE] make site logo alt attribute configurable
- 1eef6627 [FEATURE] Disable automatic less compiling - fixes #162

## TASK

- 2d3dc52c [TASK] Add changelog
- 0f90334b [TASK] Refactor jquery.responsiveimages.js
- 604ea24e [TASK] HTML5 markup for sub navigation - fixes #171
- 20333053 [TASK] Make RealUrl autoconfig compatible with the version from Helmut Hummel for 7.x
- c3e76016 [TASK] Protect configuration of extensions in default .htaccess
- a598a4df [TASK] Remove migration of realurl in favor of Helmut Hummels release for TYPO3 CMS 7.2
- 39d46854 [TASK] Carousel: allow to set the max width of background images
- c29b6227 [TASK] Update oyejorge/less.php to 1.7.0.3
- 35b81ccf [TASK] Remove automatic cache clearing - fixes #126
- 7e746fd6 [TASK] Add slack to contact and communication
- 29b666b5 [TASK] replaced  with 
- 761bd5c7 [TASK] Add admin panel config to typoscript constants
- 88139537 [TASK] Update changelog in documentation

## BUGFIX

- 4cce784c [BUGFIX] Correct overlapping elements on centered image - fixes #113, #159
- 0af8bc02 [BUGFIX] Correct media display for file links content element - fixes #164
- b5776a1c [BUGFIX] fix for HTML5 markup validation
- e6c0cf9f [BUGFIX] Missing container in default clean layout
- 863615c6 [BUGFIX] Adjust language uids to match introduction database - fixes #135

## MISC

- 9aef5248 Stop using deprecated XHTML cleaning
- 653bd30a Allow "target" attribute inside  tags.
- a44d88f1 added "br" to "allowedTags"
- a7a74f0c [CLEANUP] Correct indention to CGL
- 4aa5c42a Modified footer and header
- e57bc95e [Bugfix] fixes sorting on localized relations
- fe208bdc Update FalViewHelper.php
- 7769afed [Bugfix] FalViewHelper.php
- 697bedc4 Update Base.ts

## Contributors

- Benjamin Kott
- Benjamin Kott
- Carla
- Christopher
- Ian Excedo
- Marco Ziesing
- R B
- Thomas Löffler

# 6.2.9

## TASK

- e8822fce [TASK] Update jquery to 1.11.2
- 559ff0c8 [TASK] Update modernizr to 2.8.3
- d065a0be [TASK] Update less.php to current master
- 70249bf3 [TASK] Throw exception on less compile error
- c056ffd9 [TASK] Rise dependency of TYPO3 and css_styled_content version to 7.99.99
- 4d78373c [TASK] Add backend skin changes to the documentation
- 7d9fb372 [TASK] Use realurl autoconfig hook instead of overriding every config

## BUGFIX

- c7d64280 [BUGFIX] Remove problematic whitespace
- 115a9d58 [BUGFIX] Remove superfluous slash in font definition - fixes #132
- 095c2a17 [BUGFIX] Classname must not start with a backslash in ext_conf_template.txt

## MISC

- 4660037b Update Index.rst
- ca4d0322 Use array_merge_recursive() instead
- 18f1ca82 Don't overwrite existing configuration completely

## Contributors

- Aimeos
- Benjamin Kott
- Benjamin Kott
- Cedric Ziel
- buxit

# 6.2.8

## TASK

- 6f92339a [TASK] Make realurl optional
- b162f602 [TASK] Remove e-mail from contact
- f8ad4af7 [TASK] Minify responsiveimages.js and and cleanup
- c1956cf1 [TASK] Cleanup CGL
- aebd1fcd [TASK] Make removeDefaultJs configurable. fixes #105

## BUGFIX

- 21735bde [BUGFIX] Use correct rte transform in accordion textfield - fixes #67
- 146a8659 [BUGFIX] Wrong calculation in news pagination - fixes #106
- f0508a9d [BUGFIX] Flashmessage queue throws error while installing - fixes #116

## MISC

- 94a1a165 Update newContentElement.txt
- c7e27ab8 Update newContentElement.txt
- e40750d9 Update jquery.responsiveimages.js

## Contributors

- Benjamin Kott
- Benjamin Kott
- Oliver Meckel
- s-leger

# 6.2.7

## TASK

- 66ce0a66 [TASK] Include respond.js with conditional comment to work with static cache - fixes #101
- b5cd79d2 [TASK] Cleanup CGL
- 7a86c368 [TASK] Reformat all project-specific content to TYPO3.CMS CGL
- 6541519a [TASK] Make getCompiledFile a static method - fixes #103 #104
- 279601a6 [TASK] Deprecate backend skin for CMS7 and provide new logos
- c000a5bf [TASK] Carousel needs to have background-image and background-color at the same time available
- cf164b64 [TASK] Add .editorconfig file

## BUGFIX

- 5e0d2741 [BUGFIX] Wrong colpos was used in layout "Default, Subnavigation Left and 2 Columns" fixes #98

## MISC

- 14d4eb34 Fix for columns in backend layout
- 7b676ed6 Add 25/75 backend layout
- cd232393 Add missing migrations for realurl
- 880b198b Add migrations for realurl to be compatible with CMS 7.0
- 614a1eb9 Remove unused template variable - fixes #93
- df58daa6 typo
- 884dc404 Updated RTE configuration. Implemented a workaround to get enableWordClean work again.
- 7aebd4e1 Finish Hotfix-lead-text
- c0f69b38 Fixes Lead text in RTE that is not saved cause not in allowedClasses

## Contributors

- Aimeos
- Benjamin Kott
- Benjamin Kott
- Cedric Ziel
- Dennis Rheinfelder
- Exapoint Solutions AG
- Ian Excedo
- Stefan Froemken

# 6.2.6

## FEATURE

- 2c668813 [FEATURE] add composer.json

## MISC

- 26b6ed91 Release 6.2.6
- 51f177e3 Correct colPos for left column on Layout: Default, Subnavigation Left and 2 Columns - fixes #62
- f8ff29b3 Add Google Analytics tracking code anonymization - fixes #84
- 1b9b1c5e Adjust processing rules for rte
- be860ade Add missing styling for rte table contextual classes
- 7540ed6a Enhance accessibility for the accordion
- 1217a36e Describe and enhance rte config, tables are now responsive by default, css classes have translations now
- 23bec274 Fix role="main" position in 2 columns layout.
- 2784053b Add backend layout with 2 columns 50/50%
- 9b2c649d Use DIR option instead of FILE to include backend layouts.
- 8e5cfe13 Remove superfluous text "Bootstrap Package: " from layouts names.
- e4529ffd Exclude page also from search engine index if no_search is set to the page - fixes #69
- 0db789b2 Enhance accessibility for the carousel
- f32ea4ae Adjustments to skip to content - resolves #63
- 71163c16 Add marker for current year. Move replacements directly to the fluidtempalte - fixes #72
- 706df22c Add missing alt and title attributes on noscript fallback for image rendering - fixes #77
- e8214f8e TASK: Skip to content Resolves https://github.com/benjaminkott/bootstrap_package/issues/63
- e3c8ba0c Update bootstrap css file for the backend to 3.3.0
- 6e317ce4 Adjust gitignore
- de9f8ca0 Remove the automatic appending icons for content links
- f20efcf0 Fix navbar-brand-image position
- 9938953f Fix Carousel fading in chrome
- 5091bd83 Update Bootstrap to version 3.3.0
- 618350db Display Problems in IE8 for "width: 100% \9;"
- 84a357f1 Move css files for the backend to avoid missunderstandings and add plain default bootstrap.min.css - fixes #61
- 7dbb159a Adjust language menu for smaller viewports - #65
- bd77e0a0 Adjust font-size and line-height for better readability
- 1d697bc3 We are always stable ;)
- eb9a85e0 Backendskin is not disabled correctly if option is set
- 5474be4b Add backend layouts for left navigation - fixes #62
- 1f1ac900 Adjust carousel - fixes #51
- 3886f279 Add missing space in news date format - fixes #59
- bb491586 Add caption alignment - fixes #58
- e7a23a26 Fix small typo
- 13498efd Cleanup configuration for indention frames - fixes #57
- a5720c9c Cleanup RTE config
- b77c4ce6 Cleanup Tabs #52
- 9035ae18 Remove forgotten typoscript code for searchbar and login - #50
- 17695a1c Set cache period to 24h - fixes #55
- 242d37f0 Correct linkToTop rendering - fixes #54
- b44573a1 Correct composer.json
- b3196163 Move PARAMS before SOURCECOLLECTION for better HTML code readability.
- 8b2704cd Move img class to params for easier customization.
- aa7d6de8 Add basic google analytics settings
- ddd18ee7 Provide open graph image for social networks
- 672bd9cf Cleanup flip ahead browsing for IE
- 5b12351b Correct dependency to TYPO3 version to ensure that the correct forms are loaded
- e3c3bb94 Update composer.json
- 31a8d99b Fix dynamic rewrite base
- e0cd37b4 Implement a dynamic rewrite base solution reduce problems with some hosters
- 0375b126 Remove some image orient fields to avoid distraction
- b6f1da7c Remove unused link for the image in text with image - fixes #49
- e8e33893 Avoid error if data for lib.dynamicContent is not provided as array
- e8cd26a3 The title attribute remains empty in mainmenu of onepage variant - fixes #44
- 7631b768 Allow link tag usage in html content element
- fbe94f93 Split theme less file
- d64540c6 Add new clean backend layout
- 354bd9d2 Add styling constants for ext:themes
- c02611bf Provide options to disable parts of the auto included PageTs settings
- 291515cd Cleanup
- 676034fd Make Bootstrap Package run as a OnePage Website
- c17e975f fix 'Boostrap' typos

## Contributors

- Benjamin Kott
- Benjamin Kott
- Chris Rebert
- Felix Oertel
- Ian Excedo
- SventB

# 6.2.5

## FEATURE

- 187c8581 [FEATURE] use SymLinksIfOwnerMatch in .htaccess

## MISC

- c86a3480 Release 6.2.5
- 966bd586 Update Documentation
- 858253eb Add support for link "Edit me on Github"
- d2484b99 Fix workspace problem for related records #37
- 45db7c4e Make main navbar position configurable
- 9aec7779 Combine less files to avoid dublicate css definitions
- 3d72ea3d Allow Backend Layouts to be configured via PageTsConfig
- 1f50d81f Cleanup less.php integration - fixes #32
- 60f71fc3 Correct display of tx_form - hopefully
- dc732035 Correct type of baseURL typoscript constant
- bd33fa10 Correct default icon-font-path to avoid problems if page is deployed in a folder - fixes #31
- 1f78758f Update jQuery version to 1.11.1
- e2e19f65 Disable imageheight and imagewidth for textpic and image content elements to avoid wrong rendering
- 16a6f996 Avoid problems with hardcoded resource links in login template, remove overriding - fixes #28
- d9b5c101 Correct label definitions for content elements, $_EXTKEY is not available here - fixes #27
- 605db345 Add conflict to dyncss to ensure correct less rendering
- 53251485 Cleanup spaces
- 4cbf85f7 Images displayed in one column have no restriction to current layout column - fixes #19
- adef7ece Update Bootstrap to 3.2.0
- 58180a16 Correct file locations
- 25fce394 Fix bootstrap less compiler if flattensetup is not available - fixes #20
- e55d0f17 Cleanup bootstrap file locations
- f016b287 Move bootstrap js to separate folder
- 538ef39c Removing symlink option due problems on windows apache with symlinks - affects #25
- 46147ae2 Add missing default variables file for bootstrap
- 2f0b0cea Remove backend style module - introduce typoscript constants instead to provide a more flexible less configuration - fixes #5 #20
- 4160b7aa Update less.php
- c6cfb0ed Move TCA
- 18e5cb33 Text and image - center top was not centered - fixes #21
- 80993edb Add missing bodytext field to carousel "text and image" and enable rte for accordion - fixes #23
- a164e5a1 Allow table in RTE
- ed55a6fc Adjust LogoView to make it a bit more secure
- e8a32c06 added fluidpages to conflicts fixes #18
- 2967c55a Add link to the complete teaser item and fix the relations
- dfa694ca Fix typo
- 2ef1c553 Make it possible to enable backend skin if themes is loaded.
- fdfa43af Make bootstrap_package compatible with themes (part 2)
- 661886df Correct version number
- 1e422c8b Cleanup formatting
- 77414e69 Make bootstrap_package compatible with themes (part 1)
- a8879cda Correct types in constants
- 55b24006 Add TYPO3 version to sitename in backend header
- d97a9d43 Correct wizard registration
- 55e18f4a Add links for carousel images in FE, optimize fal fields. fixes #15
- 342917cb Update Accordion.html
- 971cc247 add missing text_color field to carousel textwithimage #10
- 5e1bb9c6 carousel interval and wrap needs to be configurable #10
- daff0c1c wrong label for header in carousel textwithimage #10
- 331e51fa cleanup wrong committed stuff before
- fc3b6b8d - cleanup wrong formatting in base.ts - add chash for pagination to prevent cashing issues described in #9

## Contributors

- Benjamin Kott
- Benjamin Kott
- Benjamin Kott
- Felix Oertel
- Gökhan Sirin

# 6.2.4

## MISC

- 52370906 ter does not allow long version numbers ...
- a4608ef1 ter ist fucking up ;(
- c7aaf3c8 set version to 6.2.2.2
- a3fb4c45 Add Basic Documentation
- 54518d62 correct version to 6.2.2.1 and adjust description
- 84c7b738 Hide navigation toggle if no subpages exist.
- a57cbc3f Fix the height of the header if no subpages available
- da841fe4 Provide an example .htaccess file after installation - fixes #3
- 72dbbaec tabs and spaces ...
- d3bf38b1 Remove absRefPrefix und add automatic baseURL determination instead. This will ensure that the links and pages are correct if you are running TYPO3 in a subfolder.
- 3bbfa467 Change README to .rst format. Change spelling and wording.
- b79952aa Change README to .rst format. Change spelling and wording.
- 4e6ccbc2 image fix IE
- 4f906769 set version to 6.2.3 for further development
- c407babd cleanup main.js
- 66d905d6 remove rootpage id from realurl due complication with import
- 95e1772c Make absRefPrefix configurable, this is needed when typo3 is running in a subfolder
- 65aac304 set version to 6.2.2 for further development
- 174e9fb7 Remove generated variables from repository
- 93f4c39f Add RealUrl Config
- 27e6edcb Update description
- 1667b223 Update README.md
- 536466a9 set version to 6.2.1 for further development
- 31783df8 set version to 6.2.0 - initial release in ter
- eecd180a RC 6.2
- 8a43508f Initial commit

## Contributors

- Benjamin Kott
- Benjamin Kott
- Martin Bless

