/* ========================================================================
 * Responsive Image
 *
 * Inspired by:
 * http://luis-almeida.github.com/unveil
 * http://verge.airve.com/
 * ======================================================================== */

+function($) {

    // cache img.lazyload collection
    var $lazyload;

    // VIEWPORT HELPER CLASS DEFINITION
    // ================================
    var viewport;
    var ViewPort = function(options){
        this.viewportWidth  = 0;
        this.viewportHeight = 0;
        this.options  = $.extend({}, ViewPort.DEFAULTS, options);
        this.attrib = "src";
        this.update();
    };

    ViewPort.DEFAULTS = {
        breakpoints : {
            0:'small',
            768: 'medium',
            992: 'large',
            1200: 'bigger'
        }
    }

    ViewPort.prototype.viewportW = function() {
        var clientWidth = document.documentElement['clientWidth'], innerWidth = window['innerWidth'];
        return this.viewportWidth = clientWidth < innerWidth ? innerWidth : clientWidth;
    };

    ViewPort.prototype.viewportH = function() {
        var clientHeight = document.documentElement['clientHeight'], innerHeight = window['innerHeight'];
        return this.viewportHeight = clientHeight < innerHeight ? innerHeight : clientHeight;
    };

    ViewPort.prototype.inviewport = function(boundingbox) {
        return !!boundingbox && boundingbox.bottom >= 0 && boundingbox.right >= 0 && boundingbox.top <= this.viewportHeight && boundingbox.left <= this.viewportWidth;
    };

    ViewPort.prototype.update = function(){
        this.viewportH();
        this.viewportW();
        var attrib  = this.attrib,
            width   = this.viewportWidth;

        $.each(this.options.breakpoints, function (breakpoint, datakey) {
            if (width >= breakpoint) {
                attrib = datakey;
            }
        });

        this.attrib = attrib;
    };

    // expose viewportH & viewportW methods
    $.fn.viewportH = ViewPort.prototype.viewportH;
    $.fn.viewportW = ViewPort.prototype.viewportW;

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
        attrib: "src",
        skip_invisible: false,
        preload: false
    };

    ResponsiveImage.prototype.checkviewport = function() {
        if (this.attrib !== viewport.attrib) {
            this.attrib = viewport.attrib;
            this.loaded = false;
        }
        this.unveil();
    };

    ResponsiveImage.prototype.boundingbox = function() {
        var boundingbox = {},
            coords    = this.$element[0].getBoundingClientRect(),
            threshold = +this.options.threshold || 0;
        boundingbox['right']  = coords['right']  + threshold; boundingbox['left'] = coords['left'] - threshold;
        boundingbox['bottom'] = coords['bottom'] + threshold; boundingbox['top']  = coords['top']  - threshold;
        return boundingbox;
    };

    ResponsiveImage.prototype.inviewport = function() {
        var boundingbox = this.boundingbox();
        return viewport.inviewport(boundingbox);
    };

    ResponsiveImage.prototype.unveil = function() {
        if (this.loaded || !this.options.preload && this.options.skip_invisible && this.$element.is(":hidden")) return;
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
        $lazyload = this;
        return this.each(function() {
            var $this   = $(this);
            var data    = $this.data('bk2k.responsiveimage');
            var options = typeof option === 'object' && option;

            if (!data) {
                if (!viewport) viewport = new ViewPort(options && options.breakpoints ? {breakpoints:options.breakpoints} : {});

                if (options && options.breakpoints) options.breakpoints = null;
                options = $.extend({}, $this.data(), options);

                $this.data('bk2k.responsiveimage', (data = new ResponsiveImage(this, options)));
            }
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
        $('img.lazyload').responsiveimage();


        // EVENTS
        // ======
        $(window)
            .on('scroll.bk2k.responsiveimage', function(){
                $lazyload.responsiveimage('unveil');
            })
            .on('resize.bk2k.responsiveimage', function(){
                if (viewport) viewport.update();
                $lazyload.responsiveimage('checkviewport');
            });
    });

}(jQuery);
