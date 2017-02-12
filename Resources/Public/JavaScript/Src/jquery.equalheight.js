/* ==========================================================================================
 * Bootstrap Package: jquery.equalheight.js
 * -----------
 * Measure height of columns in a row and set their height to the tallest one.
 *
 * Container: [data-equalheight=container]
 * Item: [data-equalheight=item]
 *
 * Inspired by:
 * https://css-tricks.com/equal-height-blocks-in-rows/
 *
 * Copyright 2014-2015 Benjamin Kott
 * Licensed under MIT (https://github.com/benjaminkott/bootstrap_package/blob/master/LICENSE)
 * ========================================================================================== */

+function ($) {

    // EQUALHEIGHT CLASS DEFINITION
    // ============================
    var EqualHeight = function(container) {
        this.$container = $(container);
        this.$elements = this.$container.find('[data-equalheight=item]');
        this.init();
    };

    EqualHeight.prototype.init = function() {
        this.process();
    };

    EqualHeight.prototype.reset = function() {
        this.$elements.height('auto');
    };

    EqualHeight.prototype.process = function() {
        this.reset();
        var rowElements = [],
            rowStart = null,
            rowTallest = null,
            topPosition = 0,
            $elements = this.$elements;
        $elements.each(function() {
            var $element = $(this);
            if (!$element.is(':hidden')) {
                topPosition = $element.offset().top;
                if (rowStart !== topPosition) {
                    rowElements.length = 0;
                    rowStart = topPosition;
                    rowTallest = $element.outerHeight();
                    rowElements.push($element);
                } else {
                    rowElements.push($element);
                    rowTallest = (rowTallest < $element.outerHeight()) ? ($element.outerHeight()) : (rowTallest);
                }
                rowTallest = Math.ceil(rowTallest);
                $.each(rowElements, function(){
                    var difference = $(this).outerHeight() - $(this).height();
                    $(this).height(rowTallest - difference);
                });
            }
        });
    };


    // EQUALHEIGHT PLUGIN DEFINITION
    // =============================
    function Plugin() {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('bk2k.equalheight');
            if (!data) {
                $this.data('bk2k.equalheight', (data = new EqualHeight(this)));
            } else {
                data.process();
            }
        });
    }

    var old = $.fn.equalheight;

    $.fn.equalheight = Plugin;
    $.fn.equalheight.Constructor = EqualHeight;

    // EQUALHEIGHT NO CONFLICT
    // =======================
    $.fn.equalheight.noConflict = function() {
        $.fn.carousel = old;
        return this;
    };

    // EQUALHEIGHT DATA-API
    // ====================
    $(window).on('load resize calculate.bk2k.equalheight', function() {
        $('[data-equalheight=container]').each(function() {
            var $equalheight = $(this);
            Plugin.call($equalheight, $equalheight.data());
        });
    });

    // RESPONSIVE IMAGES
    // =================
    $('img').on('load', function() {
        $(window).trigger('calculate.bk2k.equalheight');
    });

}(jQuery);
