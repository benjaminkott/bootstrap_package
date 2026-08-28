.. include:: /Includes.rst.txt

.. index:: ! Routing
.. _routing:

=======
Routing
=======

.. _routing-pagination:

Pagination
==========

Paginated content elements — the gallery is the one the package ships —
carry the pagination in two query arguments:

``paginate[id]``
   Identifier of the pagination that is being paged. The gallery builds
   it out of its uid, for example ``gallery-8793``.

``paginate[page]``
   Page number. It is absent on the first page.

One pagination is addressed at a time. Every other paginated element on
the page stays on its first page, which is also all a speaking URL can
express.

Every pagination link ends in the anchor of the element it pages, so a
new page starts at that element instead of at the top of the document.

The site set ``bootstrap-package/pagination`` is part of the Full
Package and rewrites both arguments into the path:

.. code-block:: none

   /gallery/tag-3/gallery-8793/page-2

Without it the arguments stay in the query string and drag a cache hash
along:

.. code-block:: none

   /gallery/tag-3?paginate%5Bid%5D=gallery-8793&paginate%5Bpage%5D=2&cHash=61450d52

.. note::

   Route enhancers travel with a site set as of TYPO3 v14.1. On TYPO3
   v13.4 the set is loaded but its enhancer is not, and the definition
   below has to be written into the site configuration by hand.

The enhancer
------------

.. code-block:: yaml
   :caption: EXT:bootstrap_package/Configuration/Sets/Pagination/route-enhancers.yaml

   routeEnhancers:
     BootstrapPackagePagination:
       type: Plugin
       namespace: 'paginate'
       routePath: '/{id}/page-{page}'
       static:
         id: true
       requirements:
         id: '[a-z][a-z0-9]*-\d+'
         page: '\d+'
       aspects:
         page:
           type: StaticRangeMapper
           start: '2'
           end: '1000'

Adjusting the enhancer
----------------------

A site configuration takes precedence over the sets it depends on, so
only the keys that should differ have to be written into the site's own
``routeEnhancers``. Templates of your own that call
``bk2k:data.paginate`` with an identifier of another shape need the
requirement widened:

.. code-block:: yaml
   :caption: config/sites/<identifier>/config.yaml

   routeEnhancers:
     BootstrapPackagePagination:
       requirements:
         id: '[a-z0-9_-]+'

Keep that pattern as narrow as the identifiers in use. Every value it
matches is a page of its own and gets its own cache entry.

Two properties carry the clean URL and are worth keeping when the
enhancer is adjusted: ``static`` on the identifier and the
``StaticRangeMapper`` on the page number. An argument that has neither
stays dynamic, and a cache hash returns to the URL.

The range decides how many pages are reachable through the path. Beyond
its end the pagination falls back to the query string.
