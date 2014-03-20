/**
 * This is a adjusted version of Luís Almeida jQuery Unveil Script
 * http://luis-almeida.github.com/unveil
 */

;(function($) {
  
    // RESPONSIVEIMAGES PLUGIN DEFINITION
    // =================================
    $.fn.responsiveimages = function (options,callback) {
        
        var defaults = {
                threshold: 0,
                breakpoints: {
                    320: 'small',
                    720: 'medium',
                    940: 'large',
                    1140: 'bigger'
                }
            },
            options = $.extend({}, defaults, options),
            $window = $(window),
            threshold = options.threshold || 0,
            breakpoints = options.breakpoints,
            hdpi = window.devicePixelRatio > 1,
            attrib = "data-src",
            images = this,
            originimages = this,
            loaded;
            
        this.on("responsiveimages", function() {
            var source = this.getAttribute(attrib);
            source = source || this.getAttribute("data-src");
            if(source){
                this.setAttribute("src", source);
                if(typeof callback === "function") callback.call(this);
            }
        });

        function checkviewport(){
            old_attrib = attrib;
            var ww = $window.width();
            $.each(breakpoints, function(breakpoint,datakey) {
                if(ww >= breakpoint){
                    attrib = "data-"+datakey;
                }
            });
            if(old_attrib != attrib){
                images = originimages;
            }
            responsiveimages();
        }
        
        function responsiveimages() {            
            var inview = images.filter(function() {
                var $element = $(this);
                if ($element.is(":hidden")) return;
                var wt = $(window).scrollTop(),
                    wb = wt + $(window).height(),
                    et = $element.offset().top,
                    eb = et + $element.height();
                return eb >= wt - threshold && et <= wb + threshold;
            });
            loaded = inview.trigger("responsiveimages");
            images = images.not(loaded);
        }
        
        $window.scroll(checkviewport);
        $window.resize(checkviewport);

        checkviewport();
       
        return this;

    }

})(window.jQuery);