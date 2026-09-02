.. include:: /Includes.rst.txt

.. _image-rendering:

===============
Image Rendering
===============

Bootstrap Package comes with a very flexible responsive image rendering and
supports multiple variants for various device sizes. Each variant defines the
**break point**, **width** and the optional **sizes** for high resolution image
support.

**Table of Contents:**

.. contents::
   :backlinks: top
   :class: compact-list
   :depth: 2
   :local:



Image Variants
==============

Image variants are used to represent the breakpoints of the design. These
variants have to be defined according the definitions in the style sheet.
Bootstrap Package defines these variants by default:

.. code-block:: typoscript

   lib.contentElement.settings.responsiveimages.variants {
       default {
           breakpoint = 1200
           width = 1100
       }
       large {
           breakpoint = 992
           width = 920
       }
       medium {
           breakpoint = 768
           width = 680
       }
       small {
           breakpoint = 576
           width = 500
       }
       extrasmall {
           breakpoint = unset
           width = 374
       }
   }


The **breakpoint** defines the minimal device width where the **width** gets
applied. Having a device with a width of 1200 pixels or more uses an image width
of 1100 pixels, devices of 992 up to 1199 pixels width use an image width of
920 pixels and so on.


For each of these variants the multiplier of size **1x** is set to 1, see next
section for more about the high-resolution image support:

*  default

   *  breakpoint
   *  width
   *  sizes

      *  1x

         *  multiplier: 1


Example of changing the default configuration for the default variant.

