<?php

namespace Fredriksdal\Theme;

class News
{
    public static $postTypeSlug = 'news';

    public function __construct()
    {
        add_action('init', array($this, 'registerPostType'));
    }

    /**
     * Registers the custom post type
     * @return void
     */
    public function registerPostType()
    {
        $nameSingular = __('News', 'fredriksdal');
        $namePlural = __('News', 'fredriksdal');

        $icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyOTcgMjk3IiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiI+PGcgZmlsbD0iI0ZGRiI+PHBhdGggZD0iTTE3My44NTggMTA0LjYyNmg3MC40MXY1Mi40MzJoLTcwLjQxeiIvPjxwYXRoIGQ9Ik00NC42NzcgMjYyLjQzaDI0Mi4yNTZjNS41NiAwIDEwLjA2Ny00LjUxIDEwLjA2Ny0xMC4wN1Y0NC42NGMwLTUuNTYtNC41MDgtMTAuMDY4LTEwLjA2Ny0xMC4wNjhINDQuNjc3Yy01LjU2IDAtMTAuMDY3IDQuNTA4LTEwLjA2NyAxMC4wNjh2MjA3LjcyYzAgNS41NiA0LjUwNyAxMC4wNyAxMC4wNjcgMTAuMDd6TTE1Ny43NSA5Ni41N2E4LjA1NSA4LjA1NSAwIDAgMSA4LjA1NC04LjA1NWg4Ni41MmE4LjA1NSA4LjA1NSAwIDAgMSA4LjA1NSA4LjA1NXY2OC41NGE4LjA1NSA4LjA1NSAwIDAgMS04LjA1OCA4LjA1NGgtODYuNTJhOC4wNTUgOC4wNTUgMCAwIDEtOC4wNTQtOC4wNTRWOTYuNTd6bS03OC40NjYtOC4wNTRoNTEuOTEzYTguMDU1IDguMDU1IDAgMCAxIDAgMTYuMTFINzkuMjg0YTguMDU0IDguMDU0IDAgMSAxIDAtMTYuMTF6bTAgMzQuNjJoNTEuOTEzYTguMDU1IDguMDU1IDAgMCAxIDAgMTYuMTFINzkuMjg0YTguMDU1IDguMDU1IDAgMSAxIDAtMTYuMTF6bTAgMzQuNjE2aDUxLjkxM2E4LjA1NSA4LjA1NSAwIDAgMSAwIDE2LjExSDc5LjI4NGE4LjA1NSA4LjA1NSAwIDEgMSAwLTE2LjExem0wIDUxLjkzMmgxNzMuMDRhOC4wNTYgOC4wNTYgMCAwIDEgMCAxNi4xMUg3OS4yODRhOC4wNTUgOC4wNTUgMCAwIDEgMC0xNi4xMXpNMTguNSAyNTIuMzZWNjkuMTkyaC04LjQzM0M0LjUwNyA2OS4xOTIgMCA3My43IDAgNzkuMjYydjE3My4xYzAgNS41NiA0LjUwOCAxMC4wNjcgMTAuMDY3IDEwLjA2N2gxMC40NWEyNi4wNTUgMjYuMDU1IDAgMCAxLTIuMDE2LTEwLjA3eiIvPjwvZz48L3N2Zz4=';

        $labels = array(
            'name'               => $nameSingular,
            'singular_name'      => $nameSingular,
            'menu_name'          => $namePlural,
            'name_admin_bar'     => $nameSingular,
            'add_new'            => _x('Add New', 'add new button', 'fredriksdal'),
            'add_new_item'       => sprintf(__('Add new %s', 'fredriksdal'), $nameSingular),
            'new_item'           => sprintf(__('New %s', 'fredriksdal'), $nameSingular),
            'edit_item'          => sprintf(__('Edit %s', 'fredriksdal'), $nameSingular),
            'view_item'          => sprintf(__('View %s', 'fredriksdal'), $nameSingular),
            'all_items'          => sprintf(__('All %s', 'fredriksdal'), $namePlural),
            'search_items'       => sprintf(__('Search %s', 'fredriksdal'), $namePlural),
            'parent_item_colon'  => sprintf(__('Parent %s', 'fredriksdal'), $namePlural),
            'not_found'          => sprintf(__('No %s', 'fredriksdal'), $namePlural),
            'not_found_in_trash' => sprintf(__('No %s in trash', 'fredriksdal'), $namePlural)
        );

        $args = array(
            'labels'               => $labels,
            'description'          => __('News stories', 'fredriksdal'),
            'menu_icon'            => $icon,
            'public'               => true,
            'publicly_queriable'   => true,
            'show_ui'              => true,
            'show_in_nav_menus'    => true,
            'menu_position'        => 4,
            'has_archive'          => true,
            'rewrite'              => array(
                'slug'       => __('news', 'fredriksdal'),
                'with_front' => false
            ),
            'hierarchical'         => false,
            'exclude_from_search'  => false,
            'taxonomies'           => array(),
            'supports'             => array('title', 'revisions', 'editor', 'thumbnail', 'author', 'comments')
        );

        register_post_type(self::$postTypeSlug, $args);
    }
}
