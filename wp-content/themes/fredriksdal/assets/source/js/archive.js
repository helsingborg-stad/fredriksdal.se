Fredriksdal = Fredriksdal || {};
Fredriksdal.Archive = Fredriksdal.Archive || {};

Fredriksdal.Archive.Archive = (function ($) {
    function Archive() {
        $(".show-post").on("click", function () {
            Archive.prototype.toogleShowPost($(this));
        }).bind(this);

        Archive.prototype.responsiveMedia();

        $(window).resize(function () {
            Archive.prototype.responsiveMedia();
        });
    };

    Archive.prototype.responsiveMedia = function () {
        if ($(window).width() < 769) {
            var int = 0;
            $(".show-post-hidden-archive").each(function (int) {
                if (int >= 8) {
                    $(this).addClass('hidden');
                }
                int++;
            });
        }
    };


    Archive.prototype.toogleShowPost = function (thisObj) {
        if (thisObj.hasClass('show-all-post')) {
            thisObj.removeClass('show-all-post');
            thisObj.addClass('show-less-post');
            thisObj.text('Se mindre programpunkter');
            $('.show-post-hidden-archive').removeClass('hidden');
            $('.fade-bottom').addClass('hidden');
        }
        else {
            thisObj.addClass('show-all-post');
            thisObj.removeClass('show-less-post');
            $('.fade-bottom').removeClass('hidden');
            thisObj.text('Se alla programpunkter');
            var int = 0;
            $(".show-post-hidden-archive").each(function (int) {
                if (int > 11) {
                    $(this).addClass('hidden');
                }
                int++;
            });

        }
    };

    new Archive();

})(jQuery);