/**
 * Scroll to top of collapsed/expanded accordion item
 */
$('.accordion').on('hide.bs.collapse', function (e) {
    var $accordionHeader = $(e.target).prev('.accordion-header')
    if ($accordionHeader.length > 0) {
        var headingTop = $accordionHeader.offset().top - 5;
        var visibleTop = $(window).scrollTop();
        if (headingTop < visibleTop) {
            $('html,body').animate({
                scrollTop: headingTop
            }, 500);
        }
    }
});

