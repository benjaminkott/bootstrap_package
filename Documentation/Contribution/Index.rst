.. include:: /Includes.rst.txt

.. _contribution:

============
Contribution
============

Feel free to create an issue or fork this project and create a pull request
when you're happy with your changes.

**Table of Contents:**

.. contents::
   :backlinks: top
   :class: compact-list
   :depth: 2
   :local:


Bug reporting
=============

Please open an `issue at GitHub`__ and describe your problem.

__ https://github.com/benjaminkott/bootstrap_package/issues


Clean code
==========

We check the source code according to the our Coding Guidelines. To reformat
the code automatically, you can use *PHP CS Fixer* as follows:

.. code-block:: bash

   composer cgl


Local environment
=================

The extension comes with a ready to use DDEV Local configuration. Type
``ddev start`` in the extension root folder to start the Docker container.

``ddev launch`` will open the browser and head to the testing website. You can
use ``ddev launch typo3`` to get directly to the backend.

``composer install`` resolves the newest TYPO3 release the extension
declares. The local installation runs on the TYPO3 development major
instead, which ``composer typo3:dev`` resolves without touching
``composer.json``:

.. code-block:: bash

   ddev composer typo3:dev


Working on the demo content
===========================

The demo content the extension ships lives in :file:`Initialisation/`:
:file:`data.xml` holds the records, :file:`data.xml.files/` the images that
belong to them, and :file:`Site/bootstrap-package/` the site configuration
and its settings. TYPO3 imports it through its own setup and Import/Export
commands, there is no tooling of the extension's own around them.

Those files are generated. The content is written in
:file:`Build/Content/pages/`, one YAML file per page, and
:file:`Build/Content/seed.php` writes it into the development
installation in both languages. Editing records in the backend is not
how a change is made: the next seed run overwrites them.
:file:`Build/Content/README.md` describes the format and the loop
around it.

Import it into a fresh installation
-----------------------------------

The import runs once per installation and is remembered in the registry, so
an artifact can only be judged on an installation that has never seen it.
Empty the database, remove what the last import left behind, and let
``typo3 setup`` do the rest - it imports the content of every active package
that ships an :file:`Initialisation/` folder as its last step:

.. code-block:: bash

   ddev mysql -e 'DROP DATABASE db; CREATE DATABASE db;'
   rm -rf config/sites/bootstrap-package config/system/settings.php \
          .build/public/fileadmin/bootstrap_package var/cache/*
   ddev exec .build/bin/typo3 setup --force --no-interaction \
       --driver=mysqli --host=db --dbname=db --username=db --password=db \
       --admin-username=admin --admin-user-password='<password>' \
       --admin-email=admin@example.com --project-name='Bootstrap Package' \
       --server-type=apache

Do not pass ``--distribution`` or ``--create-site``: the extension is a
distribution as far as the setup is concerned, and the setup skips its own
site creation once one is active.

To import the artifact into an installation that already has content, next to
whatever is there, use the Import/Export module or the console instead:

.. code-block:: bash

   ddev exec .build/bin/typo3 impexp:import EXT:bootstrap_package/Initialisation/data.xml 0

Export it after a change
------------------------

Seed the installation from :file:`Build/Content/`, then export the page
tree. Every table the
tree holds has to be named - a table nobody named is left out without a
word - and the images only come along with ``--include-related=sys_file``:

.. code-block:: bash

   ddev exec .build/bin/typo3 impexp:export --type=xml --pid=1 --levels=999 \
       --table=tt_content \
       --table=sys_file_reference \
       --table=sys_category \
       --table=sys_file_collection \
       --table=tx_bootstrappackage_accordion_item \
       --table=tx_bootstrappackage_card_group_item \
       --table=tx_bootstrappackage_carousel_item \
       --table=tx_bootstrappackage_icon_group_item \
       --table=tx_bootstrappackage_tab_item \
       --table=tx_bootstrappackage_timeline_item \
       --include-related=sys_file \
       --include-related=sys_file_metadata \
       --include-related=sys_category \
       --save-files-outside-export-file \
       --title='Bootstrap Package' \
       --description='Demo content shipped with the Bootstrap Package sitepackage.' \
       --dependency=bootstrap_package \
       --dependency=impexp \
       --dependency=rte_ckeditor \
       data

``--pid`` is the uid of the site root on your installation. The command keeps
only the basename of the filename argument and writes the export below
:file:`fileadmin/user_upload/_temp_/importexport/`, so move it into the
package afterwards, the files directory with it:

.. code-block:: bash

   rm -rf Initialisation/data.xml Initialisation/data.xml.files
   mv .build/public/fileadmin/user_upload/_temp_/importexport/data.xml Initialisation/
   mv .build/public/fileadmin/user_upload/_temp_/importexport/data.xml.files Initialisation/

Then check three things, because ``impexp:export`` reports success whatever
it left out:

*  ``rootPageId`` in :file:`Initialisation/Site/bootstrap-package/config.yaml`
   is the uid the site root has inside :file:`data.xml`. The import rewrites
   it to the page it created, but only if it finds that uid in the artifact.
*  :file:`data.xml` carries a ``files_fal`` section, and
   :file:`data.xml.files/` holds one file per image the content references.
*  The functional test imports the artifact and compares what arrived with
   what the file declares:

   .. code-block:: bash

      ddev exec .build/bin/phpunit -c Build/phpunit-functional.xml \
          Tests/Functional/Initialisation/DataImportTest.php

Finally import it into a fresh installation as described above and click
through the site - that is the only place the whole result shows.


Build the frontend files
========================

When you change any of the SCSS files, the combined and minified versions
of the CSS have to be rebuilt.

You can run them like this:

.. code-block:: bash

   cd Build
   npm ci
   npm run build

Then commit any changes to files in folder :file:`Resources/Public/Css`. If you
omit any of these steps the pipeline of the automatic checks fails for
"build-frontend".


License
=======

This project is released under the terms of the `MIT license`_.

.. _MIT license: https://en.wikipedia.org/wiki/MIT_License


Slack
=====

You can connect directly with us on `Slack`_, the preferred instant
communication platform of TYPO3 CMS developers. If you already have access to
the TYPO3 Slack platform join the #bootstrap-package channel. If you don't have
access yet, you can register at `my.typo3.org`_.

.. _Slack: https://typo3.slack.com/messages/bootstrap-package/
.. _my.typo3.org: https://my.typo3.org/about-mytypo3org/slack


X
=

If you have any questions about this project or just want to talk:
Send a tweet `@benjaminkott <https://x.com/benjaminkott>`_.
