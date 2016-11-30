$(document).ready(function() {


    var gallery = $('#gallery');
    if (gallery.length) {

        var handleMatchMedia = function (mediaQuery) {
                if (mediaQuery.matches) {
                    gallery.justifiedGallery({
                        border: 5,
                        justifyThreshold: 0.75,
                        margins: 15,
                        rowHeight: 80,
                        maxRowHeight: 100
                    }).on('jg.complete', function () {
                        gallery.lightGallery({
                            selector: '.picture a',
                            thumbnail: true
                        });
                    });
                } else {
                    gallery.justifiedGallery({
                        border: 5,
                        justifyThreshold: 0.75,
                        margins: 15,
                        rowHeight: 130,
                        maxRowHeight: 150
                    }).on('jg.complete', function () {
                        gallery.lightGallery({
                            selector: '.picture a',
                            thumbnail: true
                        });
                    });
                }
            },

            mql = window.matchMedia('all and (max-width: 480px)');

        handleMatchMedia(mql);
        mql.addListener(handleMatchMedia);

    }
});
