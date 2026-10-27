(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    // Widget iframes follow the height of their content, so they have no inner scroll:
    // on widget step change (scrollToTop message), scroll the page back to the iframe top
    window.addEventListener('message', e => {
        const iframeElement = Array.from(document.querySelectorAll('iframe[src^="https://www.helloasso"]'))
            .find(iframe => iframe.contentWindow === e.source);

        if (!e.data || !iframeElement) {
            return;
        }

        if (e.data.height > parseFloat(iframeElement.style.height || iframeElement.height || 0)) {
            iframeElement.style.height = e.data.height + 'px';
        }

        if (e.data.scrollToTop && iframeElement.getBoundingClientRect().top < 0) {
            iframeElement.scrollIntoView({ behavior: 'smooth' });
        }
    });

    // Kept for pages cached with the former markup (onload="resizeIframeMessage()")
    window.resizeIframeMessage = function () {};

})(jQuery);