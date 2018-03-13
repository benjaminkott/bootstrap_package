$(function () {

    /**
     * Add PhotoSwipe template to dom if lightbox elements exist.
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
    }

    /**
     * Open PhotoSwipe
     */
    var openPhotoSwipe = function(pid, gid) {
        var photoswipeContainer = document.querySelectorAll('.pswp')[0];
        var items = [];

        $('a.lightbox[rel=' + gid + ']').each(function(){
            var caption = '';
            if($(this).data('lightbox-caption')) {
                caption = $(this).data('lightbox-caption');
            } else {
                caption = $(this).next('figcaption').text();
            }
            items.push({
                src: $(this).attr('href'),
                title: $(this).attr("title"),
                w: $(this).data('lightbox-width'),
                h: $(this).data('lightbox-height'),
                caption: caption.replace(/(?:\r\n|\r|\n)/g, '<br />'),
                pid: $(this).index('a.lightbox[rel=' + gid + ']'),
            });
        });
        var options = {
            index: pid,
            addCaptionHTMLFn: function(item, captionEl, isFake) {
                if(!item.title) {
                    captionEl.children[0].innerHTML = '';
                    return false;
                }
                captionEl.children[0].innerHTML = '<div class="pswp__caption__title">' + item.title + '</div>';
                if(item.caption) {
                    captionEl.children[0].innerHTML += '<div class="pswp__caption__subtitle">' + item.caption + '</div>';
                }
                return true;
            },
            spacing:        0.12,
            loop:           true,
            bgOpacity:      1,
            closeOnScroll:  true,
            history:        true,
            galleryUID:     gid,
            galleryPIDs:    true,
            closeEl:        true,
            captionEl:      true,
            fullscreenEl:   true,
            zoomEl:         true,
            shareEl:        false,
            counterEl:      true,
            arrowEl:        true,
            preloaderEl:    true,
        };
        if(items.length > 0) {
            var gallery = new PhotoSwipe( photoswipeContainer, PhotoSwipeUI_Default, items, options);
            gallery.init();
        }
    }

    /**
     * Get PhotoSwipe params from url hash and open gallery
     */
    var getPhotoSwipeParamsFromHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};
        if(hash.length < 5) {
            return params;
        }
        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }
        return params;
    };
    var photoSwipeHashData = getPhotoSwipeParamsFromHash();
    if(photoSwipeHashData.pid && photoSwipeHashData.gid) {
        openPhotoSwipe( parseInt(photoSwipeHashData.pid) , photoSwipeHashData.gid);
    }

    /**
     * Register listener
     */
    $('a.lightbox').on('click',function(e){
        e.preventDefault();
        var gid = $(this).attr('rel');
        var pid = $(this).index('a.lightbox[rel=' + gid + ']');
        openPhotoSwipe(pid, gid);
    });

});
