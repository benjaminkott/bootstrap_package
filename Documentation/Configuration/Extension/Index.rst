.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


=======================
Extension Configuration
=======================

Use the extension manager to adjust the Bootstrap Package to your needs.

.. figure:: ../../Images/Configuration/ExtensionConfiguration.jpg
	:width: 500px
	:alt: Bootstrap Package Extension Configuration

Backend Skin
============
The backend skin can be disabled and is also disabled if ext:themes is installed.


Backend Logo & Login Logo
=========================
You can replace the default TYPO3 logos in the backend with the logo of your company or your customer.
The path to the logofile has to be relative to the TYPO3 backend.

**Example:**

.. code-block:: text

    basic.Logo = ../fileadmin/introduction/images/theme/backend/TopBarLogo@2x.png
    basic.LoginLogo = ../fileadmin/introduction/images/theme/backend/LoginLogo.png

**Defaults:**

.. code-block:: text

    basic.Logo = ../typo3conf/ext/bootstrap_package/Resources/Public/Images/Backend/TopBarLogo@2x.png
    basic.LoginLogo = ../typo3conf/ext/bootstrap_package/Resources/Public/Images/Backend/LoginLogo.png

RealURL Config
==============
The Bootstrap Package comes with its own RealURL configuration and will override your Configuration by default.
If you want to use your own RealURL config you can disable this option.

**Configuration can be found here:**
typo3conf/ext/bootstrap_package/RealURL/Default.php

PageTsConfig
============

The Boostrap Package has a lot of PageTsConfig defaults.
In some cases it can be usefull to deactivate some of them if you do not need them.