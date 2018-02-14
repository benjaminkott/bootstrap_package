$(function() {

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

    /**
     * Solution to enable links on dropdowns, the link will only be triggered
     * if the dropdown is visible. On touch devices you will need to double
     * click on a dropdown, the first click will open the menu.
     */
    $(document).on('pointerover', 'li.dropdown-hover', function (e) {
        if (e.originalEvent.pointerType === "mouse" && $('.navbar-toggler').is(':hidden') && !$(this).hasClass('open')) {
            $(this).parent().parent().find('li').removeClass('show');
            $(this).addClass('show');
            $(this).find('> .dropdown-toggle').attr("aria-expanded", "true");
            $(this).find('> .dropdown-menu').addClass('show');
        }
    });
    $(document).on('pointerleave', 'li.dropdown-hover', function (e) {
        if (e.originalEvent.pointerType === "mouse" && $('.navbar-toggler').is(':hidden')) {
            $(this).removeClass('show');
            $(this).find('> .dropdown-toggle').attr("aria-expanded", "false");
            $(this).find('> .dropdown-menu').removeClass('show');
        }
    });
    $(document).on('click', '.nav-link', function(e) {
        if ($(this).parent().hasClass('dropdown-hover') && !$(this).parent().hasClass('show')) {
            $(this).parent().parent().find('.dropdown-hover').removeClass('show');
            $(this).parent().parent().find('.dropdown-hover').find('> .dropdown-toggle').attr("aria-expanded", "false");
            $(this).parent().parent().find('.dropdown-hover').find('> .dropdown-menu').removeClass('show');
            $(this).parent().addClass('show');
            $(this).parent().find('> .dropdown-toggle').attr("aria-expanded", "true");
            $(this).parent().find('> .dropdown-menu').addClass('show');
            e.stopImmediatePropagation();
            e.preventDefault();
            return false;
        }
    });

});
