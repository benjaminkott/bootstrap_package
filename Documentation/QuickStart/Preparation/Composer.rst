.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


==================
Configure Composer
==================


Now it's time to tell Composer which packages and TYPO3 extensions you like to
install and setup. The initial setup we have already done before with the
download of the TYPO3 Base Distribution.


TYPO3 Secure Web (optional)
===========================

To increase the security of your project you can simply use the
:composer:`helhum/typo3-secure-web` package.

.. code-block:: bash

   ddev composer config extra.typo3/cms.root-dir private
   ddev composer config extra.typo3/cms.web-dir public
   ddev exec mkdir -p private/typo3conf
   ddev exec ln -rs public/typo3conf/AdditionalConfiguration.php private/typo3conf/AdditionalConfiguration.php
   ddev composer require "helhum/typo3-secure-web" --no-update

You also need to change the :file:`.gitignore` in your project root a little
bit. Just copy the lines starting with /public/... and replace **public** by
**private** but omit the last line with the
:file:`!/private/typo3conf/AdditionalConfiguration.php`. Finally it should look
similar to this one:

.. code-block:: json

   .DS_Store
   .idea
   nbproject
   /var/*
   !/var/labels
   /vendor
   /public/*
   !/public/.htaccess
   !/public/typo3conf
   /public/typo3conf/*
   !/public/typo3conf/LocalConfiguration.php
   !/public/typo3conf/AdditionalConfiguration.php
   /private/*
   !/private/.htaccess
   !/private/typo3conf
   /private/typo3conf/*
   !/private/typo3conf/LocalConfiguration.php

More information can be found at the `TYPO3 Secure Web Github Repository <https://github.com/helhum/typo3-secure-web#readme>`_


Additional TYPO3 (Core) Extensions
==================================

You are free to add more packages, for core extensions head to the
`Composer Helper <https://get.typo3.org/misc/composer/helper>`_ and select the
desired packages, extensions can be found at the
`TYPO3 Extension Repository <https://extensions.typo3.org/>`_. Make sure you
always add the :composer:`--no-update` option to avoid version conflicts
later.

.. code-block:: bash

   ddev composer require "typo3/cms-lowlevel:^10.4"
   ddev composer require georgringer/news

Be careful when installing **Distributions**, they may conflict with the
**Sitepackage**. So consider to install a **Distribution** only and adding
the **Sitepackage** later.


Install the Packages
====================

Once you have finished adding more packages run the following commands to
start the installation process:

.. code-block:: bash

   ddev composer install
   ddev composer install

Yes, run the same command twice, there may be issues with the creation of
symlinks in the web container and a second run solves it! If you see your
**Sitepackage** in the lines of activated packages you can also omit the
second run but it does not hurt anyway.

Your project is now installed and ready to setup.
