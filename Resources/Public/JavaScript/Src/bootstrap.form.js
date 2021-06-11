/* ========================================================================
 * Form
 * ======================================================================== */

window.addEventListener('DOMContentLoaded', function() {
    Array.from(document.querySelectorAll('.custom-file-input')).forEach(function(element) {
        element.addEventListener('change', (e) => {
            let value = element.value.split('\\').slice(-1)[0];
            element.nextElementSibling.textContent = value;
        });
    });
});
