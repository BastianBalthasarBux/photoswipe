import PhotoSwipeLightbox from './photoswipe-lightbox.esm.js';

import PhotoSwipeDynamicCaption from './photoswipe-dynamic-caption-plugin.esm.js';

/**
 * lightbox for linkWizard
 * @type {PhotoSwipeLightbox}
 */
const linkHandlerLightbox = new PhotoSwipeLightbox({
    gallery: 'body',
    mainClass: 'pswp--layer-wrapper',
    children: '[data-ispsw-layer]',
    pswpModule: () => import('./photoswipe.esm.js')
    // arrowKeys: false
});
linkHandlerLightbox.addFilter('itemData', (itemData, index) => {
    const iframeUrl = itemData.element.dataset.iframeUrl;
    if (iframeUrl) {
        itemData.iframeUrl = iframeUrl;
    }
    return itemData;
});
linkHandlerLightbox.on('contentLoad', (e) => {
    const { content } = e;
    if (content.type === 'iframe') {
        e.preventDefault();
        content.element = document.createElement('div');
        content.element.className = 'pswp__iframe-container';

        const iframe = document.createElement('iframe');
        iframe.setAttribute('allowfullscreen', '');
        iframe.src = content.data.iframeUrl;
        content.element.appendChild(iframe);
    }
    if (content.type === 'html') {
        e.preventDefault();
        content.element = document.createElement('div');
        content.element.className = 'pswp__html-container';

        console.log([content.data.element.dataset.html]);

        const html = document.createElement('div');
        html.setAttribute('class', 'wrapper');
        html.innerHTML = decodeURIComponent(content.data.element.dataset.html);
        content.element.appendChild(html);
    }
});
linkHandlerLightbox.init();

/**
 * lightbox for click-enlarge content elements
 * @type {PhotoSwipeLightbox}
 */
const imageLightbox = new PhotoSwipeLightbox({
    gallery: '.ce-gallery',
    children: '[data-ispsw-img]',
    pswpModule: () => import('./photoswipe.esm.js')
});
const captionPlugin = new PhotoSwipeDynamicCaption(imageLightbox, {
    type: 'auto',
    captionContent: (slide) => {
        let captionTitle = '';
        let titleTxt = '';
        let altTxt = '';
        try {
            titleTxt = slide.data.element.querySelector('img').getAttribute('title');
            altTxt = slide.data.element.querySelector('img').getAttribute('alt')
        } catch (e) {
            // fallback do nothing for now if no img tag (e.g. inline svg).
        }
        if (!!titleTxt) {
            captionTitle = '<strong>' + titleTxt + '</strong><br>';
        }
        return captionTitle + altTxt;
    }
});
imageLightbox.init();

/**
 * Base 64 image preview and lazy load
 */
document.addEventListener('DOMContentLoaded', function () {
    let lazyImages = [].slice.call(document.querySelectorAll('img.lazy64'));
    let lazyBgImages = [].slice.call(document.querySelectorAll('.lazy64bg'));

    if ('IntersectionObserver' in window) {

        // images
        let lazyImageObserver = new IntersectionObserver(
            function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
        lazyImages.forEach(function (lazyImage) {
            lazyImageObserver.observe(lazyImage);
        });

        // bg-images
        let lazyBgImageObserver = new IntersectionObserver(
            function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        let lazyBgImage = entry.target;
                        lazyBgImage.style.backgroundImage = 'url(\'' + lazyBgImage.dataset.src + '\')';
                        lazyBgImageObserver.unobserve(lazyBgImage);
                    }
                });
            });
        lazyBgImages.forEach(function (lazyBgImage) {
            lazyBgImageObserver.observe(lazyBgImage);
        });
    } else {
        // For browsers that don't support IntersectionObserver yet,
        // load all the images now:
        lazyImages.forEach(function (lazyImage) {
            lazyImage.src = lazyImage.dataset.src;
        });
        lazyBgImages.forEach(function (lazyBgImage) {
            lazyBgImage.style.backgroundImage = 'url(\'' + lazyBgImage.dataset.src + '\')';
        });

    }
});
