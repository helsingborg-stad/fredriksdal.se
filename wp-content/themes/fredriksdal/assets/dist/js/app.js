/*!
 * Bez @VERSION
 * http://github.com/rdallasgray/bez
 *
 * A plugin to convert CSS3 cubic-bezier co-ordinates to jQuery-compatible easing functions
 *
 * With thanks to Nikolay Nemshilov for clarification on the cubic-bezier maths
 * See http://st-on-it.blogspot.com/2011/05/calculating-cubic-bezier-function.html
 *
 * Copyright @YEAR Robert Dallas Gray. All rights reserved.
 * Provided under the FreeBSD license: https://github.com/rdallasgray/bez/blob/master/LICENSE.txt
 */
(function(factory) {
  if (typeof exports === "object") {
    factory(require("jquery"));
  } else if (typeof define === "function" && define.amd) {
    define(["jquery"], factory);
  } else {
    factory(jQuery);
  }
}(function($) {
  $.extend({ bez: function(encodedFuncName, coOrdArray) {
    if ($.isArray(encodedFuncName)) {
      coOrdArray = encodedFuncName;
      encodedFuncName = 'bez_' + coOrdArray.join('_').replace(/\./g, 'p');
    }
    if (typeof $.easing[encodedFuncName] !== "function") {
      var polyBez = function(p1, p2) {
        var A = [null, null], B = [null, null], C = [null, null],
            bezCoOrd = function(t, ax) {
              C[ax] = 3 * p1[ax], B[ax] = 3 * (p2[ax] - p1[ax]) - C[ax], A[ax] = 1 - C[ax] - B[ax];
              return t * (C[ax] + t * (B[ax] + t * A[ax]));
            },
            xDeriv = function(t) {
              return C[0] + t * (2 * B[0] + 3 * A[0] * t);
            },
            xForT = function(t) {
              var x = t, i = 0, z;
              while (++i < 14) {
                z = bezCoOrd(x, 0) - t;
                if (Math.abs(z) < 1e-3) break;
                x -= z / xDeriv(x);
              }
              return x;
            };
        return function(t) {
          return bezCoOrd(xForT(t), 1);
        }
      };
      $.easing[encodedFuncName] = function(x, t, b, c, d) {
        return c * polyBez([coOrdArray[0], coOrdArray[1]], [coOrdArray[2], coOrdArray[3]])(t/d) + b;
      }
    }
    return encodedFuncName;
  }});
}));

