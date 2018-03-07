$(function () {

    $('.custom-file-input').on('change', function(){
        var fileName = $(this).val().split('\\').slice(-1)[0];
        $(this).next('.custom-file-label').text(fileName);
    })

});
