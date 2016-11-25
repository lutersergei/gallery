$(document).ready(function() {
    var gallery = $('#gallery');
    if (gallery.length) {
        gallery.justifiedGallery({
            border: 1,
            justifyThreshold: 0.75,
            margins: 10,
            rowHeight: 130,
            maxRowHeight: 150
        }).on('jg.complete', function() {
            gallery.lightGallery({
                selector: '.picture',
                thumbnail: true
            });
        });
    }
});
