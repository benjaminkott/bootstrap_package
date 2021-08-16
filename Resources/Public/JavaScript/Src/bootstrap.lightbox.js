/* ========================================================================
 * Lightbox
 * ======================================================================== */

window.addEventListener('DOMContentLoaded', function() {

    /**
     * Add PhotoSwipe template to dom if lightbox elements exist.
     */
    if (document.querySelectorAll('a.lightbox').length > 0) {
        let photoswipeTemplate = '\
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
        document.getElementsByTagName('body')[0].insertAdjacentHTML('beforeend', photoswipeTemplate);
    }

    /**
     * Open PhotoSwipe
     */
    var openPhotoSwipe = function(pid, gid) {
        var photoswipeContainer = document.querySelectorAll('.pswp')[0];
        var items = [];

        Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).forEach(function(element) {
            let title = null;
            if (element.hasAttribute('title') && element.getAttribute('title') !== '') {
                title = element.getAttribute('title');
            }
            let caption = null;
            if ("lightboxCaption" in element.dataset && element.dataset.lightboxCaption !== '') {
                caption = element.dataset.lightboxCaption
            } else if (element.parentNode.querySelector('figcaption') && element.parentNode.querySelector('figcaption').textContent !== '') {
                caption = element.parentNode.querySelector('figcaption').textContent
            }
            if (caption) {
                caption = caption.replace(/(?:\r\n|\r|\n)/g, '<br />');
            }
            let item = {
                src: element.getAttribute('href'),
                title: title,
                w: element.dataset.lightboxWidth,
                h: element.dataset.lightboxHeight,
                caption: caption,
                pid: Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).indexOf(element)
            };
            if (element.querySelector('img')) {
                item.msrc = element.querySelector('img').getAttribute('src');
            }
            items.push(item);
        });

        var options = {
            index: pid,
            addCaptionHTMLFn: function(item, captionEl) {
                captionEl.children[0].innerHTML = '';
                if(item.title && item.title !== '') {
                    captionEl.children[0].innerHTML += '<div class="pswp__caption__title">' + item.title + '</div>';
                }
                if(item.caption && item.caption !== '') {
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
            getThumbBoundsFn: function(index) {
                let thumbnail = document.querySelectorAll('a.lightbox[rel=' + gid + ']')[index];
                let pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                let rect = thumbnail.getBoundingClientRect();
                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            },
        };
        if(items.length > 0) {
            var gallery = new PhotoSwipe(photoswipeContainer, PhotoSwipeUI_Default, items, options);
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
        openPhotoSwipe(parseInt(photoSwipeHashData.pid), photoSwipeHashData.gid);
    }

    /**
     * Register listener
     */
    Array.from(document.querySelectorAll('a.lightbox')).forEach(function(element) {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            let gid = element.getAttribute('rel');
            let pid = Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).indexOf(element);
            openPhotoSwipe(pid, gid);
        });
    });

});
