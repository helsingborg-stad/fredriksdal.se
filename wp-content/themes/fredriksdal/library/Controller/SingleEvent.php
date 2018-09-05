<?php

namespace Fredriksdal\Controller;

class SingleEvent extends \Municipio\Controller\SingleEvent
{
    public function init()
    {
        $this->data['occasion'] = method_exists('\EventManagerIntegration\Helper\SingleEventData', 'singleEventDate') ? \EventManagerIntegration\Helper\SingleEventData::singleEventDate() : null;
        $this->data['occations'] = $this->getOccationsWithEventManagerIntegration();
    }

    /**
     * Gets all occations of the event (except current occation)
     * @return object
     */
    public function getOccationsWithEventManagerIntegration()
    {
        if (!class_exists('\EventManagerIntegration\Helper\QueryEvents')) {
            return array();
        }

        global $post;
        $occations = \EventManagerIntegration\Helper\QueryEvents::getEventOccasions($post->ID);

        if (is_array($occations) && !empty($occations)) {
            foreach ($occations as $key => $occasion) {
                if (strtotime($occasion->start_date) == strtotime($this->data['occasion']['start_date'])) {
                    unset($occations[$key]);
                }
            }

            return $occations;
        }

        return array();
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
