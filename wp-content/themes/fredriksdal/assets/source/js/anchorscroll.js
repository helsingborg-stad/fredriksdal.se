Fredriksdal = Fredriksdal || {};
Fredriksdal.AnchorScroll = Fredriksdal.AnchorScroll || {};

Fredriksdal.AnchorScroll.AnchorScroll = (function ($) {

    var AnchorScrollTriggers = [
        '#main-menu li a',
        '#mobile-menu li a'
    ];

    var AnchorScrollTargets = [
        'section'
    ];

    var AnchorScrollSettings = {
        scrollSpeed: 750,
        scrollOffset: 100
    };

    function AnchorScroll() {
        AnchorScrollTriggers.forEach(function(element) {
            if(this.isAnchorLink(jQuery(element).attr('href')) && this.anchorLinkExists(jQuery(element).attr('href'))) {
                this.bindAnchorScroll(element,jQuery(element).attr('href'));
            }
        }.bind(this));
    }

    AnchorScroll.prototype.isAnchorLink = function (href) {
        if(/^#/.test(href) === true && href.length > 1) {
            return true;
        } else {
            return false;
        }
    };

    AnchorScroll.prototype.anchorLinkExists = function (id) {
        var linkExist = false;
        AnchorScrollTargets.forEach(function(element) {
            if(jQuery(element + id).length) {
               linkExist = true;
               return true;
            }
        }.bind(this));
        return linkExist;
    };

    AnchorScroll.prototype.bindAnchorScroll = function (trigger,target) {
        jQuery(trigger).on('click',function(event){
            event.preventDefault();
            var targetOffset = jQuery(target).offset();
            jQuery('html, body').animate({scrollTop: Math.abs(targetOffset.top -Math.abs(AnchorScrollSettings.scrollOffset))}, AnchorScrollSettings.scrollSpeed, jQuery.bez([0.815, 0.020, 0.080, 1.215]));
        }.bind(this));
    };

    new AnchorScroll();

})(jQuery);
