Fredriksdal = Fredriksdal || {};
Fredriksdal.HorizontalScroll = Fredriksdal.HorizontalScroll || {};

Fredriksdal.HorizontalScroll.HorizontalScroll = (function ($) {

    var HorizontalScrollWrapper = '.modularity-onepage-section.section-horizontal-scroll';

    var HorizontalScrollTargets = [
        '.widget-slider.grid .modularity-mod-posts .grid',
        '.widget-slider.grid .modularity-mod-index .grid',
        '.widget-slider.grid .modularity-mod-social ul.social-feed-instagram'
    ];

    var HorizontalScrollSettigs = {
        cellAlign: 'left',
        contain: true,
        percentPosition: true,
        groupCells: true
    };

    function HorizontalScroll() {
        this.htmlWrapper();
        HorizontalScrollTargets.forEach(function(element) {
            jQuery(HorizontalScrollWrapper + ' ' + element).flickity(HorizontalScrollSettigs);
        }.bind(this));
    }

    HorizontalScroll.prototype.htmlWrapper = function () {
       jQuery('html').addClass('no-flexbox');
    };

    new HorizontalScroll();

})(jQuery);
