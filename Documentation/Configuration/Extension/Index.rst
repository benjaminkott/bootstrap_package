.. include:: /Includes.rst.txt

.. _extension-configuration:

=======================
Extension Configuration
=======================

The Bootstrap Package provides extension configuration options that can be
adjusted in the TYPO3 backend under :guilabel:`Admin Tools > Settings > Extension Configuration`.


Features
========

.. confval:: disableCssProcessing
   :name: extension-disableCssProcessing
   :type: boolean
   :default: false

   Disable processing of CSS files.

   .. warning::

      If enabled, there will be no automatic processing of SCSS files in the
      frontend. You will need to provide CSS files instead or handle the
      processing of the SCSS files yourself.

.. confval:: disableGoogleFontCaching
   :name: extension-disableGoogleFontCaching
   :type: boolean
   :default: false

   Disable local Google Font cache. If enabled, Google Fonts will not be cached
   on the server.
