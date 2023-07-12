window.addEventListener('DOMContentLoaded', function () {

    /**
     * Open PhotoSwipe
     */
    const openPhotoSwipe = function (index, gid) {

        const items = [];
        Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).forEach(function (element) {
            let title = null;
            if ("lightboxTitle" in element.dataset && element.dataset.lightboxTitle !== '') {
                title = element.dataset.lightboxTitle
            }
            let alternative = null;
            if ("lightboxAlt" in element.dataset && element.dataset.lightboxAlt !== '') {
                alternative = element.dataset.lightboxAlt
            }
            let caption = null;
            if ("lightboxCaption" in element.dataset && element.dataset.lightboxCaption !== '') {
                caption = element.dataset.lightboxCaption
                caption = caption.replace(/(?:\r\n|\r|\n)/g, '<br />');
            }

            let imgElement = null;
            if (element.querySelector('img')) {
                imgElement = element.querySelector('img');
            } else if (element.parentElement.querySelector('img')) {
                imgElement = element.parentElement.querySelector('img');
            }

            let item = {
                id: Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).indexOf(element),
                src: element.getAttribute('href'),
                width: element.dataset.lightboxWidth,
                height: element.dataset.lightboxHeight,
                title: title,
                alt: alternative,
                caption: caption,
                element: element,
                imgElement: imgElement,
            };

            items.push(item);
        });

        if (items.length > 0) {
            const gallery = new PhotoSwipeLightbox({
                dataSource: items,
                spacing: 0.12,
                bgOpacity: 1,
                showHideAnimationType: 'zoom',
                pswpModule: PhotoSwipe
            });
            gallery.addFilter('thumbEl', (thumbEl, data, index) => {
                if (data.imgElement) {
                    return data.imgElement;
                }
                return thumbEl;
            });
            new PhotoSwipeDynamicCaption(gallery, {
                type: 'auto',
                captionContent: (slide) => {
                    const item = slide.data;
                    let content = '';
                    if (item.title && item.title !== '') {
                        content += '<div class="pswp__dynamic-caption__title">' + item.title + '</div>';
                    }
                    if (item.caption && item.caption !== '') {
                        content += '<div class="pswp__dynamic-caption__subtitle">' + item.caption + '</div>';
                    }
                    return content;
                }
            });
            gallery.on('firstUpdate', () => {
                gallery.pswp.element.setAttribute('aria-modal', true);
                gallery.pswp.scrollWrap.ariaLabel = 'carousel';
                gallery.pswp.scrollWrap.removeAttribute('aria-roledescription');
            });
            gallery.init();
            gallery.loadAndOpen(index);
        }
    }

    /**
     * Register listener
     */
    Array.from(document.querySelectorAll('a.lightbox')).forEach(function (element) {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const gid = element.getAttribute('rel');
            const index = Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).indexOf(element);
            openPhotoSwipe(index, gid);
        });
    });

});
