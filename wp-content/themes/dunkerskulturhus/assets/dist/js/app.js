var DunkersKultur;

DunkersKultur = DunkersKultur || {};
DunkersKultur.Liquid = DunkersKultur.Liquid || {};

DunkersKultur.Liquid.Liquid = (function ($) {

	var TopOffset = 5;
	var TargetElement = "#site-header";
	var JqClassName = "liquid-header";

	function Liquid() {
        jQuery(function(){
            this.process();
        	jQuery(window).scroll(function(){
        		this.process();
        	}.bind(this));
        }.bind(this));
    }

    Liquid.prototype.process = function () {
        if (jQuery(window).scrollTop() < TopOffset) {
            this.removeClass();
        } else {
            this.addClass();
        }
    }

	Liquid.prototype.addClass = function () {
	   jQuery(TargetElement).addClass(JqClassName);
    };

    Liquid.prototype.removeClass = function () {
		 jQuery(TargetElement).removeClass(JqClassName);
    };

    Liquid.prototype.updateTriggerValue = function () {
        if( jQuery(TargetElement).attr('data-trigger-value') && this.isInt( jQuery(TargetElement).attr('data-trigger-value') ) ) {
            TopOffset = jQuery(TargetElement).attr('data-trigger-value');
        }
    };

    Liquid.prototype.isInt = function (value) {
        var x;
        if (isNaN(value)) { return false; }
        x = parseFloat(value);
        return (x | 0) === x;
    };

	return new Liquid();

})(jQuery);

DunkersKultur = DunkersKultur || {};
DunkersKultur.ScrollPlease = DunkersKultur.ScrollPlease || {};

DunkersKultur.ScrollPlease.ScrollPlease = (function ($) {

    function ScrollPlease() {
        $(window).on('scroll', function (e) {
            var scrollPos = $(e.target).scrollTop();

            if (scrollPos > 100) {
                $('.scroll-down-please').fadeOut();
            } else {
                $('.scroll-down-please').fadeIn();
            }
        });
    }

    return new ScrollPlease();

})(jQuery);

DunkersKultur = DunkersKultur || {};
DunkersKultur.Wording = DunkersKultur.Wording || {};

DunkersKultur.Wording.Wording = (function ($) {

    function Wording() {
        this.SplitString(jQuery("h1"));
    }

    Wording.prototype.SplitString = function (targetObject) {
        var originalText = targetObject.text().trim().split(" ");
        var boldWording = originalText.splice(0,originalText.length / 2);
        targetObject.html((boldWording.length > 0 ? "<span class='bold-wording'>"+ boldWording.join(" ") + "</span> " : boldWording) + originalText.join(" "));
    };

    return new Wording();

})(jQuery);
