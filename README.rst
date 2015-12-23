==================================================
Bootstrap Package
==================================================

Bootstrap Package delivers a full configured frontend
theme for TYPO3, based on the Bootstrap CSS Framework.

The goal of this package is to give an advanced example of how modern templating
in TYPO3 CMS can be handled nicely without depending on third party extensions.
Bootstrap Package is built for >= 7.6 and comes with a fully configurable Frontend
via TypoScript. This includes the TypoScript Constant Editor.

Minimal Dependencies
====================

* TYPO3 CMS 7.6 or greater

Quick Install Guide
===================

Disable default content rendering extensions 
--------------------------------------------

Both TYPO3 core rendering definitions are confliction each other in minor things,
to avoid this conflicts the bootstrap_package takes full control of the content
rendering and supports both cTypes from csc and fsc. To get the best results,
please disable following extensions.

* css_styled_content
* fluid_styled_content

Make sure you have a root page
------------------------------

Create a new page or edit an existing one and set this as *root page*.
You can find this option in the page-edit-mode filed under behavior/miscellaneous.

Create a new Template on this Page
----------------------------------

General
~~~~~~~

* Template Title: You can name this as you like: Example "Bootstrap Package"
* Website Title: This will be your website title visible in the frontend

Options
~~~~~~~

* Clear Constants and Setup by checking the boxes
* Use this Template as Root-Level Template by checking the box

Includes
~~~~~~~~

Include static (from extensions)

* Bootstrap Package (required)


Recommended Apache Modules
~~~~~~~~~~~~~~~~~~~~~~~~~~

* mod_autoindex
* mod_alias
* mod_deflate
* mod_expires
* mod_filter
* mod_mime
* mod_headers
* mod_setenvif
* mod_rewrite


Usage
=====

Contributing
------------

Feel free to fork this project and create a pull request when you're happy
with your changes.

Bug reporting
-------------

Please open an `issue here at github`__ and describe your problem.

__ https://github.com/benjaminkott/bootstrap_package/issues

License
-------

This project is released under the terms of the `MIT license <http://en.wikipedia.org/wiki/MIT_License>`_.

Contact & Communication
=======================

Slack
-----

You can connect directly with us on `Slack <https://typo3.slack.com/messages/bootstrap-package/>`_, the
prefered instant communication platform of TYPO3 CMS developers. If you already have access to the
TYPO3 Slack platform join the #bootstrap-package channel. If you don't have access yet, you can
register `here <https://forger.typo3.org/slack>`_.

Twitter
-------

If you have any questions about this project or just want to talk:
Send a tweet `@benjaminkott <https://twitter.com/benjaminkott>`_.

Code Quality
============
.. image:: https://travis-ci.org/benjaminkott/bootstrap_package.svg?branch=master
   :alt: Build Status
   :target: https://travis-ci.org/benjaminkott/bootstrap_package

.. image:: https://scrutinizer-ci.com/g/benjaminkott/bootstrap_package/badges/quality-score.png?b=master
   :alt: Scrutinizer Code Quality
   :target: https://scrutinizer-ci.com/g/benjaminkott/bootstrap_package/?branch=master
