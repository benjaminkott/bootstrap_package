$(function () {

    /**
     * Basic lightbox implementation based on Bootstrap modals
     */
    if ($('a.lightbox').length > 0) {

        var photoswipeTemplate = '\
            <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">\
                <div class="pswp__bg"></div>\
                <div class="pswp__scroll-wrap">\
                    <div class="pswp__container">\
                        <div class="pswp__item"></div>\
                        <div class="pswp__item"></div>\
                        <div class="pswp__item"></div>\
                    </div>\
                    <div class="pswp__ui pswp__ui--hidden">\
                        <div class="pswp__top-bar">\
                            <div class="pswp__counter"></div>\
                            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>\
                            <button class="pswp__button pswp__button--share" title="Share"></button>\
                            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>\
                            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>\
                            <div class="pswp__preloader">\
                                <div class="pswp__preloader__icn">\
                                    <div class="pswp__preloader__cut">\
                                        <div class="pswp__preloader__donut"></div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">\
                            <div class="pswp__share-tooltip"></div> \
                        </div>\
                        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>\
                        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>\
                        <div class="pswp__caption">\
                            <div class="pswp__caption__center"></div>\
                        </div>\
                    </div>\
                </div>\
            </div>';
        $('body').append(photoswipeTemplate);
        $('a.lightbox').on('click',function(e){
            e.preventDefault();
            $(this).addClass('photoswipe-trigger');
            var photoswipeContainer = document.querySelectorAll('.pswp')[0];
            var $trigger = $(this);
            var index = 0;
            var rel = $(this).attr('rel');
            var items = [];
            $('a.lightbox[rel=' + rel + ']').each(function(){
                if($(this).hasClass('photoswipe-trigger')){
                    index = items.length;
                }
                items.push({
                    src: $(this).attr('href'),
                    title: $(this).attr("title"),
                    w: $(this).data('lightbox-width'),
                    h: $(this).data('lightbox-height')
                });
            });
            var options = {
                index: index
            };
            var gallery = new PhotoSwipe( photoswipeContainer, PhotoSwipeUI_Default, items, options);
            gallery.init();
            $(this).removeClass('photoswipe-trigger');
        });
    };

});