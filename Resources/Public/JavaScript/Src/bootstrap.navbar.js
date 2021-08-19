/* ========================================================================
 * Navbar
 * ======================================================================== */

$(function () {

    /**
     * Toggle collapsed class on navbar toggle button to change
     * the appearance of the toggle button when navbar is open
     */
     $('.navbar-collapse')
     .on('show.bs.collapse', function () {
         $('.navbar-toggle').removeClass('collapsed');
     })
     .on('hide.bs.collapse', function () {
         $('.navbar-toggle').addClass('collapsed');
     });

});


window.addEventListener('DOMContentLoaded', function() {

    /**
     * Solution to enable links on dropdowns, the link will only be triggered
     * if the dropdown is visible. On touch devices you will need to double
     * click on a dropdown, the first click will open the menu.
     */
    function navbarPointerOver(element) {
        let toggle = document.querySelector('.navbar-toggler');
        if (window.getComputedStyle(toggle).display === 'none' && element.classList.contains('open') === false) {
            Array.from(element.parentElement.parentElement.querySelectorAll('li')).forEach(function(listItem) {
                listItem.classList.remove('show');
            });
            element.classList.add('show');
            element.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'true');
            element.querySelector('.dropdown-menu').classList.add('show');
        }
    }
    function navbarPointerLeave(element) {
        let toggle = document.querySelector('.navbar-toggler');
        if (window.getComputedStyle(toggle).display === 'none') {
            element.classList.remove('show');
            element.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
            element.querySelector('.dropdown-menu').classList.remove('show');
        }
    }

    Array.from(document.querySelectorAll('li.dropdown-hover')).forEach(function(element) {
        element.addEventListener('pointerover', (e) => {
            if (e.pointerType === "mouse") {
                navbarPointerOver(element);
            }
        });
        element.addEventListener('mouseenter', () => {
            if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
                navbarPointerOver(element);
            }
        });
        element.addEventListener('pointerleave', (e) => {
            if (e.pointerType === "mouse") {
                navbarPointerLeave(element);
            }
        });
        element.addEventListener('mouseleave', () => {
            if (/^((?!chrome|android).)*safari/i.test(navigator.userAgent)) {
                navbarPointerLeave(element);
            }
        });
    });

    Array.from(document.querySelectorAll('.nav-link')).forEach(function(element) {
        element.addEventListener('click', (e) => {
            let listElement = element.parentElement;
            if (listElement.classList.contains('dropdown-hover') && listElement.classList.contains('show') === false) {
                let listElementSiblings = listElement.parentElement.querySelectorAll('.dropdown-hover');
                Array.from(listElementSiblings).forEach(function(listElementsSibling) {
                    listElementsSibling.setAttribute('aria-expanded', 'false')
                    listElementsSibling.classList.remove('show');
                });
                let listElementMenus = listElement.parentElement.querySelectorAll('.dropdown-menu');
                Array.from(listElementMenus).forEach(function(listElementMenu) {
                    listElementMenu.classList.remove('show');
                });
                listElement.classList.add('show');
                listElement.setAttribute('aria-expanded', 'true')
                listElement.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'true');
                listElement.querySelector('.dropdown-menu').classList.add('show');
                e.stopImmediatePropagation();
                e.preventDefault();
                return false;
            }
        });
    });

});
