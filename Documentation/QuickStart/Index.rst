.. include:: /Includes.rst.txt

===========
Quick Start
===========

Follow these steps to get your Bootstrap package up and running quickly.

**Table of Contents:**

.. contents::
   :backlinks: top
   :class: compact-list
   :depth: 2
   :local:


Disable default content rendering extensions
============================================

You do not need to have either `Fluid Styled Content`_ or `CSS Styled Content`_
installed, we have currently marked both extensions as conflicting to avoid
misconfiguration.

If you really know what you are doing, it is safe to use Core content rendering
along with Bootstrap Package. But please note that we are adding more content
elements that are not supported by these system extensions.

.. _Fluid Styled Content: https://extensions.typo3.org/extension/fluid_styled_content/
.. _CSS Styled Content: https://extensions.typo3.org/extension/css_styled_content/


Make sure you have a root page
==============================

Create a new page or edit an existing one and set this as *root page*. You can
find this option in the :ref:`Edit Page <t3editors:pages-properties>` mode filed
under :guilabel:`Behavior > Miscellaneous`.


Create a new template on the root page
======================================

General
-------

* Template Title: You can name this as you like, for example "Bootstrap Package".
* Website Title: This will be your website title visible in the frontend.

Options
-------

* Clear constants and setup by checking the boxes.
* Clear the predefined TypoScript setup from the text box if any.
* Use this template as root-level template by checking the box.

Includes
--------

Include static (from extensions)

* Bootstrap Package (required)

Static Template Files from TYPO3 Extensions

* Include before all static templates if root flag is set
