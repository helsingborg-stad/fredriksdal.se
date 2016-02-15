<?php

namespace Dunkers\Theme;

class Navigation
{
    public function __construct()
    {
        $this->registerMenus();

        add_filter('nav_menu_css_class', array($this, 'setCurrentlyActiveItem'), 10, 3);
    }

    /**
     * Fixes urls in the event cateogy filter menu
     * @param  array  $attr Item attributes
     * @param  object $item Item object
     * @param  array  $args Arguments
     * @return array        Modified attributes
     */
    public function setCurrentlyActiveItem($classes, $item, $args)
    {
        if (!isset($args->theme_location) || $args->theme_location != 'main-menu') {
            return $classes;
        }

        if (strpos($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], $item->url)) {
            $classes[] = 'current-menu-item';
        }

        return $classes;
    }

    public function registerMenus()
    {
        register_nav_menus(array(
            'event-categories' => __('Evenemangskategorier', 'dunkers')
        ));
    }
}
