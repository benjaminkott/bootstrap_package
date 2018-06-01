==================================================
Bootstrap Package
==================================================

.. image:: Documentation/Images/Screens/typo3-frontend.png?raw=true
   :alt: Bootstrap Package

Bootstrap Package delivers a fully configured frontend
theme for TYPO3, based on the Bootstrap CSS Framework.

The goal of this package is to give an advanced example of how modern templating
in TYPO3 CMS can be handled nicely without depending on third party extensions.
Bootstrap Package comes with a fully configurable Frontend via TypoScript. This
includes the TypoScript Constant Editor.

Minimal Dependencies
====================

* TYPO3 CMS 8.7 or greater

Quick Install Guide
===================

Disable default content rendering extensions
--------------------------------------------

You do not need to have Fluid Styled Content or CSS Styled Content installed, we
have currently marked both extensions as conflicting to avoid misconfiguration.

If you really know what you are doing, it is safe to use core content rendering
definitions alongside with the Bootstrap Package. But please be aware that we are
adding more content elements that are not supported from those extensions.

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
* Clear the  predefined TypoScript setup from the textbox if any
* Use this Template as Root-Level Template by checking the box

Includes
~~~~~~~~

Include static (from extensions)

* Bootstrap Package (required)

Static Template Files from TYPO3 Extensions

* Include before all static templates if root flag is set


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

We check the source code according to the TYPO3 Coding Guidelines. To reformat
the code automatically, you can use `php-cs-fixer` as follows:

.. code-block::

   php-cs-fixer fix

Bug reporting
-------------

Please open an `issue here at github`__ and describe your problem.

__ https://github.com/benjaminkott/bootstrap_package/issues

License
-------

This project is released under the terms of the `MIT license <https://en.wikipedia.org/wiki/MIT_License>`_.

Test the Bootstrap Package
==========================

If you are interested in the Bootstrap Package you can test it in our
`Vagrant Box <https://github.com/benjaminkott/bootstrap_package_box>`_.

Contact & Communication
=======================

Slack
-----

You can connect directly with us on `Slack <https://typo3.slack.com/messages/bootstrap-package/>`_, the
preferred instant communication platform of TYPO3 CMS developers. If you already have access to the
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
