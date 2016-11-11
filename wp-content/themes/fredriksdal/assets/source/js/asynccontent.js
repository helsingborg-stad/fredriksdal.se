Fredriksdal = Fredriksdal || {};
Fredriksdal.AsyncContentLoader = Fredriksdal.AsyncContentLoader || {};

Fredriksdal.AsyncContentLoader.AsyncContentLoader = (function ($) {

    var AsyncContentEndpoint = '/wp-json/wp/v2/page?filter[name]=';

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
                event.preventDefault();
                this.loadContent(jQuery(event.target).closest('a'));
            }.bind(this));
        }.bind(this));
    };

    AsyncContentLoader.prototype.loadContent = function (clickedObject) {

        //this.startSpinner(clickedObject);
        console.log(this.createEndpointSlug(jQuery(clickedObject).attr('href')));

/*        jQuery.get(this.createEndpointSlug(jQuery(clickedObject).attr('href')), function(dataResponse){

            jQuery('.ajax-response', jQuery(clickedObject).parents("section")).remove();

            jQuery(clickedObject).parents("section").append(
                this.responseTemplate(AsyncContentTempalte, dataResponse)
            );

            this.stopSpinner();
            this.scrollToResult();

        }.bind(this));*/
    };

    AsyncContentLoader.prototype.createEndpointSlug = function (url) {
        return location.protocol + "//" + window.location.hostname + AsyncContentEndpoint + this.parsePostName(url) + '&[posts_per_page]=1';
    };

    AsyncContentLoader.prototype.responseTemplate = function (contentTemplate, dataResponse) {

        AsyncContentReplaceVars.forEach(function(item) {

            var dynamicTarget;

            if( dataResponse[item]['rendered'] ) {
                dynamicTarget = dataResponse[item]['rendered'];
            } else {
                dynamicTarget = dataResponse[item];
            }

            contentTemplate = contentTemplate.replace("{{" + item + "}}", dynamicTarget);

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
        return url.split('/').filter(function(e){return e}).pop();
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
