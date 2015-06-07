/* ========================================================================
 * This is a adjusted version of Luís Almeida jQuery Unveil Script
 * http://luis-almeida.github.com/unveil
 * ======================================================================== */

+function($) {

	// RESPONSIVE IMAGES CLASS DEFINITION
	// ==================================
	var ResponsiveImage = function(element, options) {
		this.$element	= $(element);
		this.options	= $.extend({}, ResponsiveImage.DEFAULTS, options);
		this.attrib = "data-src";
		this.$container = $(this.options.container)
			.on('scroll.bk2k.responsiveimage', $.proxy(this.checkviewport, this))
			.on('resize.bk2k.responsiveimage', $.proxy(this.checkviewport, this));
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
		attrib: "data-src",
		container: window,
		skip_invisible: false,
		preload: false
	};
	
    ResponsiveImage.prototype.viewportW = function() {
		var a = document.documentElement['clientWidth'], b = window['innerWidth'];
        return a < b ? b : a;
      };
	  
    ResponsiveImage.prototype.viewportH = function() {
        var a = document.documentElement['clientHeight'], b = window['innerHeight'];
        return a < b ? b : a;
      };
      
	ResponsiveImage.prototype.checkviewport = function() {
		var containerWidth = this.viewportW();
		var attrib = this.attrib;
		var old_attrib = this.attrib;
		$.each(this.options.breakpoints, function (breakpoint, datakey) {
			if (containerWidth >= breakpoint) {
				attrib = "data-" + datakey;
			}
		});
		if (old_attrib !== attrib) {
			this.attrib = attrib;
		}
		this.unveil();
	};

	ResponsiveImage.prototype.boundingbox = function() {
		var o = {},
			coords    = this.$element[0].getBoundingClientRect(), 
			threshold = +this.threshold || 0;
		o['width']  = (o['right'] = coords['right'] + threshold) - (o['left'] = coords['left'] - threshold);
		o['height'] = (o['bottom'] = coords['bottom'] + threshold) - (o['top'] = coords['top'] - threshold);
		return o;
	};

	ResponsiveImage.prototype.inviewport = function() {
		var bb = this.boundingbox();
		return !!bb && bb.bottom >= 0 && bb.right >= 0 && bb.top <= this.viewportH() && bb.left <= this.viewportW();
	};

	ResponsiveImage.prototype.unveil = function() {
		if (!this.options.preload && this.options.skip_invisible && this.$element.is(":hidden")) return;
		var inview = this.options.preload || this.inviewport();
		if(inview){
			var source = this.$element.attr(this.attrib);
			source = source || this.$element.attr("data-src");
			if (source) {
				this.$element.attr("src", source);
				this.$element.css("opacity", 1);
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
	$(window).on('load', function() {
		$('img.lazyload').each(function() {
			var $image = $(this);
			var data = $image.data();

			Plugin.call($image, data);
		});
	});

}(jQuery);
