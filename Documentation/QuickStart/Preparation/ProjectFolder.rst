.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


==========================
Prepare the Project Folder
==========================


Create a Project Folder
=======================

Create a project folder for your new web site project. This is usualy done in
your user home directory or a sub folder but every place is possible. This
guide will use :file:`typo3-quick-start` as project folder.


Configure DDEV Local
====================

Head to your newly created project folder with your favorite shell or the
integrated shell of your editor and run the following command to setup DDEV:

.. code-block:: bash

   ddev config --project-type=typo3 --docroot=public --create-docroot=true
   ddev composer create "typo3/cms-base-distribution:^10" --no-install
   ddev start

This will setup DDEV Local and download the TYPO3 Base Distribution.
