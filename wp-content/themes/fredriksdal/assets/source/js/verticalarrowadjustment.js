Fredriksdal = Fredriksdal || {};
Fredriksdal.VerticalArrowAdjustment = Fredriksdal.VerticalArrowAdjustment || {};

Fredriksdal.VerticalArrowAdjustment.VerticalArrowAdjustment = (function ($) {
    function VerticalArrowAdjustment() {
        this.adjustArrows();

        jQuery(window).on("resize",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("orientationchange",function(){
            this.adjustArrows();
        }.bind(this));
    }

    VerticalArrowAdjustment.prototype.adjustArrows = function () {
        jQuery('.flickity-prev-next-button').each(function(index,element) {
            jQuery(element).css('marginTop',-Math.abs(Math.floor(jQuery(element).siblings('.flickity-page-dots').outerHeight())));
        }.bind(this));
    };

    new VerticalArrowAdjustment();

})(jQuery);
