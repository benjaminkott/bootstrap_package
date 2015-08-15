$(function() {

    /**
     * Toggle collapsed class on navbar toggle button to change
     * the appereance of the toggle button when navbar is open
     */
    $('.navbar-collapse')
        .on('show.bs.collapse', function () {
            $('.navbar-toggle').removeClass('collapsed');
        })
        .on('hide.bs.collapse', function () {
            $('.navbar-toggle').addClass('collapsed');
    });

});