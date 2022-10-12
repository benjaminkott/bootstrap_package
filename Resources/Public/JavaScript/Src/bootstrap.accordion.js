window.addEventListener('DOMContentLoaded', function () {

    /*
    * Scroll to top of collapsed/expanded accordion item
    */
    document.querySelectorAll('.accordion').forEach(function (element) {
        element.addEventListener('shown.bs.collapse', function (event) {
            const accordionHeader = event.target.previousElementSibling;
            if (accordionHeader) {
                const headingTop = accordionHeader.getBoundingClientRect().top + window.scrollY - 5;
                if (headingTop < window.scrollY) {
                    scroll({
                        top: headingTop,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

});