.. code-block:: typoscript

   lib.contentElement.settings.responsiveimages.variants {
       default {
           breakpoint = 1200
           width = 1100
       }


High Resolution Images
----------------------

There is a key called sizes in every variant that should be rendered. This
dataset consists of several entries, each with a default key for a normal
rendering (1x). This key will be added automatically, and it is always available.
It is not possible to store sizes smaller than 1. Each size contains a
multiplier, which is multiplied by the base size.

Example calculations:

Base width: 1000px

*  Minimum Device Pixel Ratio = 1

   *  Multiplier = 1
   *  Result: 1000px

*  Minimum Device Pixel Ratio = 1.5

   *  Multiplier = 1.25
   *  Result: 1250px

*  Minimum Device Pixel Ratio = 2

   *  Multiplier = 1.5
   *  Result: 1500px


Example configuration to enable high-resolution support for the default variant
for devices with a minimum device pixel ratio from 1.5 and 2.

.. code-block:: typoscript

   lib.contentElement.settings.responsiveimages.variants {
       default {
           sizes {
               1\.5x {
                   multiplier = 1.5
               }
               2x {
                   multiplier = 2
               }
           }
       }
   }

The data for image rendering is now extended with a sub-set for high-resolution
variants. If you did not overwrite the default templates, it will just work as
soon as you add the configuration. If you have overwritten the default
templates, it will still work as before, but you need to add the new support for
high-resolution images yourself.

Please check the new updated templates and adjust your code if you want this
support.


Configuration by Variant
------------------------

For each **variant** the following configuration options are possible:

*  breakpoint
*  width
*  aspectRatio
*  sizes


Configuration by Backend Layout
-------------------------------

For each **backend layout** the following configuration options are possible
for each defined **column** and **variant**:

*  multiplier
*  gutters
*  corrections


Example configuration for backend layouts.

.. code-block:: typoscript

   lib.contentElement.settings.responsiveimages.backendlayout {
       my_layout {                # this is the BE layout
           0 {                    # this is the column to be modified
               multiplier {
                   default = 0.75
                   large = 0.75
               }
               gutters {
                   default = 40
                   large = 40
               }
               corrections {
                   default = 25
                   large = 25
               }
           }
       }
   }


Configuration by Content Element
--------------------------------

For each **content element** the following configuration options are possible
for each defined **variant** or **specific property**:

*  multiplier
*  gutters
*  corrections


Example configuration for content elements.

.. code-block:: typoscript

   lib.contentElement.settings.responsiveimages.contentelements {
       my_content_element {       # this is the content element
           my_custom_property {   # this is a content element specific property, depends on the implementation and is optional
               multiplier {
                   default = 0.5
                   large = 0.5
                   medium = 0.5
               }
               gutters {
                   default = 24
                   large = 24
                   medium = 24
               }
               corrections {
                   default = 25
                   large = 25
                   medium = 25
                   small = 50
                   extrasmall = 50
               }
           }
       }
   }


Configuration options explained
-------------------------------

Options for variants:

+---------------+-----------+-------------------------------------------------+
| Property      | Data Type | Description                                     |
+===============+===========+=================================================+
| breakpoint    | integer   | Defines the minimal width in pixels of the      |
|               |           | device                                          |
+---------------+-----------+-------------------------------------------------+
| width         | integer   | Defines the effective width in pixels for       |
|               |           | images for this variant                         |
+---------------+-----------+-------------------------------------------------+
| aspectRatio   | float     | Optional, defines the default aspect ratio      |
|               |           | which will override all previously defined      |
|               |           | ratios on image level                           |
+---------------+-----------+-------------------------------------------------+
| sizes         | array     | Optional, defines the available high resolution |
|               |           | image multiplier for a minimal device pixel     |
|               |           | ratio per variant                               |
+---------------+-----------+-------------------------------------------------+


Options for backend layouts and content elements:

+---------------+-----------+-------------------------------------------------+
| Property      | Data Type | Description                                     |
+===============+===========+=================================================+
| multiplier    | integer   | The width is multiplied with this value         |
+---------------+-----------+-------------------------------------------------+
| gutters       | integer   | This value is added to the width before         |
|               |           | applying the multiplier and substracted         |
|               |           | afterwards                                      |
+---------------+-----------+-------------------------------------------------+
| corrections   | integer   | This value is added as last step to the width   |
|               |           | after all other calculations                    |
+---------------+-----------+-------------------------------------------------+


The options **gutters** and **corrections** are needed if you want to be pixel
perfect. Means if you have a 1 pixel outline for example and want this to be
subtracted from the width you can do this kind of corrections late in the
calculation process.

*  Example `Accordion <https://github.com/benjaminkott/bootstrap_package/blob/master/Configuration/TypoScript/ContentElement/Element/Accordion.typoscript#L44>`__:
   Here a correction is added to remove the inner padding of the container.

*  Example `Card Group <https://github.com/benjaminkott/bootstrap_package/blob/master/Configuration/TypoScript/ContentElement/Element/CardGroup.typoscript#L50>`__:
   The border is substracted here.



Resolving Variants in PHP
=========================

Everything above is applied by the content element layout, which
serves every element rendered through a template of this package. An
Extbase plugin registered as a content element does not go that way:
it is rendered through ``Generic.html``, which hands off to
``tt_content.<CType>.20`` via ``f:cObject``. That call carries
``data`` and ``table`` and nothing else, so the variants the layout
calculated never reach the plugin's own rendering context, and an
image rendered there falls back to whatever width its template hard
codes.

:php:`ContentElementVariantsService` answers the same question in
PHP. Inject it and hand it the settings together with the content
object of the element:

.. code-block:: php

   use BK2K\BootstrapPackage\Service\ContentElementVariantsService;
   use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

   final class TeaserController extends ActionController
   {
       public function __construct(
           private readonly ContentElementVariantsService $service,
       ) {
       }

       public function listAction(): ResponseInterface
       {
           $cObj = $this->request->getAttribute('currentContentObject');
           if (!$cObj instanceof ContentObjectRenderer) {
               return $this->htmlResponse();
           }

           $variants = $this->service->getVariants($settings, $cObj);
           // ...
       }
   }

``$settings`` is the plain array below
``lib.contentElement.settings.responsiveimages``. Read it from the
full TypoScript through the configuration manager and convert it with
:php:`TypoScriptService::convertTypoScriptArrayToPlainArray()`.

What comes back is narrowed the way the layout narrows it: first by
the backend layout column the element sits in, then by every
container wrapped around it. An element in a container inside a page
column arrives at the width of the box it actually occupies.

An element that narrows further on its own — a grid with a column
count, a layout that puts the image beside the text — applies those
steps with :php:`narrow()`, which takes a configuration block of the
same shape as the ones above:

.. code-block:: php

   $columns = $settings['contentelements']['my_element']['columns'];
   $variants = $this->service->narrow($variants, $columns['3'] ?? null);

Passing :php:`null` returns the variants unchanged, so a step that is
not configured needs no branch around it.

.. note::

   The service resolves the box, not the markup. Turning the variants
   into a ``srcset`` and a ``sizes`` attribute, or into ``picture``
   and ``source`` elements, stays with the template that renders the
   image.


Crop Variants
=============

The Bootstrap Package predefines some cropping variants which can easily be changed
or extended by your sitepackage.

The following crop variants are defined by default:

*  16:9, for a fixed ratio
*  4:3, for a fixed ratio
*  1:1, for a fixed ratio
*  NaN, for a free ration
