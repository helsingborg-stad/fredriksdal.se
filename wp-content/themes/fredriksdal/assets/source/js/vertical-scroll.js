Fredriksdal = Fredriksdal || {};
Fredriksdal.VerticalScroll = Fredriksdal.VerticalScroll || {};

Fredriksdal.VerticalScroll.VerticalScroll = (function ($) {

    var VertialScrollWrapper = '.modularity-onepage-section.section-horizontal-scroll';

    var VerticalScrollTargets = [
        '.widget-slider.grid .modularity-mod-posts .grid',
        '.widget-slider.grid .modularity-mod-index .grid',
        '.widget-slider.grid .modularity-mod-social ul.social-feed-instagram'
    ];

    var VerticalScrollSettigs = {
        cellAlign: 'left',
        contain: true,
        percentPosition: true
    };

    function VerticalScroll() {
        this.htmlWrapper();
        VerticalScrollTargets.forEach(function(element) {
            jQuery(VertialScrollWrapper + ' ' + element).flickity(VerticalScrollSettigs);
        }.bind(this));
    }

    VerticalScroll.prototype.htmlWrapper = function () {
       jQuery('html').addClass('no-flexbox');
    };

    new VerticalScroll();

})(jQuery);
