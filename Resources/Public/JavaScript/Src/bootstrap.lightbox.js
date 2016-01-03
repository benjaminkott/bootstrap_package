$(function () {

    /**
     * Basic lightbox implementation based on Bootstrap modals
     */
    if ($('a.lightbox').length > 0) {
        var $lightboxModal = '\
            <div class="modal fade" id="lightbox" tabindex="-1" role="dialog" aria-hidden="true">\
                <div class="modal-dialog modal-lightbox">\
                    <div class="modal-content">\
                        <div class="modal-body"></div>\
                    </div>\
                </div>\
            </div>\
        ';
        $('body').append($lightboxModal);
        $('.lightbox').click(function (event) {
            event.preventDefault();
            var $lightbox = $('#lightbox');
            var $modalBody = $lightbox.find('.modal-body');
            var $modalDialog = $lightbox.find('.modal-dialog');
            $modalBody.empty();
            $modalBody.append('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>');
            var $src = $(this).attr("href");
            var $image = "<img class=\"img-responsive\" src=\"" + $src + "\">";

            // FIX IMAGEWIDTH
            var img = new Image();
            img.onload = function () {
                $modalDialog.width(img.width);
                $modalDialog.css({"max-width": '95%'});
            };
            img.src = $src;

            $modalBody.append($image);
            var $title = $(this).attr("title");
            var $text = $(this).parent().find('.caption').html();
            if ($title || $text) {
                $modalBody.append('<div class="modal-caption"></div>');
                if ($title) {
                    $modalBody.find('.modal-caption').append("<span class=\"modal-caption-title\">" + $title + "</span>");
                }
                if ($text) {
                    $modalBody.find('.modal-caption').append($text);
                }
            }
            $('#lightbox').modal({show: true});
        });
    }

});