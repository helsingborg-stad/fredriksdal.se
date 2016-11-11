Fredriksdal = Fredriksdal || {};
Fredriksdal.AsyncContentLoader = Fredriksdal.AsyncContentLoader || {};

Fredriksdal.AsyncContentLoader.AsyncContentLoader = (function ($) {

    var AsyncContentEndpoint = '/wp-json/wp/v2/all?slug=';

    var AsyncContentTempalte = '<div id="ajax-response" class="ajax-response"><div class="container"><div class="grid"><div class="grid-xs-12"><div class="frame"><h2>{{title}}</h2>{{content}}</div></div></div></div></div>';

    var AsyncContentTrigger = [
        '.modularity-mod-posts a',
        '.modularity-mod-index a'
    ];

    var AsyncContentReplaceVars = [
        'title',
        'content'
    ];

    function AsyncContentLoader() {
        jQuery.each(AsyncContentTrigger,function(index,targetObject) {
            jQuery(targetObject).click(function(event) {
console.log(this.isLocalLink(jQuery(event.target).closest('a').attr('href')));
                if(this.isLocalLink(jQuery(event.target).closest('a').attr('href'))) {
                    event.preventDefault();
                    this.loadContent(jQuery(event.target).closest('a'));
                }
            }.bind(this));
        }.bind(this));
    };

    AsyncContentLoader.prototype.loadContent = function (clickedObject) {

        this.startSpinner(clickedObject);

        jQuery.get(this.createEndpointSlug(jQuery(clickedObject).attr('href')), function(dataResponse){

            jQuery('.ajax-response', jQuery(clickedObject).parents("section")).remove();

            jQuery(clickedObject).parents("section").append(
                this.responseTemplate(AsyncContentTempalte, dataResponse)
            );

            this.stopSpinner(clickedObject);
            this.scrollToResult();

        }.bind(this));
    };

    AsyncContentLoader.prototype.createEndpointSlug = function (url) {
        console.log(url);
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

    AsyncContentLoader.prototype.startSpinner = function(targetItem) {
        targetItem.addClass("do-spin");
    };

    AsyncContentLoader.prototype.stopSpinner = function(targetItem) {
        targetItem.removeClass("do-spin");
    };

    AsyncContentLoader.prototype.scrollToResult = function() {
        jQuery('html, body').animate({scrollTop: Math.abs(jQuery("#ajax-response").offset().top -jQuery("#site-header").outerHeight())}, 700, jQuery.bez([0.815, 0.020, 0.080, 1.215]));
    };

    new AsyncContentLoader();

})(jQuery);
