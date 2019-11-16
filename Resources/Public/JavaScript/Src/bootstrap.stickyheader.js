function animateHeader() {
    150<$(window).scrollTop() ? $(".navbar-fixed-top").addClass("navbar-transition") : $(".navbar-fixed-top").removeClass("navbar-transition")
}
document.addEventListener("DOMContentLoaded", function(n) {
    animateHeader()
}), $(function() {
    $(window).on("resize, scroll", function() {
        animateHeader()
    })
});
