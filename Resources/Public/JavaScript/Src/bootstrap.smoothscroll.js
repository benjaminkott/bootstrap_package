window.addEventListener('DOMContentLoaded', function () {

    /*
     * Smooth Sroll
     */
    const ankers = document.querySelectorAll('a[href*="#"]:not([href^="http"]):not([href$="#"])');
    ankers.forEach(function (anker) {
        anker.addEventListener('click', function (event) {
            event.preventDefault();
            const element = event.currentTarget;
            if (location.pathname.replace(/^\//, '') === element.pathname.replace(/^\//, '')
                && location.hostname === element.hostname
                && element.dataset.toggle === undefined
                && element.dataset.slide === undefined) {
                let target = document.querySelectorAll(element.hash.replace(/(:|\.|\[|\]|,|=|\/)/g, '\\$1'));
                target = target.length && target || document.querySelectorAll('[name=' + element.hash.slice(1) + ']');
                if (target.length) {
                    let targetOffset = target[0].getBoundingClientRect().top + window.scrollY;
                    const navbar = document.querySelector('.navbar-fixed-top');
                    if (navbar && targetOffset !== 0) {
                        targetOffset -= navbar.getBoundingClientRect().height;
                    }
                    scroll({
                        top: targetOffset,
                        behavior: "smooth"
                    });
                    return false;
                }
            }
        });
    });

    /*
     * Scroll to top
     */
    document.querySelector('.scroll-top').addEventListener('click', function (event) {
        event.currentTarget.blur();
    });

    window.addEventListener('scroll', function (event) {
        if (window.scrollY > 300) {
            document.querySelector('.scroll-top').classList.add('scroll-top-visible');
        } else {
            document.querySelector('.scroll-top').classList.remove('scroll-top-visible');
        }
    });

});
