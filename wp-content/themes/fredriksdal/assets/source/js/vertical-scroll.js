Fredriksdal = Fredriksdal || {};
Fredriksdal.VerticalScroll = Fredriksdal.VerticalScroll || {};

Fredriksdal.VerticalScroll.VerticalScroll = (function ($) {

    var VertialScrollWrapper = '.modularity-onepage-section.section-horizontal-scroll';

    var VerticalScrollTargets = [
        '.grid .widget-slider'
    ];

    var VerticalScrollSettigs = {
        cellAlign: 'left',
        contain: true
    };

    function VerticalScroll() {
        VerticalScrollTargets.forEach(function(element) {
            jQuery(VertialScrollWrapper + ' ' + element).flickity(VerticalScrollSettigs);
        }.bind(this));
    }

    new VerticalScroll();

})(jQuery);
