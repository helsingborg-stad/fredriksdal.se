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
        add_filter('wp_nav_menu_items', array($this, 'filterEventItems'), 10, 2);
    }

    /**
     * Add counter to query
     * @param  string $select Original query
     * @return string         Modified query
     */
    public function sqlSelect($select)
    {
        if (is_admin()) {
            return $select;
        }

        $select .= ', COUNT(ID)-1 as occations_count';
        return $select;
    }

    /**
     * Add group by to query
     * @param  string $groupBy Original query
     * @return string          Modified query
     */
    public function sqlGroupBy($groupBy)
    {
        if (is_admin()) {
            return $groupBy;
        }

        global $wpdb;
        $groupBy = $wpdb->posts . '.post_title';
        return $groupBy;
    }

    /**
     * Modify query
     * @param  string $query  Original query
     * @return string         Modified query
     */
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
            $query->set('posts_per_page', 13);

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
     * Add "show all" to the filter menu
     * @param  array $items Items
     * @param  array $args  Arguments
     * @return void
     */
    public function filterEventItems($items, $args)
    {
        if ($args->theme_location != 'event-categories') {
            return $items;
        }

        $class = !isset($_GET['filter']) || empty($_GET['filter']) ? 'current_page_item' : '';
        $items = '<li class="' . $class . '"><a href="' . home_url('event') . '">Visa alla</a></li>' . $items;

        return $items;
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

    /**
     * Marks the current filter event category in the navigation menu
     * @param  string $classes Item classes
     * @param  object $item    Item object
     * @return string          New classes
     */
    public function setCurrentEventCategory($classes, $item)
    {
        global $wp_query;

        if ($item->type != 'taxonomy' || $item->object != 'event-types') {
            return $classes;
        }

        if (isset($wp_query->query_vars['term'])
            && strtolower($wp_query->query_vars['term']) == sanitize_title(strtolower($item->title))) {
            $classes[] = 'current_page_item';
        }

        return $classes;
    }
}
