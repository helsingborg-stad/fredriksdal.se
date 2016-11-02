Fredriksdal = Fredriksdal || {};
Fredriksdal.OffGrid = Fredriksdal.OffGrid || {};

Fredriksdal.OffGrid.OffGrid = (function ($) {

    var basicAdjustment = 45;

    function OffGrid() {
        this.adjustArrows();

        jQuery(window).on("resize",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("orientationchange",function(){
            this.adjustArrows();
        }.bind(this));
    }

    OffGrid.prototype.adjustArrows = function () {
        jQuery('.flickity-prev-next-button.next').each(function(index,element) {
            this.adjustTargetObject(element, 'right', -Math.abs(this.sectionOffsetSize())+basicAdjustment);
        }.bind(this));
        jQuery('.flickity-prev-next-button.previous').each(function(index,element) {
            this.adjustTargetObject(element, 'left', -Math.abs(this.sectionOffsetSize())+basicAdjustment);
        }.bind(this));
    };


    OffGrid.prototype.adjustTargetObject = function (object,edge,offset) {
        if(jQuery(object) && (edge == 'left' || edge == 'right' )) {
            jQuery(object).css(edge,offset);
        }
    };

    OffGrid.prototype.sectionOffsetSize = function () {
        var outerWidth = jQuery("section.modularity-onepage-section").outerWidth();
        var innerWidth = jQuery("section.modularity-onepage-section > .container").width();

        if(outerWidth !== 0 && innerWidth !== 0)  {
            return Math.floor((outerWidth-innerWidth)/2);
        }
        return false;
    };

    new OffGrid();

})(jQuery);
