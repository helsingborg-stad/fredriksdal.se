Fredriksdal = Fredriksdal || {};
Fredriksdal.ScrollHighlight = Fredriksdal.ScrollHighlight || {};

Fredriksdal.ScrollHighlight.ScrollHighlight = (function ($) {

    var ScrollTopValue = 0;

    var ScrollHighlightTrigger = 'section.modularity-onepage-section';

    var ScrollMenuWrapper = [
        '#main-menu'
    ];

    function ScrollHighlight() {
        ScrollTopValue = jQuery(window).scrollTop();
        $(window).on('scroll', function (e) {
            ScrollTopValue = jQuery(window).scrollTop();
            jQuery(ScrollHighlightTrigger).each(function (index,item) {

                var ItemScrollTopBottomEdge = (jQuery(item).offset().top + jQuery(item).outerHeight());

                console.log("Scroll:", ScrollTopValue);
                console.log("Item: ", ItemScrollTopBottomEdge);
                if(jQuery(item).offset().top > ScrollTopValue) {
                    console.log("hey hey");
                }
            });
        }.bind(this));
    }

    ScrollHighlight.prototype.isAnchorLink = function (href) {
        if(/^#/.test(href) === true && href.length > 1) {
            return true;
        } else {
            return false;
        }
    };

    ScrollHighlight.prototype.anchorLinkExists = function (id) {
        console.log(id);
        var linkExist = false;
        ScrollMenuWrapper.forEach(function(element) {
            if("a[href='" + id + "']",element) {
                linkExist = true;
                return true;
            }
        }.bind(this));
        return linkExist;
    };

    new ScrollHighlight();

})(jQuery);
