window.addEventListener('DOMContentLoaded', function () {

    /*
     * Updates aria-current on transition on the carousel items
     */
    document.querySelectorAll('.carousel').forEach(function (element) {
        element.addEventListener('slid.bs.carousel', function (event) {
            const container = event.target;
            container.querySelectorAll('.carousel-item').forEach((element) => {
                element.ariaCurrent = false;
            });
            const element = event.relatedTarget;
            element.ariaCurrent = true;
        });
    });

});
