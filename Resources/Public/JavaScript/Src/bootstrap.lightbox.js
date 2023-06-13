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
            } else if (element.hasAttribute('title') && element.getAttribute('title') !== '') {
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
            if (!title && !!caption) {
                // If title is not given but caption is, swap properties to workaround an issue where photoswipe doesn't
                // show the description
                title = caption;
                caption = null;
            }
            let item = {
                id: Array.from(document.querySelectorAll('a.lightbox[rel=' + gid + ']')).indexOf(element),
                src: element.getAttribute('href'),
                width: element.dataset.lightboxWidth,
                height: element.dataset.lightboxHeight,
                title: title,
                caption: caption,
                element: element,
            };
            if (element.querySelector('img')) {
                item.msrc = element.querySelector('img').getAttribute('src');
            }
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
                gallery.pswp.element.ariaModal = true;
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
