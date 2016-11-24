$(document).ready(function() {

    var starbars = $('.raty');

    var cancelBtn;

    //input ratings for the images and handling Click
    function setRating() {
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
                path: '/images/',
                cancel: cancelBtn,
                cancelHint: 'удалить оценку',
                score: rating,
                click: function (score) {
                    sendRating(score, elem);
                }
            });
        });

        starbars.each(function (i, elem) {
            if($(elem).data('userrate')){
                $(elem).addClass('gold')
        }
        });
    }

    setRating();

    //sending Ajax request on change of rating
    function sendRating(score, elem) {
        console.log(elem);
        $.ajax({
            url: "/rating/send",
            type: "POST",
            data: "pictureId=" + $(elem).data('id') + "&score=" + score,
            success: function (data) {
                $(elem).data("userrate", score);
                $(elem).data("rating", data);
                $(elem).prev().children().last().html(data);
                setRating();

            },
            error: function (data) {
                setRating(); //TODO обработать ошибку
            }
        });
    }
});
