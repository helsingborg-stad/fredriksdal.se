<?php


    /*
    Plugin Name: ACF Json Sync file doctor
    Description: Checks if ACF json export files (that should be imported with Json Sync) is in correct format. If not, the plugin will try to fix any errors.
    Version:     1.0
    Author:      Kristoffer Svanmark
    */

    namespace VarnishInstantCacheRefresh;

    class VarnishInstantCacheRefresh
    {
        public function __construct()
        {
            add_filter('admin_footer', array($this, 'printRefreshScript'));
        }

        public function printRefreshScript()
        {

            //Check if get parameter is valid
            if(isset($_GET['post']) && is_numeric($_GET['post']) && isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['message']) && $_GET['message'] == "1" ) {

                //Store post id to var
                $post_id = $_GET['post'];

                //Check if is published && url is valid
                if( get_post_status($post_id) == 'publish' ) {
                    $url = get_permalink($post_id);
                    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                        echo "
                        <script>
                            jQuery.ajax({
                                type: 'GET',
                                url: '".$url."',
                                success: function () {
                                    console.log('Redone cache: ".$url."');
                                }
                              });
                        </script>
                        ";
                    }
                }
            }
        }

    }

    new \VarnishInstantCacheRefresh\VarnishInstantCacheRefresh();
