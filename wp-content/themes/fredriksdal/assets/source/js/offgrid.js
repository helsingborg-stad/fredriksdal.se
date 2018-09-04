Fredriksdal = Fredriksdal || {};
Fredriksdal.OffGrid = Fredriksdal.OffGrid || {};

Fredriksdal.OffGrid.OffGrid = (function ($) {

    var basicAdjustment = -20;
    var maxAdjustment = 300;

    function OffGrid() {
        this.adjustArrows();

        jQuery(window).on("resize",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("orientationchange",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("load",function(){
            var imgSizeHeight = jQuery('.flickity-viewport .box-image-container').height() + jQuery('.flickity-viewport .box-content').height() ;
            //$('.flickity-viewport').height(imgSizeHeight);
        }.bind(this));
    }


    OffGrid.prototype.adjustArrows = function () {
        jQuery('.flickity-prev-next-button.next').each(function(index,element) {
            this.adjustTargetObject(element, 'right', -Math.abs(this.sectionOffsetSize())+this.offsetBySize());
        }.bind(this));
        jQuery('.flickity-prev-next-button.previous').each(function(index,element) {
            this.adjustTargetObject(element, 'left', -Math.abs(this.sectionOffsetSize())+this.offsetBySize());
        }.bind(this));
    };

    OffGrid.prototype.offsetBySize = function () {
        if(this.sectionOffsetSize() < basicAdjustment && this.sectionOffsetSize() > Math.floor(basicAdjustment/2)) {
            return Math.floor(basicAdjustment/2);
        } else if (this.sectionOffsetSize() < Math.floor(basicAdjustment/2)) {
            return Math.floor(basicAdjustment/3);
        }
        return basicAdjustment;
    }

    OffGrid.prototype.adjustTargetObject = function (object,edge,offset) {
        if(jQuery(object) && (edge == 'left' || edge == 'right' )) {
            jQuery(object).css(edge,offset);
        }
    };

    OffGrid.prototype.sectionOffsetSize = function () {
        var outerWidth = jQuery("section.modularity-onepage-section").outerWidth();
        var innerWidth = jQuery("section.modularity-onepage-section > .container").width();

        if(outerWidth !== 0 && innerWidth !== 0)  {
            if(Math.floor((outerWidth-innerWidth)/2) < maxAdjustment) {
                return Math.floor((outerWidth-innerWidth)/2);
            } else {
                return maxAdjustment;
            }

        }
        return false;
    };

    new OffGrid();

})(jQuery);
