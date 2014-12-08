/**
 * This is a adjusted version of Luís Almeida jQuery Unveil Script
 * http://luis-almeida.github.com/unveil
 */

;
(function ($) {

	// RESPONSIVEIMAGES PLUGIN DEFINITION
	// =================================
	$.fn.responsiveimages = function (options, callback) {

		var defaults = {
				threshold: 0,
				breakpoints: {
					320: 'small',
					720: 'medium',
					940: 'large',
					1140: 'bigger'
				},
				container:window,
				skip_invisible: true
			},
			options = $.extend({}, defaults, options),
			$window = $(window),
			breakpoints = options.breakpoints,
			attrib = "data-src",
			images = this,
			originimages = this,
			loaded;

		this.on("responsiveimages", function () {
			var source = this.getAttribute(attrib);
			source = source || this.getAttribute("data-src");
			if (source) {
				this.setAttribute("src", source);
				if (typeof callback === "function") callback.call(this);
			}
		});

		function checkviewport() {
			old_attrib = attrib;
			var ww = $window.width();
			$.each(breakpoints, function (breakpoint, datakey) {
				if (ww >= breakpoint) {
					attrib = "data-" + datakey;
				}
			});
			if (old_attrib !== attrib) {
				images = originimages;
			}
			responsiveimages();
		}
		function inviewport($el, options){
			var $c = $(options.container),
				ew = $el.width(),
				eh = $el.height(),
				el = $el.offset().left,
				et = $el.offset().top,
				cw = $c.width(),
				ch,
				cl,
				ct;
			if (options.container === undefined || options.container === window){
				ch = window.innerHeight ? window.innerHeight : $window.height();
				cl = $window.scrollLeft();
				ct = $window.scrollTop();
			} else {
				ch = $c.height();
				cl = $c.offset().left;
				ct = $c.offset().top;
			}
			return cl + cw > el - options.threshold && cl < el + ew + options.threshold && ct + ch > et - options.threshold && ct < et + eh + options.threshold;
		}

		function responsiveimages() {
			var inview = images.filter(function () {
				var $element = $(this);
				if (options.skip_invisible && $element.is(":hidden")) return;
				return inviewport($element, options);
			});
			loaded = inview.trigger("responsiveimages");
			images = images.not(loaded);
		}

		$(options.container).scroll(checkviewport);
		$window.resize(checkviewport);
		$.fn.responsiveimages.update = checkviewport;
		checkviewport();

		return this;

	};

})(window.jQuery);
