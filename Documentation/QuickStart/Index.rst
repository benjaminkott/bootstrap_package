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

Create a new page or edit an existing one and set this as *root page*. This is done by turning on the option
:guilabel:`Use as Root Page` in the :ref:`Edit Page <t3editors:pages-properties>` 
under :guilabel:`Behavior > Miscellaneous`.


Add the Bootstrap Package site set
==================================

When you create a root page, TYPO3 automatically creates a site configuration for it.
Edit the site and add the "Bootstrap Package: Full Package" set to include all features needed for a quick start.
