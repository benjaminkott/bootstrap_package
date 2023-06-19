window.addEventListener('DOMContentLoaded', function () {

    /*
     * Toggle collapsed class on navbar toggle button to change
     * the appearance of the toggle button when navbar is open
     */
    const navbarCollapse = document.querySelectorAll('.navbar-collapse');
    navbarCollapse.forEach(
        function (navbar) {
            navbar.addEventListener('show.bs.collapse', function () {
                document.querySelectorAll('.navbar-toggle').forEach(function (element) {
                    element.classList.remove('collapsed');
                });
            });
            navbar.addEventListener('hide.bs.collapse', function () {
                document.querySelectorAll('.navbar-toggle').forEach(function (element) {
                    element.classList.add('collapsed');
                });
            });
        }
    );

});
