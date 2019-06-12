$(function () {

    $(window).on('resize, scroll', function () {
        var stickyheaderScrolled = $(window).scrollTop();
        if (stickyheaderScrolled > 150) {
            $('.navbar-fixed-top').addClass('navbar-transition');
        } else {
            $('.navbar-fixed-top').removeClass('navbar-transition');
        }
    });

});
