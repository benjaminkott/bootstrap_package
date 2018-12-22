/**
 * Scroll to top of collapsed/expanded accordion item
 */
$('.accordion').on('hide.bs.collapse', function (e) {
    var headingTop = $(e.target).prev('.accordion-header').offset().top - 5;
    var visibleTop = $(window).scrollTop();
    if (headingTop < visibleTop) {
        $('html,body').animate({
            scrollTop: headingTop
        }, 500);
    }
});
