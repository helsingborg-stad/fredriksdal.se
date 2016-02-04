<?php

namespace Dunkers\Theme;

class Navigation
{
    public function __construct()
    {
        $this->registerMenus();
    }

    public function registerMenus()
    {
        register_nav_menus(array(
            'event-categories' => __('Evenemangskategorier', 'dunkers')
        ));
    }
}
