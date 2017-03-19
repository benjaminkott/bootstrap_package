(function($){

    //
    // Smooth Sroll
    //
    $('a[href*="#"]:not([href$="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'')
            && location.hostname === this.hostname
            && $(this).data('toggle') === undefined
            && $(this).data('slide') === undefined) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                var navbar = $('.navbar-fixed-top');
                if(navbar.length && targetOffset !== 0){
                    targetOffset -= navbar.outerHeight();
                }
                $('html,body').animate({scrollTop: targetOffset}, 500);
                return false;
            }
        }
    });

    //
    // Scroll to top
    //
    $('.scroll-top').on('click', function() {
        $(this).blur();
    });
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $('.scroll-top').addClass('scroll-top-visible');
        } else {
            $('.scroll-top').removeClass('scroll-top-visible');
        }
    });

})(jQuery);
