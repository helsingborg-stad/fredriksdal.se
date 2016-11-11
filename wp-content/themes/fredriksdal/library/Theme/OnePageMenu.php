<?php

namespace Fredriksdal\Theme;

class OnePageMenu
{

    private $handleMenu = 'main-menu';

    public function __construct($handleMenu = 'main-menu')
    {

        //Set menu slug
        if ($handleMenu !== $this->handleMenu) {
            $this->handleMenu = $handleMenu;
        }

        //Populate menu items
        add_filter('acf/load_field/name=section_menu_item', array($this, 'populateSelectItems'));
    }

    public function populateSelectItems($field)
    {
        $field['choices'] = array();
        $field['choices'][''] = __("No link", 'fredriksdal');
        foreach ($this->filterMenuItems() as $choice) {
            $field['choices'][str_replace("/#", "", $choice->url)] = $choice->post_title;
            $field['choices'][str_replace("#", "", $choice->url)] = $choice->post_title;
        }

        return $field;
    }

    public function getMainMenu()
    {
        $avabileLocations = get_nav_menu_locations();

        if (is_array($avabileLocations) && array_key_exists($this->handleMenu, $avabileLocations)) {
            $currentMenu = wp_get_nav_menu_object($avabileLocations[$this->handleMenu]);

            if (is_object($currentMenu) && !empty($currentMenu)) {
                return wp_get_nav_menu_items($currentMenu->term_id, array(
                    'numberposts' => -1
                ));
            }
        }

        return false;
    }

    public function isAnchorLink($string)
    {
        if (preg_match('/#([^\s]+)/', $string) && !filter_var($string, FILTER_VALIDATE_URL)) {
            return true;
        }
        return false;
    }

    public function filterMenuItems()
    {
        $filteredMenuItems = array();
        foreach ((array) $this->getMainMenu() as $menuItem) {
            if (isset($menuItem->url) && $this->isAnchorLink($menuItem->url)) {
                $filterMenuItems[] = $menuItem;
            }
        }
        return $filterMenuItems;
    }
}
