$(function() {

	/**
	 * Enable swipe support for bootstrap carousel
	 */
	$(".carousel").each(function(){
		var carousel = new Hammer(this);
		carousel.on("swipeleft swiperight", function(event) {
			if(event.type === "swipeleft"){
				$(carousel.element).carousel('next');
			}
			if(event.type === "swiperight"){
				$(carousel.element).carousel('prev');
			}
		});
	});

});
