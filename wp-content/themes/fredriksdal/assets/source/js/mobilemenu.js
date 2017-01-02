Fredriksdal = Fredriksdal || {};
Fredriksdal.MobileMenuAnchorClose = Fredriksdal.MobileMenuAnchorClose || {};

Fredriksdal.MobileMenuAnchorClose.MobileMenuAnchorClose = (function ($) {

    var MobileMenuWrapper = [
        '#mobile-menu'
    ];

    var AnchorScrollTargets = [
        'section'
    ];

    function MobileMenuAnchorClose() {
        MobileMenuWrapper.forEach(function(element) {
            jQuery("li a",element).each(function(index,item) {
                if(this.isAnchorLink(jQuery(item).attr('href')) && this.anchorLinkExists(jQuery(item).attr('href'))) {
                    this.bindAnchorClose(item,jQuery(item).attr('href'));
                }
            }.bind(this));
        }.bind(this));
    }

    MobileMenuAnchorClose.prototype.isAnchorLink = function (href) {
        if(/^#/.test(href) === true && href.length > 1) {
            return true;
        } else {
            return false;
        }
    };

    MobileMenuAnchorClose.prototype.anchorLinkExists = function (id) {
        var linkExist = false;
        AnchorScrollTargets.forEach(function(element) {
            if(jQuery(element + id).length) {
               linkExist = true;
               return true;
            }
        }.bind(this));
        return linkExist;
    };

    MobileMenuAnchorClose.prototype.bindAnchorClose = function (trigger,target) {
        jQuery(trigger).on('click',function(event){
            event.preventDefault();
            jQuery('a[href="#mobile-menu"]').trigger('click');
        }.bind(this));
    };

    new MobileMenuAnchorClose();

})(jQuery);
