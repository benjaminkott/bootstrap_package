.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


=============================
Setup the TypoScript Template
=============================


Login to the Backend
====================

The **TYPO3 Install Wizard** should have redirected you to the backend login
screen. However you always can head to the backend with this command:

.. code-block:: bash

   ddev launch typo3

Enter your choosen credentials here and login to the
TYPO3 backend.

.. figure:: ../Images/Backend/Login.png
   :width: 200px
   :alt: TYPO3 Backend Login
   :class: with-border


The Dashboard
-------------

After the successful login you will be redirected to the TYPO3 Dashboard.

.. figure:: ../Images/Backend/Dashboard.png
   :width: 800px
   :alt: TYPO3 Dashboard
   :class: with-shadow


Edit the TypoScript Template
============================

On the left side choose the **Template module**.

.. figure:: ../Images/Backend/TemplateModule.png
   :width: 800px
   :alt: TYPO3 Template Module
   :class: with-shadow

Here you select the existing template **Main TypoScript Rendering** on the
page **Home**.

On the top select :button:`Info/Modify`

.. figure:: ../Images/Template/SelectAction.png
   :alt: Select Template Action
   :class: with-border

and click to :button:`Edit the whole template record`.

.. figure:: ../Images/Template/InfoModify.png
   :width: 800px
   :alt: Edit Template
   :class: with-border


General
-------

On the tab **General** remove the default content of the **Setup** field. You
are free to change here also the **Template Title**.

.. figure:: ../Images/Template/General.png
   :width: 800px
   :alt: General Tab
   :class: with-border


Options
-------

On the tab **Options** change the settings according to this listing and the
following image:

* Check **Clear Constants**
* Check **Clear Setup**
* Activate **Rootlevel**

.. figure:: ../Images/Template/Options.png
   :width: 800px
   :alt: Options Tab
   :class: with-border


Includes
--------

On the tab **Includes** change the settings according to this listing and the
following image:

* Remove all **Include static (from extensions)** items
* Add your **Sitepackage** to **Include static (from extensions)**
* For **Static Template Files from TYPO3 Extensions** select
  **Include before all static templates if root flag is set**

.. figure:: ../Images/Template/Includes.png
   :width: 800px
   :alt: Options Tab
   :class: with-border


Save and Close the Template
---------------------------

On the top click to **Save**:

.. figure:: ../Images/Template/ButtonSave.png
   :alt: Save Button
   :class: with-border

The template is now fully setup and you can close it.
