<?php

namespace Fredriksdal\Admin;

class ThemeOptions
{
    public function __construct()
    {
        if (function_exists('acf_add_options_page')) {
            $themeOptionsCapability = 'administrator';
            $themeOptionsParent = 'themes.php';

            acf_add_options_sub_page(array(
                'page_title'    => __('Fredriksdal Specific', 'municipio'),
                'menu_title'    => __('Fredriksdal Specific', 'municipio'),
                'parent_slug'   => $themeOptionsParent,
                'capability'    => $themeOptionsCapability,
                'menu_slug'     => 'acf-options-fredriksdal'
            ));
        }
    }
}
