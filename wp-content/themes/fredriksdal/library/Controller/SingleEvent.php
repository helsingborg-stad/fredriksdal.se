<?php

namespace Fredriksdal\Controller;

class SingleEvent extends \Municipio\Controller\BaseController
{
    public function init()
    {
        $this->data['occations'] = $this->getOccations();
        $this->data['passedOccations'] = $this->getOccations("<");
    }

    /**
     * Gets all occations of events with the same post_title
     * @return object
     */
    public function getOccations($operator = ">=")
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
                AND {$wpdb->postmeta}.meta_value {$operator} %s
                AND {$wpdb->postmeta}.meta_value > %s
        ";

        $query = $wpdb->prepare(
            $sql,
            'event-date-start',
            $post->post_title,
            $post->post_type,
            $post->ID,
            date('Y-m-d H:i'),
            date("Y-m-d H:i", strtotime("-3 month"))
        );

        $occations = $wpdb->get_results($query, OBJECT);

        return $occations;
    }
}
