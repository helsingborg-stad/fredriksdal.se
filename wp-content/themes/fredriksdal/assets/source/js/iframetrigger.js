Fredriksdal = Fredriksdal || {};
Fredriksdal.IframeTrigger = Fredriksdal.IframeTrigger || {};

Fredriksdal.IframeTrigger.IframeTrigger = (function ($) {

    var DisabledElementClass = 'disabled-iframe';

    var TargetIframes = [
        "iframe[src*='maps']",
    ];

    function IframeTrigger() {
        TargetIframes   .forEach(function(element) {
            jQuery(element).parent().addClass(DisabledElementClass);
            this.bindEnableClick(jQuery(element).parent());
        }.bind(this));
    }

    IframeTrigger.prototype.bindEnableClick = function (target) {
        jQuery(target).on('click',function(event){
            event.preventDefault();
            jQuery(target).removeClass(DisabledElementClass);
        }.bind(this));
    };

    return new IframeTrigger();

})(jQuery);