(function($){

    /**
     * Copyright 2012, Digital Fusion
     * Licensed under the MIT license.
     * http://teamdf.com/jquery-plugins/license/
     *
     * @author Sam Sehnert
     * @desc A small plugin that checks whether elements are within
     *       the user visible viewport of a web browser.
     *       only accounts for vertical position, not horizontal.
     */
    var $w = $(window);
    $.fn.visible = function(partial,hidden,direction){

        if (this.length < 1)
            return;

        var $t        = this.length > 1 ? this.eq(0) : this,
            t         = $t.get(0),
            vpWidth   = $w.width(),
            vpHeight  = $w.height(),
            direction = (direction) ? direction : 'both',
            clientSize = hidden === true ? t.offsetWidth * t.offsetHeight : true;

        if (typeof t.getBoundingClientRect === 'function'){

            // Use this native browser method, if available.
            var rec = t.getBoundingClientRect(),
                tViz = rec.top    >= 0 && rec.top    <  vpHeight,
                bViz = rec.bottom >  0 && rec.bottom <= vpHeight,
                lViz = rec.left   >= 0 && rec.left   <  vpWidth,
                rViz = rec.right  >  0 && rec.right  <= vpWidth,
                vVisible   = partial ? tViz || bViz : tViz && bViz,
                hVisible   = partial ? lViz || rViz : lViz && rViz;

            if(direction === 'both')
                return clientSize && vVisible && hVisible;
            else if(direction === 'vertical')
                return clientSize && vVisible;
            else if(direction === 'horizontal')
                return clientSize && hVisible;
        } else {

            var viewTop         = $w.scrollTop(),
                viewBottom      = viewTop + vpHeight,
                viewLeft        = $w.scrollLeft(),
                viewRight       = viewLeft + vpWidth,
                offset          = $t.offset(),
                _top            = offset.top,
                _bottom         = _top + $t.height(),
                _left           = offset.left,
                _right          = _left + $t.width(),
                compareTop      = partial === true ? _bottom : _top,
                compareBottom   = partial === true ? _top : _bottom,
                compareLeft     = partial === true ? _right : _left,
                compareRight    = partial === true ? _left : _right;

            if(direction === 'both')
                return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop)) && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
            else if(direction === 'vertical')
                return !!clientSize && ((compareBottom <= viewBottom) && (compareTop >= viewTop));
            else if(direction === 'horizontal')
                return !!clientSize && ((compareRight <= viewRight) && (compareLeft >= viewLeft));
        }
    };

})(jQuery);

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
            jQuery(element).each(function(index,item) {
                if(this.isAnchorLink(jQuery(item).attr('href')) && this.anchorLinkExists(jQuery(item).attr('href'))) {
                    this.bindAnchorScroll(item,jQuery(item).attr('href'));
                }

                if(this.isAnchorLink(jQuery(item).attr('href')) && !this.anchorLinkExists(jQuery(item).attr('href')) && (window.location.pathname !== '/' || window.location.search.indexOf('?s=') >= 0)) {
                    jQuery(item).attr('href', jQuery(".logotype").attr('href')  + "/" + jQuery(item).attr('href'));
                }
            }.bind(this));
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
            this.updateHash(target);
            var targetOffset = jQuery(target).offset();
            jQuery('html, body').animate({scrollTop: Math.abs(targetOffset.top -Math.abs(AnchorScrollSettings.scrollOffset))}, AnchorScrollSettings.scrollSpeed, jQuery.bez([0.815, 0.020, 0.080, 1.215]));
        }.bind(this));
    };

    AnchorScroll.prototype.updateHash = function(hash) {
        if(history.pushState) {
            if(hash === "" ) {
                history.pushState(null, null, "#");
            } else {
                history.pushState(null, null, hash);
            }
        } else {
            window.location.hash = hash;
        }
    }

    new AnchorScroll();

})(jQuery);

var Fredriksdal;

Fredriksdal = Fredriksdal || {};
Fredriksdal.Archive = Fredriksdal.Archive || {};

Fredriksdal.Archive.Archive = (function ($) {
    function Archive() {
        $(".show-post").on("click", function () {
            Archive.prototype.toogleShowPost($(this));
        }).bind(this);

        Archive.prototype.responsiveMedia();

        $(window).resize(function () {
            Archive.prototype.responsiveMedia();
        });
    };

    Archive.prototype.responsiveMedia = function () {
        if ($(window).width() < 769) {
            var int = 0;
            $(".show-post-hidden-archive").each(function (int) {
                if (int >= 8) {
                    $(this).addClass('hidden');
                }
                int++;
            });
        }
    };


    Archive.prototype.toogleShowPost = function (thisObj) {
        if (thisObj.hasClass('show-all-post')) {
            thisObj.removeClass('show-all-post');
            thisObj.addClass('show-less-post');
            thisObj.text('Se färre programpunkter');
            $('.show-post-hidden-archive').removeClass('hidden');
            $('.fade-bottom').addClass('hidden');
        }
        else {
            thisObj.addClass('show-all-post');
            thisObj.removeClass('show-less-post');
            $('.fade-bottom').removeClass('hidden');
            thisObj.text('Se alla programpunkter');
            var int = 0;
            $(".show-post-hidden-archive").each(function (int) {
                if (int > 11) {
                    $(this).addClass('hidden');
                }
                int++;
            });

        }
    };

    new Archive();

})(jQuery);

Fredriksdal = Fredriksdal || {};
Fredriksdal.AsyncContentLoader = Fredriksdal.AsyncContentLoader || {};

