<?php

namespace Fredriksdal\Theme;

class EventArchive
{

    private $eventPostType = "event";

    public function __construct()
    {
        add_action('pre_get_posts', array($this, 'modifyQuery'), 100);
        add_filter('posts_fields', array($this, 'sqlSelect'));
        add_filter('posts_groupby', array($this, 'sqlGroupBy'));

        add_filter('posts_where', function ($where) {
            if (is_post_type_archive($this->eventPostType)) {
                $where .= " AND post_title LIKE '%" . sanitize_text_field($_GET['search']). "%'";
            }
            return $where;
        });

        add_filter('nav_menu_link_attributes', array($this, 'filterEventCategoryLinks'), 10, 3);
        add_filter('nav_menu_css_class', array($this, 'setCurrentEventCategory'), 10, 2);
        add_filter('wp_nav_menu_items', array($this, 'filterEventItems'), 10, 2);

        add_filter('posts_join', array($this, 'eventDateFilterJoin'));
        add_filter('Municipio/archive/date_filter', array($this, 'eventDateFilterWhere'), 10, 3);

        add_filter('Modularity/Module/Posts/template', array($this, 'eventPostsModule'), 10, 3);
    }

    public function eventPostsModule($template, $module, $fields)
    {
        if ($fields->posts_data_source !== 'posttype' || ($fields->posts_data_source === 'posttype' && $fields->posts_data_post_type !== $this->eventPostType)) {
            return $template;
        }

        return \Modularity\Helper\Wp::getTemplate('mod-posts-events', 'module', false);
    }

    public function eventDateFilterJoin($join)
    {
        global $wpdb;

        $from = null;
        $to = null;

        if (isset($_GET['from']) && !empty($_GET['from'])) {
            $from = sanitize_text_field($_GET['from']);
        }

        if (isset($_GET['to']) && !empty($_GET['to'])) {
            $to = sanitize_text_field($_GET['to']);
        }

        if (!is_null($from) || !is_null($to)) {
            $join .= " LEFT JOIN {$wpdb->postmeta} AS eventStart ON eventStart.post_id = {$wpdb->posts}.ID";
            $join .= " LEFT JOIN {$wpdb->postmeta} AS eventEnd ON eventEnd.post_id = {$wpdb->posts}.ID";
        }

        return $join;
    }

    public function eventDateFilterWhere($where, $from, $to)
    {
        global $wpdb;

        $from = null;
        $to = null;

        if (isset($_GET['from']) && !empty($_GET['from'])) {
            $from = sanitize_text_field($_GET['from']);
        }

        if (isset($_GET['to']) && !empty($_GET['to'])) {
            $to = sanitize_text_field($_GET['to']);
        }

        if (!is_null($from) && !is_null($to)) {
            // USE BETWEEN ON START DATE
            $where = str_replace(
                $wpdb->posts . '.post_date >= \''. $from . '\'',
                '(eventStart.meta_value BETWEEN \'' . $from . '\' AND \'' . $to . '\')',
                $where
            );
            $where = str_replace(
                'AND ' . $wpdb->posts . '.post_date <= \''. $to . '\'',
                '',
                $where
            );
        } elseif (!is_null($from) || !is_null($to)) {
            // USE FROM OR TO
            $where = " AND eventStart.meta_key = 'event-date-start' AND eventEnd.meta_key = 'event-date-end' " . $where;
            $where = str_replace($wpdb->posts . '.post_date >=', 'eventStart.meta_value >=', $where);
            $where = str_replace($wpdb->posts . '.post_date <=', 'eventEnd.meta_value <=', $where);
        }

        return $where;
    }

    /**
     * Add counter to query
     * @param  string $select Original query
     * @return string         Modified query
     */
    public function sqlSelect($select)
    {
        if (is_admin() || !is_post_type_archive($this->eventPostType)) {
            return $select;
        }

        global $wpdb;

        $select .= ', COUNT(DISTINCT ' . $wpdb->posts . '.ID)-1 as occations_count';
        return $select;
    }

    /**
     * Add group by to query
     * @param  string $groupBy Original query
     * @return string          Modified query
     */
    public function sqlGroupBy($groupBy)
    {
        if (is_admin() || !is_post_type_archive($this->eventPostType)) {
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
        if (is_admin() ||!$query->is_main_query() || !is_post_type_archive($this->eventPostType)) {
            return $query;
        }

        if (is_post_type_archive('event')) {

            // Posts per page
            $query->set('posts_per_page', 100);

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
