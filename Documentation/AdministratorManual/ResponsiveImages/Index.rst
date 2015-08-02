.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../../Includes.txt


.. _responsiveimages:

===========================
Responsive Images Js Plugin
===========================

This document will only cover **jquery.responsiveimages plugin**.
Apply to Bootstrap Package >= 6.2.13



Responsive images Plugin
========================

This plugin manage lazy loading of images, via data-attributes, using advanced techniques to detect viewport width matching exact media query.
Highly optimized so it only performs things when realy needed.
Since 6.2.13 the plugin auto-initialize so there is no more need to do it by hand in main.js



Using jquery selector
---------------------

For performance reason, selection is cached so any update by hand should always be made using "img.lazyload" selector, not doing so will break up things.


Preloading images
-----------------

You may want to "lazy-preload" off screen images.
Images preloading is done by adding a data-preload="true" attribute on image.
This way the plugin dosen't take care of screen position nor image visibility and load the image right after document.ready.


Changing default Breakpoints
----------------------------

When changing default breakpoints, you have to modify the settings of jquery.responsiveimages.min.js (see jquery.responsiveimages.js line 22-30).

**Javascript**

.. code-block:: javascript
	:linenos:
	:emphasize-lines: 3-6

	ViewPort.DEFAULTS = {
		breakpoints : {
			480: 'small',
			768: 'medium',
			992: 'large',
			1200: 'bigger'
		}
	}


Update images by hand
---------------------

Sometimes images are hidden and you may want to call the plugin by hand.
eg: when carousel slide and when a tab show.

**Javascript**

.. code-block:: javascript
	:linenos:
	:emphasize-lines: 2-2

	$(".carousel").on("slid.bs", function(event){
		$("img.lazyload").responsiveimage('unveil');
	});


Perform an action when new images are loaded
--------------------------------------------

As the layout of your page may change on image load, you may want to call a function when this happen, eg: update a scrollspy.
The 'loaded.bk2k.responsiveimage' event is meant to be catched with a setTimeout based handler since many calls are possible, this way make a kind of throttle.

**Javascript**

.. code-block:: javascript
	:linenos:
	:emphasize-lines: 6-7

	var loadedTimeout;
	$(window).on('loaded.bk2k.responsiveimage', function(){
		clearTimeout(loadedTimeout);
		loadedTimeout = setTimeout(
			function(){
				// whatever you want to do
				refreshScrollSpy();
			},
			200
		);
	});
