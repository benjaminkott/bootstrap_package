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
        if (e.originalEvent.pointerType === "mouse" && $('.navbar-toggle').is(':hidden') && !$(this).hasClass('open')) {
            $(this).parent().parent().find('li').removeClass('open');
            $(this).addClass('open');
        }
    });
    $(document).on('pointerleave', 'li.dropdown-hover', function (e) {
        if (e.originalEvent.pointerType === "mouse" && $('.navbar-toggle').is(':hidden')) {
            $(this).removeClass('open');
        }
    });
    $(document).on('click', '.dropdown-link', function(e) {
        if ($(this).parent().hasClass('dropdown-hover') && !$(this).parent().hasClass('open')) {
            $(this).parent().parent().find('.dropdown-hover').removeClass('open');
            $(this).parent().addClass('open');
            e.stopImmediatePropagation();
            e.preventDefault();
            return false;
        }
    });

});
