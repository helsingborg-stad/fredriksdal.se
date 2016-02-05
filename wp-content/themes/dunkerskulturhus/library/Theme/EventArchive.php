<?php

namespace Dunkers\Theme;

class EventArchive
{
    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'modifyQuery'));
        add_filter('posts_fields', array($this, 'sqlSelect'));
        add_filter('posts_groupby', array($this, 'sqlGroupBy'));
        add_filter('nav_menu_link_attributes', array($this, 'filterEventCategoryLinks'), 10, 3);
        add_filter('nav_menu_css_class', array($this, 'setCurrentEventCategory'), 10, 2);
    }

    public function sqlSelect($select)
    {
        $select .= ', COUNT(ID) as occations_count';
        return $select;
    }

    public function sqlGroupBy($groupBy)
    {
        $groupBy = 'wp_posts.post_title';
        return $groupBy;
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

            if (isset($_GET['filter']) && !empty($_GET['filter'])) {
                $filter = $_GET['filter'];
                $query->set('event-types', $filter);
            }
        }

        return $query;
    }

    /**
     * Fixes urls in the event cateogy filter menu
     * @param  array  $attr Item attributes
     * @param  object $item Item object
     * @param  array  $args Arguments
     * @return array        Modified attributes
     */
    public function filterEventCategoryLinks($attr, $item, $args)
    {
        if (!isset($args->theme_location) || $args->theme_location != 'event-categories') {
            return $attr;
        }

        if ($item->type != 'taxonomy' || $item->object != 'event-types') {
            return $attr;
        }

        $term = get_term_by('name', $item->title, $item->object);
        $attr['href'] = home_url('event/?filter=' . $term->slug);

        return $attr;
    }

    public function setCurrentEventCategory($classes, $item)
    {
        global $wp_query;

        if ($item->type != 'taxonomy' || $item->object != 'event-types') {
            return $classes;
        }

        if (isset($wp_query->query_vars['term']) && strtolower($wp_query->query_vars['term']) == strtolower($item->title)) {
            $classes[] = 'current_page_item';
        }

        return $classes;
    }
}
