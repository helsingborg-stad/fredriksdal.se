<?php

namespace Dunkers\Theme;

class EventArchive
{
    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'modifyQuery'));
    }

    public function modifyQuery($query)
    {
        if (is_admin() ||!$query->is_main_query()) {
            return $query;
        }

        if (is_post_type_archive('event')) {

            // Meta query, upcoming events
            $query->set('meta_query', array(
                'relation' => 'AND',
                array(
                    'key'     => 'event-date-start',
                    'value'   => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                )
            ));

            // Posts per page
            $query->set('posts_per_page', 12);

            // Sort
            $query->set('meta_key', 'event-date-start');
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
        }

        return $query;
    }
}
