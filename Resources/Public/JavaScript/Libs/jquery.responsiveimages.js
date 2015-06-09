/* ========================================================================
 * Responsive Image
 *
 * Inspired by:
 * http://luis-almeida.github.com/unveil
 * http://verge.airve.com/
 * ======================================================================== */

+function($) {

	// RESPONSIVE IMAGES CLASS DEFINITION
	// ==================================
	var ResponsiveImage = function(element, options) {
		this.$element	= $(element);
		this.options	= $.extend({}, ResponsiveImage.DEFAULTS, options);
		this.attrib 	= "src";
		this.loaded		= false;
		this.checkviewport();
	};

	ResponsiveImage.DEFAULTS = {
		threshold: 0,
		breakpoints: {
			0: 'small',
			768: 'medium',
			992: 'large',
			1200: 'bigger'
		},
		attrib: "src",
		skip_invisible: false,
		preload: false
	};

	ResponsiveImage.prototype.viewportW = function() {
		var clientWidth = document.documentElement['clientWidth'], innerWidth = window['innerWidth'];
		return clientWidth < innerWidth ? innerWidth : clientWidth;
	  };

	ResponsiveImage.prototype.viewportH = function() {
		var clientHeight = document.documentElement['clientHeight'], innerHeight = window['innerHeight'];
		return clientHeight < innerHeight ? innerHeight : clientHeight;
	  };

	ResponsiveImage.prototype.checkviewport = function() {
		var containerWidth = this.viewportW();
		var attrib = this.attrib;
		var old_attrib = this.attrib;
		$.each(this.options.breakpoints, function (breakpoint, datakey) {
			if (containerWidth >= breakpoint) {
				attrib = datakey;
			}
		});
		if (old_attrib !== attrib) {
			this.attrib = attrib;
			this.loaded	= false;
		}
		if (!this.loaded){
			this.unveil();
			}
	};

	ResponsiveImage.prototype.boundingbox = function() {
		var options = {},
			coords    = this.$element[0].getBoundingClientRect(),
			threshold = +this.options.threshold || 0;
		options['width']  = (options['right'] = coords['right'] + threshold) - (options['left'] = coords['left'] - threshold);
		options['height'] = (options['bottom'] = coords['bottom'] + threshold) - (options['top'] = coords['top'] - threshold);
		return options;
	};

	ResponsiveImage.prototype.inviewport = function() {
		var boundingbox = this.boundingbox();
		return !!boundingbox && boundingbox.bottom >= 0 && boundingbox.right >= 0 && boundingbox.top <= this.viewportH() && boundingbox.left <= this.viewportW();
	};

	ResponsiveImage.prototype.unveil = function() {
		if (!this.options.preload && this.options.skip_invisible && this.$element.is(":hidden")) return;
		var inview = this.options.preload || this.inviewport();
		if(inview){
			var source = this.options[this.attrib] || this.options["src"];
			if (source) {
				this.$element.attr("src", source);
				this.$element.css("opacity", 1);
				$(window).trigger('loaded.bk2k.responsiveimage');
				this.loaded	= true;
			}
		}
	};


	// RESPONSIVE IMAGES PLUGIN DEFINITION
	// ===================================
	function Plugin(option) {
		return this.each(function() {
			var $this   = $(this);
			var data    = $this.data('bk2k.responsiveimage');
			var options = typeof option === 'object' && option;

			if (!data) $this.data('bk2k.responsiveimage', (data = new ResponsiveImage(this, options)));
			if (typeof option === 'string') data[option]();
		});
	};

	var old = $.fn.responsiveimages;

	$.fn.responsiveimage				= Plugin;
	$.fn.responsiveimage.Constructor	= ResponsiveImage;


	// RESPONSIVE IMAGES NO CONFLICT
	// =============================
	$.fn.responsiveimage.noConflict = function() {
		$.fn.responsiveimage = old;
		return this;
	};


	// RESPONSIVE IMAGES API
	// =====================
	$(window).on('load.bk2k.responsiveimage', function() {
		$('img.lazyload').each(function() {
			var $image = $(this);
			var data = $image.data();

			Plugin.call($image, data);
		});
	});
	
	// EVENT "DELEGATION"
	// ==================
	$(window).on('scroll.bk2k.responsiveimage, resize.bk2k.responsiveimage', function(){
		$('img.lazyload').responsiveimage('checkviewport');
	});
		
		
}(jQuery);
