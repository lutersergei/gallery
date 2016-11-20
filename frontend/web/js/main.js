$(document).ready(function() {

    var starbars = $('.raty');

    var cancelBtn;
    starbars.each(function (i, elem) {
        var rating;

        if($(elem).data('userrate'))
        {
            rating = $(elem).data('userrate');
            cancelBtn = true;
        }
        else
        {
            rating = $(elem).data('rating');
            cancelBtn = false;
        }

        $(elem).raty({
            starType: 'i',
            cancel: cancelBtn,
            cancelHint: 'удалить оценку',
            half: true,
            score: rating,
            click: function (score) {
                var obj ={};
                obj.score = score;
                obj.elem = $(elem).data('id');
                sendRating(obj);
            }
        });
    });

    function sendRating(obj) {
        console.log(obj);

        $.ajax({
            url: "/rating/send",
            type: "POST",
            data: "picture=" + obj.elem + "&score=" + obj.score,
            success: function (data) {

            },
            error: function (data) {

            }
        });
    }
});
