$(document).ready(function() {

    var gallery = $('#gallery');
    if (gallery.length) {

        var handleMatchMedia = function (mediaQuery) {
                if (mediaQuery.matches) {
                    console.log('<');
                    gallery.justifiedGallery({
                        border: 1,
                        justifyThreshold: 0.75,
                        margins: 10,
                        rowHeight: 80,
                        maxRowHeight: 100
                    }).on('jg.complete', function () {
                        gallery.lightGallery({
                            selector: '.picture',
                            thumbnail: true
                        });
                    });
                } else {
                    console.log('>');
                    gallery.justifiedGallery({
                        border: 1,
                        justifyThreshold: 0.75,
                        margins: 10,
                        rowHeight: 130,
                        maxRowHeight: 150
                    }).on('jg.complete', function () {
                        gallery.lightGallery({
                            selector: '.picture',
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
