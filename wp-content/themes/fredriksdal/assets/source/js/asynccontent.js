Fredriksdal = Fredriksdal || {};
Fredriksdal.AsyncContentLoader = Fredriksdal.AsyncContentLoader || {};

Fredriksdal.AsyncContentLoader.AsyncContentLoader = (function ($) {

    var AsyncContentEndpoint = '/wp-json/wp/v2/all?slug=';

    var AsyncContentTempalte = '<div id="ajax-response" class="ajax-response"><div class="container"><div class="grid"><div class="grid-xs-12"><a class="close" href="#close"><i class="pricon pricon-close"></i></a><article class="frame"><h2>{{title}}</h2>{{content}}</article></div></div></div></div>';

    var AsyncContentTrigger = [
        '.modularity-onepage-section.async-loading .modularity-mod-posts a',
        '.modularity-onepage-section.async-loading .modularity-mod-index a'
    ];

    var AsyncContentReplaceVars = [
        'title',
        'content'
    ];

    function AsyncContentLoader() {
        this.triggerAjaxOpenHash();
        this.watchAjaxClose();
        jQuery.each(AsyncContentTrigger,function(index,targetObject) {
            jQuery(targetObject).click(function(event) {
                if(this.isLocalLink(jQuery(event.target).closest('a').attr('href'))) {
                    event.preventDefault();
                    this.loadContent(jQuery(event.target).closest('a'));
                    window.location.hash = '#' + this.createIdFromHref(jQuery(event.target).closest('a').attr('href'));
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
        return location.protocol + "//" + window.location.hostname + AsyncContentEndpoint + this.parsePostName(url);
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
    };

    AsyncContentLoader.prototype.stopSpinner = function(targetItem) {
        targetItem.removeClass("ajax-do-spin");
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
            jQuery(".ajax-response").remove();
            jQuery("a").removeClass('ajax-is-active');
        });
    };

    /* Onload trigger */
    AsyncContentLoader.prototype.triggerAjaxOpenHash = function() {
        jQuery.each(AsyncContentTrigger,function(index,targetObject) {
            console.log("main");
            jQuery(targetObject).each(function(linkindex, link){
                if("#" + this.createIdFromHref(jQuery(link).attr('href')) === window.location.hash) {
                    jQuery(link).trigger('click');
                    return true;
                }
            }.bind(this));
        }.bind(this));
    };

    /* Is in viewport */
    AsyncContentLoader.prototype.isInViewport = function(element) {
        if(jQuery(element).offset().top < jQuery(document).scrollTop() + (jQuery(window).height() * 0.85)) {
            return true;
        }
        return false;
    };

    new AsyncContentLoader();

})(jQuery);