Fredriksdal.AsyncContentLoader.AsyncContentLoader = (function ($) {

    var AsyncContentEndpoint = 'wp/v2/all?slug=';

    var AsyncContentTempalte = '<div id="ajax-response" class="ajax-response"><div class="container"><div class="grid"><div class="grid-xs-12"><a class="close" href="#close"><i class="pricon pricon-close"></i></a><article class="frame"><h2>{{title}}</h2>{{content}}{{sidebar}}</article></div></div></div></div>';

    var AsyncContentTrigger = [
        '.modularity-onepage-section.async-loading .modularity-mod-posts a',
        '.modularity-onepage-section.async-loading .modularity-mod-index a'
    ];

    var AsyncContentReplaceVars = [
        'title',
        'content',
        'sidebar'
    ];

    function AsyncContentLoader() {
        this.triggerAjaxOpenHash();
        this.watchAjaxClose();
        jQuery.each(AsyncContentTrigger,function(index,targetObject) {
            jQuery(targetObject).click(function(event) {
                if(this.isLocalLink(jQuery(event.target).closest('a').attr('href'))) {
                    event.preventDefault();
                    this.loadContent(jQuery(event.target).closest('a'));
                    this.updateHash('#' + this.createIdFromHref(jQuery(event.target).closest('a').attr('href')));
                }
            }.bind(this));
        }.bind(this));
    };

    AsyncContentLoader.prototype.loadContent = function (clickedObject) {
        var $section = jQuery(clickedObject).parents("section");
        jQuery('#ajax-response article.frame').html('<span class="spinner spinner-dark spinner-lg" style="font-size:3em;"></span>');

        jQuery("a").removeClass('ajax-is-active');

        this.startSpinner(clickedObject);

        jQuery.get(this.createEndpointSlug(jQuery(clickedObject).attr('href')), function(dataResponse){

            //Clear area
            jQuery('.ajax-response').remove();

            //New content
            $section.append(
                this.responseTemplate(AsyncContentTempalte, dataResponse)
            );

            $section.find('article.frame').addClass('is-loaded');

            //Content loaded
            this.stopSpinner(clickedObject);
            this.scrollToResult();

        }.bind(this));
    };

    AsyncContentLoader.prototype.createEndpointSlug = function (url) {
        return rest_url + AsyncContentEndpoint + this.parsePostName(url);
    };

    AsyncContentLoader.prototype.responseTemplate = function (contentTemplate, dataResponse) {
        AsyncContentReplaceVars.forEach(function(item) {
            contentTemplate = contentTemplate.replace("{{" + item + "}}", dataResponse[item]);
        }.bind(this));
        return contentTemplate;
    };

    AsyncContentLoader.prototype.displayTarget = function(markup, target) {
        if(jQuery(target).length) {
            jQuery(target).html(markup);
        } else {
            alert("Error: Target is missing.");
        }
    };

    AsyncContentLoader.prototype.parsePostName = function(url) {
        return url.replace(location.protocol + "//" + window.location.hostname, "");
    };

    AsyncContentLoader.prototype.isLocalLink = function(url) {
        if(url.indexOf(window.location.hostname) !== -1) {
            return true;
        }
        return false;
    };

    /* Spinner */

    AsyncContentLoader.prototype.startSpinner = function(targetItem) {
        targetItem.addClass("ajax-do-spin ajax-is-active");
        targetItem.find('.box-image-container').append('<span class="pos-absolute-center spinner-container" style="width: 50px;height: 50px;"><span class="spinner" style="border: 10px solid #fff;width: 50px;height: 50px;border-left-color:transparent;"></span></span>');
    };

    AsyncContentLoader.prototype.stopSpinner = function(targetItem) {
        targetItem.removeClass("ajax-do-spin");
        targetItem.find('.spinner-container').remove();
    };

    /* Scrolling */

    AsyncContentLoader.prototype.scrollToResult = function() {
        if(!this.isInViewport('#ajax-response')) {
            jQuery('html, body').animate({scrollTop: Math.abs(jQuery("#ajax-response").offset().top -jQuery("#site-header").outerHeight())}, 700, jQuery.bez([0.815, 0.020, 0.080, 1.215]));
        }
    };

    /* Href */

    AsyncContentLoader.prototype.createIdFromHref = function(url) {
        return this.parsePostName(url).replace(new RegExp("/", 'g'),"-").replace('-blog-',"").replace(/\-$/, '').replace(/^\-/, '');
    };

    /* Close */

    AsyncContentLoader.prototype.watchAjaxClose = function() {
        jQuery("section").on('click', '.ajax-response .close',function(event){
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: Math.abs(jQuery(event.target).closest('a').parents('section').offset().top -jQuery("#site-header").outerHeight())}, 700, jQuery.bez([0.815, 0.020, 0.080, 1.215]));
            jQuery(".ajax-response").remove();
            jQuery("a").removeClass('ajax-is-active');
            this.updateHash("");
        }.bind(this));
    };

    /* Onload trigger */
    AsyncContentLoader.prototype.triggerAjaxOpenHash = function() {
        jQuery(window).bind("load", function() {
            jQuery.each(AsyncContentTrigger,function(index,targetObject) {
                jQuery(targetObject).each(function(linkindex, link){
                    if(this.isLocalLink(jQuery(link).closest('a').attr('href'))) {
                        if("#" + this.createIdFromHref(jQuery(link).attr('href')) === window.location.hash) {
                            this.loadContent(jQuery(link).closest('a'));
                            return false;
                        }
                    }
                }.bind(this));
            }.bind(this));
        }.bind(this));
    };

    /* Is in viewport */
    AsyncContentLoader.prototype.isInViewport = function (element) {
        return jQuery(element).visible(true);
    }

    /* Update hash */
    AsyncContentLoader.prototype.updateHash = function(hash) {
        if(history.pushState) {
            if(hash === "" ) {
                history.pushState(null, null, "#");
            } else {
                history.pushState(null, null, hash);
            }
        } else {
            window.location.hash = hash;
        }
    }

    new AsyncContentLoader();

})(jQuery);

