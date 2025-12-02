.. include:: /Includes.rst.txt

.. _installation:

============
Installation
============

Requirements
============

* TYPO3 13.4 LTS or TYPO3 14
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


Conflicting Extensions
======================

Bootstrap Package provides its own content rendering and conflicts with the
core extension ``fluid_styled_content``. This extension is marked as conflicting
to avoid misconfiguration.


Next Steps
==========

After installation, follow the :ref:`quickstart` guide to configure your site.
