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

        $query = $wpdb->prepare("SELECT $wpdb->posts.* FROM $wpdb->posts WHERE post_title = %s AND post_type = %s AND ID != %d", $post->post_title, $post->post_type, $post->ID);
        $occations = $wpdb->get_results($query, OBJECT);

        return $occations;
    }
}
