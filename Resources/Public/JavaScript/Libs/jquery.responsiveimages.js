/**
 * This is a adjusted version of Luís Almeida jQuery Unveil Script
 * http://luis-almeida.github.com/unveil
 */

;(function($) {
  
    // RESPONSIVEIMAGES PLUGIN DEFINITION
    // =================================
    $.fn.responsiveimages = function (options,callback) {
      // The rule is :
      // if the layout is responsive 
      // the value is the entry point of the breakpoint
      
        var defaults = {
                threshold: 0,
                breakpoints: {
                    0: 'small',
                    480: 'medium',
                    992: 'large',
                    1200: 'bigger'
                },
                container:window,
                skip_invisible: false,
                retina: true,
                preloadClass:"preload"
            },
            options = $.extend({}, defaults, options),
            $window = $(window),
            threshold = options.threshold || 0,
            breakpoints = options.breakpoints,
            retina = options.retina && window.devicePixelRatio > 1,
            attrib = "data-src",
            images = this,
            originimages = this,
            loaded,
            smallest_breakpoint = 1e16;
      
      function findSmallestBreakpoint(){
        var bp = 0;
        $.each(breakpoints, function(breakpoint,datakey) {
            bp = parseInt(breakpoint);
            if(bp < smallest_breakpoint){
                    smallest_breakpoint = bp;
                }
        });  
      }
      
      function getDataKey(){
        var datakey = "src",
            bw = bp = 0,
            ww = $window.width();
        
        // window width < smallest_breakpoint
        if (ww < smallest_breakpoint){
          return breakpoints[smallest_breakpoint];
          };
        
        // find largest breakpoint < window 
        $.each(breakpoints, function(breakpoint,dk) {
            bp = parseInt(breakpoint);
            if(bp <= ww && bp > bw ){
              bw = bp;
              datakey = dk;
            }
          });
        return datakey;
      }
 
        this.on("responsiveimages", function() {
            var source  = this.getAttribute(attrib);
            // fallback to non retina or src when not found
            source = source || (retina ? this.getAttribute("data-"+getDataKey()) : false) || this.getAttribute("data-src");
            if(source){
                this.setAttribute("src", source);
                if(typeof callback === "function") callback.call(this);
            }
        });

        function checkviewport(){
            old_attrib = attrib;
            var datakey = getDataKey();
            attrib = (retina ? "data-retina-" : "data-") + datakey;
            if(old_attrib != attrib){
                images = originimages;
            }
            responsiveimages();
        }
      
        // better handling of top/bottom left/right position of element
        // inspired by http://www.appelsiini.net/projects/lazyload
        // to allow onepage horizontal layouts with jquery.ascensor.js
        // http://kirkas.ch/ascensor/#Home
        function inviewport($el, options){
          // preload image even when not inviewport
          if (options.preloadClass && $el.hasClass(options.preloadClass)) return true;
          
          var $c = $(options.container)    
          ,   ew = $el.width()
          ,   eh = $el.height()
          ,   el = $el.offset().left    
          ,   et = $el.offset().top    
          ,   cw = $c.width()   
          ,   ch    
          ,   cl  
          ,   ct;
          if (options.container === undefined || options.container === window){
            ch = window.innerHeight ? window.innerHeight : $window.height();
            cl = $window.scrollLeft();
            ct = $window.scrollTop();
          } else {
            ch = $c.height();
            cl = $c.offset().left;
            ct = $c.offset().top;
          }
          //     right                                left                                 bottom                               top
          return cl + cw > el - threshold && cl < el + ew + threshold && ct + ch > et - threshold && ct < et + eh + threshold   
        }
      
        function responsiveimages() {            
            var inview = images.filter(function() {
              var $element = $(this);
              if (options.skip_invisible && $element.is(":hidden")) return;
              return inviewport($element, options);  
            });
            loaded = inview.trigger("responsiveimages");
            images = images.not(loaded);
        }
        // use throttle plugin when present, otherwise this paceholder 
        if ($.throttle === undefined){$.throttle = function(delay, fun){return fun;};}; 
        $(options.container).scroll($.throttle(250,checkviewport));
   
        $window.resize(checkviewport);
        
        // allow external call to $.fn.responsiveimages.update()
        // eg on ascensor page transition
        $.fn.responsiveimages.update = checkviewport;
        
        findSmallestBreakpoint();
        checkviewport();
       
        return this;

    }

})(window.jQuery);