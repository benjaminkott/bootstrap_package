.. include:: /Includes.rst.txt

.. _installation:

============
Installation
============

Requirements
============

* TYPO3 14.3 or TYPO3 15
* PHP 8.2 or higher

For general TYPO3 system requirements, please refer to the official
`TYPO3 Installation Guide <https://docs.typo3.org/m/typo3/tutorial-getting-started/main/en-us/Installation/Index.html>`__.


Composer Installation
=====================

Install the Bootstrap Package via Composer by running:

.. code-block:: bash

   composer require bk2k/bootstrap-package


Classic Installation
====================

Alternatively, you can install the extension via the `TYPO3 Extension Repository (TER)`_.

.. _TYPO3 Extension Repository (TER): https://extensions.typo3.org/extension/bootstrap_package


Demo Content
============

Bootstrap Package ships a fully configured demo website - a page tree with
examples for every content element, the images they use, and a site
configuration with an English and a German language.

The content arrives with the TYPO3 setup. Require the extension before you
run it, and the setup imports the page tree, the images and the site
configuration as its last step - there is no need to create a site of your
own, and ``--create-site`` or ``--distribution`` have no effect once the
extension is active:

.. code-block:: bash

   composer require bk2k/bootstrap-package
   vendor/bin/typo3 setup

The import happens exactly once and is remembered in the registry, so setting
the extension up again on the same installation imports nothing and leaves an
edited page tree alone.

To bring the demo content into an installation that has already been set up -
or to import it a second time, next to content that is already there - use the
:guilabel:`Import/Export` backend module, or the console:

.. code-block:: bash

   vendor/bin/typo3 impexp:import EXT:bootstrap_package/Initialisation/data.xml 0

Pass a page uid instead of ``0`` to import the tree below an existing page.
Note that this adds a further page tree rather than replacing the current one.

.. note::

   The demo content is meant as a starting point and as a reference for what
   the content elements look like. For a production site, remove the pages you
   do not need rather than building on top of all of them.


Conflicting Extensions
======================

Bootstrap Package provides its own content rendering and conflicts with the
core extension ``fluid_styled_content``. This extension is marked as conflicting
to avoid misconfiguration.


Next Steps
==========

After installation, follow the :ref:`quickstart` guide to configure your site.
