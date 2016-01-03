$(function() {

    /**
     * Enable swipe support for bootstrap carousel
     */
    var hasSwipe = false;
    $(".carousel").each(function(){
        var carousel = new Hammer(this);
        carousel.on("swipeleft swiperight release", function(event) {
            if(event.type === "swipeleft"){
                hasSwipe = true;
                $(carousel.element).carousel('next');
            }
            if(event.type === "swiperight"){
                hasSwipe = true;
                $(carousel.element).carousel('prev');
            }
        });
    });

    /**
     * Prevent GhostClick directly after swiping
     */
    function preventGhostClick(event){
        if(hasSwipe){
            event.stopPropagation();
            event.preventDefault();
        }
        hasSwipe = false;
    }
    $(document).on('click', preventGhostClick);

});
