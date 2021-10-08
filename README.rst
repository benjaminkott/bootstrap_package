==================================================
Bootstrap Package
==================================================

.. image:: Documentation/Images/Screens/typo3-frontend.png?raw=true
   :alt: Bootstrap Package

Bootstrap Package delivers a fully configured frontend
theme for TYPO3, based on the Bootstrap CSS Framework.

The goal of this package is also to give an advanced example of how modern templating
in TYPO3 CMS can be handled nicely without depending on third party extensions.
Bootstrap Package comes with a fully configurable Frontend via TypoScript. This
includes the TypoScript Constant Editor.

Minimal Dependencies
====================

* TYPO3 CMS 10.4 or 11.5 for Bootstrap Package 12.x
* TYPO3 CMS 9.5 or 10.4 for Bootstrap Package 11.x
* TYPO3 CMS 8.7 or 9.5 for Bootstrap Package 10.x, 9.x and 8.x
* TYPO3 CMS 7.6 for Bootstrap Package 7.x

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

Documentation
-------------

* `Wiki <https://github.com/benjaminkott/bootstrap_package/wiki>`_
* `Documentation <https://docs.typo3.org/p/bk2k/bootstrap-package/master/en-us/>`_

Contributing
------------

Feel free to fork this project and create a pull request when you're happy
with your changes. We check the source code according to the our Coding Guidelines.
To reformat the code automatically, you can use ``php-cs-fixer`` as follows:

.. code-block::

   composer cgl

DDEV Local
----------

The extension comes with a ready to use DDEV Local configuration. Type
``ddev start`` in the extension root folder to start the Docker container.

``ddev launch`` will open the browser and head to the testing website. You can
use ``ddev launch typo3`` to get directly to the backend.

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
`Introduction <https://github.com/benjaminkott/site-introduction>`_ Demo Setup.

Contact & Communication
=======================

Slack
-----

You can connect directly with us on `Slack <https://typo3.slack.com/messages/bootstrap-package/>`_, the
preferred instant communication platform of TYPO3 CMS developers. If you already have access to the
TYPO3 Slack platform join the #bootstrap-package channel. If you don't have access yet, you can
register `here <https://my.typo3.org/about-mytypo3org/slack>`_.

Twitter
-------

If you have any questions about this project or just want to talk:
Send a tweet `@benjaminkott <https://twitter.com/benjaminkott>`_.

Code Quality
============

.. image:: https://github.com/benjaminkott/bootstrap_package/workflows/CI/badge.svg
   :alt: Continuous Integration Status
   :target: https://github.com/benjaminkott/bootstrap_package/actions?query=workflow%3ACI
