<?php
namespace Fredriksdal\Theme;

class Api
{
    public function __construct()
    {
        add_action('rest_api_init', array($this, 'registerRestRoute'));
    }

    public function registerRestRoute()
    {
        register_rest_route('wp/v2', '/all/', array(
            'methods' => 'GET',
            'callback' => function ($request) {

                if (!isset($request['slug'])) {
                    return null;
                }

                $return = url_to_postid(
                    home_url() . "/" . $request['slug']
                );

                if (!$return) {
                    return array(
                        'error' => '404',
                        'url' => home_url() . "/" . $request['slug']
                    );
                }
                $return = get_post($return);

                return array (
                    'title' => $return->post_title,
                    'content' => apply_filters('the_content', $return->post_content),
                    'sidebar' => get_sidebar('content-area-bottom')
                );
            }
        ));
    }
}
