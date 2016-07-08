<?php

namespace Dunkers\Controller;

class SingleEvent extends \Municipio\Controller\BaseController
{
    public function init()
    {
        $this->data['occations'] = $this->getOccations();
    }

    /**
     * Gets all occations of events with the same post_title
     * @return object
     */
    public function getOccations()
    {
        global $post;
        global $wpdb;

        $sql = "SELECT $wpdb->posts.*
            FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID AND {$wpdb->postmeta}.meta_key = %s
            WHERE
                {$wpdb->posts}.post_title = %s
                AND {$wpdb->posts}.post_type = %s
                AND {$wpdb->posts}.ID != %d
                AND {$wpdb->postmeta}.meta_value >= %s
        ";

        $query = $wpdb->prepare(
            $sql,
            'event-date-start',
            $post->post_title,
            $post->post_type,
            $post->ID,
            date('Y-m-d H:i')
        );

        $occations = $wpdb->get_results($query, OBJECT);

        return $occations;
    }
}
