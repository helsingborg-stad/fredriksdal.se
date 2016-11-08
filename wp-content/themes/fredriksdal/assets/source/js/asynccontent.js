Fredriksdal = Fredriksdal || {};
Fredriksdal.AsyncContentLoader = Fredriksdal.AsyncContentLoader || {};

Fredriksdal.AsyncContentLoader.AsyncContentLoader = (function ($) {

    var lastClickedObject;

    var AsyncContentEndpoint = '/wp-json/wp/v2/';

    var AsyncContentTempalte = '<div class="container ajax-response"><div class="grid"><div class="grid-xs-12"><div class="frame"><h2>{{title}}</h2>{{content}}</div></div></div></div>';

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
            jQuery(targetObject).click(function(lastClicked) {
                event.preventDefault();
                lastClickedObject = jQuery(lastClicked.target);
                this.loadContent("post", 83);
            }.bind(this));
        }.bind(this));
    };

    AsyncContentLoader.prototype.loadContent = function (postType, postId) {
        jQuery.get(this.createEndpointSlug(postType,postId), function(dataResponse){
            jQuery('.ajax-response', jQuery(lastClickedObject).parents("section")).remove();
            jQuery(lastClickedObject).parents("section").append(
                this.responseTemplate(AsyncContentTempalte, dataResponse)
            );
        }.bind(this));
    };

    AsyncContentLoader.prototype.createEndpointSlug = function (postType, postId) {
        return location.protocol + "//" + window.location.hostname + AsyncContentEndpoint + postType + "s/" + postId;
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

    new AsyncContentLoader();

})(jQuery);
