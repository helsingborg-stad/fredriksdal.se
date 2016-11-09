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
        AnchorScrollTargets.forEach(function(element) {
            jQuery("li a", element).click(function(){
                if(this.isAnchorLink(jQuery(element).attr('href'))) {
                    alert("anchoir");
                }
            });
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

    new MobileMenuAnchorClose();

})(jQuery);