Fredriksdal = Fredriksdal || {};
Fredriksdal.Liquid = Fredriksdal.Liquid || {};

Fredriksdal.Liquid.Liquid = (function ($) {

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
        HorizontalScrollTargets.forEach(function(element) {
            jQuery(HorizontalScrollWrapper + ' ' + element).flickity(HorizontalScrollSettigs);
        }.bind(this));
    }

    new HorizontalScroll();

})(jQuery);

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

Fredriksdal = Fredriksdal || {};
Fredriksdal.OffGrid = Fredriksdal.OffGrid || {};

Fredriksdal.OffGrid.OffGrid = (function ($) {

    var basicAdjustment = -20;
    var maxAdjustment = 300;

    function OffGrid() {
        this.adjustArrows();

        jQuery(window).on("resize",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("orientationchange",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("load",function(){
            var imgSizeHeight = jQuery('.flickity-viewport .box-image-container').height() + jQuery('.flickity-viewport .box-content').height() ;
            $('.flickity-viewport').height(imgSizeHeight);
        }.bind(this));
    }


    OffGrid.prototype.adjustArrows = function () {
        jQuery('.flickity-prev-next-button.next').each(function(index,element) {
            this.adjustTargetObject(element, 'right', -Math.abs(this.sectionOffsetSize())+this.offsetBySize());
        }.bind(this));
        jQuery('.flickity-prev-next-button.previous').each(function(index,element) {
            this.adjustTargetObject(element, 'left', -Math.abs(this.sectionOffsetSize())+this.offsetBySize());
        }.bind(this));
    };

    OffGrid.prototype.offsetBySize = function () {
        if(this.sectionOffsetSize() < basicAdjustment && this.sectionOffsetSize() > Math.floor(basicAdjustment/2)) {
            return Math.floor(basicAdjustment/2);
        } else if (this.sectionOffsetSize() < Math.floor(basicAdjustment/2)) {
            return Math.floor(basicAdjustment/3);
        }
        return basicAdjustment;
    }

    OffGrid.prototype.adjustTargetObject = function (object,edge,offset) {
        if(jQuery(object) && (edge == 'left' || edge == 'right' )) {
            jQuery(object).css(edge,offset);
        }
    };

    OffGrid.prototype.sectionOffsetSize = function () {
        var outerWidth = jQuery("section.modularity-onepage-section").outerWidth();
        var innerWidth = jQuery("section.modularity-onepage-section > .container").width();

        if(outerWidth !== 0 && innerWidth !== 0)  {
            if(Math.floor((outerWidth-innerWidth)/2) < maxAdjustment) {
                return Math.floor((outerWidth-innerWidth)/2);
            } else {
                return maxAdjustment;
            }

        }
        return false;
    };

    new OffGrid();

})(jQuery);

function initMap() {
    var srcImage = location.protocol + '//fredriksdal.dev/parkmap.svg';

    // Initialize the map
    var map = new google.maps.Map(document.getElementById('park-map'), {
        zoom: 16,
        center: {lat: 56.0574959, lng: 12.7108654},
        mapTypeId: 'satellite',
        scrollwheel: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: true,
        streetViewControl: false,
        rotateControl: true,
        fullscreenControl: false
    });

    // Add park map
    var imageBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(56.052568, 12.707661),
        new google.maps.LatLng(56.058804, 12.718831)
    );

    var mapOverlay = new google.maps.GroundOverlay(
        srcImage,
        imageBounds
    );

    mapOverlay.setMap(map);
}

$(document).ready(function () {
    if (document.getElementById('park-map')) {
        google.maps.event.addDomListener(window, 'load', initMap);
    }
});

Fredriksdal = Fredriksdal || {};
Fredriksdal.ScrollHighlight = Fredriksdal.ScrollHighlight || {};

Fredriksdal.ScrollHighlight.ScrollHighlight = (function ($) {

    var ScrollTopValue = 0;

    var ScrollTopOffset = 100;

    var ScrollMenuWrapperActiveClass = 'active current-menu-item';

    var ScrollHighlightTrigger = 'section.modularity-onepage-section';

    var ScrollMenuWrapper = [
        '#main-menu',
        '#mobile-menu'
    ];

    function ScrollHighlight() {
        ScrollTopValue = jQuery(window).scrollTop();
        jQuery(window).on('scroll', function (e) {
            var scrolledToItem = null;
            ScrollTopValue = jQuery(window).scrollTop() + ScrollTopOffset + jQuery("#site-header").outerHeight();
            jQuery(ScrollHighlightTrigger).each(function (index,item) {
                if(ScrollTopValue >= jQuery(item).offset().top) {
                    scrolledToItem = item;
                    return;
                }
            });
            this.cleanHighlight();
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

    ScrollHighlight.prototype.cleanHighlight = function () {
        ScrollMenuWrapper.forEach(function(element) {
            jQuery("li",element).removeClass(ScrollMenuWrapperActiveClass);
        }.bind(this));
    };

    new ScrollHighlight();

})(jQuery);

Fredriksdal = Fredriksdal || {};
Fredriksdal.ScrollPlease = Fredriksdal.ScrollPlease || {};

Fredriksdal.ScrollPlease.ScrollPlease = (function ($) {

    function ScrollPlease() {
        $(window).on('scroll', function (e) {
            var scrollPos = $(e.target).scrollTop();

            if (scrollPos > 100) {
                $('.scroll-down-please').fadeOut();
            } else {
                $('.scroll-down-please').fadeIn();
            }
        });

        $('.scroll-down-please').on('click', function (e) {
            var target = $(e.target).closest('a').attr('href');
            var scrollTo = $(target).offset().top - $('.navbar-mainmenu').height();

            $('html, body').animate({
                scrollTop: scrollTo
            }, 500);

            return false;
        });
    }

    return new ScrollPlease();

})(jQuery);

Fredriksdal = Fredriksdal || {};
Fredriksdal.VerticalArrowAdjustment = Fredriksdal.VerticalArrowAdjustment || {};

Fredriksdal.VerticalArrowAdjustment.VerticalArrowAdjustment = (function ($) {
    function VerticalArrowAdjustment() {
        this.adjustArrows();

        jQuery(window).on("resize",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).on("orientationchange",function(){
            this.adjustArrows();
        }.bind(this));

        jQuery(window).bind("load", function () {
            setTimeout(5000,this.adjustArrows());
        }.bind(this));
    }

    VerticalArrowAdjustment.prototype.adjustArrows = function () {
        jQuery('.flickity-prev-next-button').each(function(index,element) {
            jQuery(element).css('marginTop',-Math.abs(Math.floor(jQuery(element).siblings('.flickity-page-dots').outerHeight())));
        }.bind(this));
    };

    new VerticalArrowAdjustment();

})(jQuery);
