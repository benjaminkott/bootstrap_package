var navelem = document.getElementsByClassName("navbar-fixed-top");
function animateHeader() {
	150<window.scrollY ? navelem[0].classList.add("navbar-transition") : navelem[0].classList.remove("navbar-transition");
}
['scroll', 'resize', 'DOMContentLoaded'].forEach(function(e) {
  window.addEventListener(e, animateHeader);
});
