Fredriksdal = Fredriksdal || {};
Fredriksdal.ScrollHighlight = Fredriksdal.ScrollHighlight || {};

Fredriksdal.ScrollHighlight.ScrollHighlight = (function ($) {

    var ScrollTopValue = 0;

    var ScrollMenuWrapperActiveClass = 'active current-menu-item';

    var ScrollHighlightTrigger = 'section.modularity-onepage-section';

    var ScrollMenuWrapper = [
        '#main-menu'
    ];

    function ScrollHighlight() {
        ScrollTopValue = jQuery(window).scrollTop();
        jQuery(window).on('scroll', function (e) {
            var scrolledToItem = null;
            ScrollTopValue = jQuery(window).scrollTop();
            jQuery(ScrollHighlightTrigger).each(function (index,item) {
                if(ScrollTopValue >= jQuery(item).offset().top) {
                    scrolledToItem = item;
                    return;
                }
            });
            this.highlightMenuItem("#" + jQuery(scrolledToItem).attr('id'));
        }.bind(this));
    }

    ScrollHighlight.prototype.highlightMenuItem = function (id) {
        if(this.isAnchorLink(id) && this.anchorLinkExists(id)){
            ScrollMenuWrapper.forEach(function(element) {
                jQuery("a[href='" + id + "']", element).parent('li').addClass(ScrollMenuWrapperActiveClass);
            });
        }
    };

    ScrollHighlight.prototype.isAnchorLink = function (href) {
        if(/^#/.test(href) === true && href.length > 1) {
            return true;
        } else {
            return false;
        }
    };

    ScrollHighlight.prototype.anchorLinkExists = function (id) {
        var linkExist = false;
        ScrollMenuWrapper.forEach(function(element) {
            if(jQuery("a[href='" + id + "']",element).length) {
                linkExist = true;
                return true;
            }
        }.bind(this));
        return linkExist;
    };

    ScrollHighlight.prototype.cleanHighlight = function (id) {
        ScrollMenuWrapper.forEach(function(element) {
            jQuery("li",element).removeClass(ScrollMenuWrapperActiveClass);
        }.bind(this));
    };

    new ScrollHighlight();

})(jQuery);
