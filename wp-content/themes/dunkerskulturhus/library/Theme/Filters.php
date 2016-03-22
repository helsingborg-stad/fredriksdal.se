<?php

namespace Dunkers\Theme;

class Filters
{
    public function __construct()
    {

        //Add filters
        add_action('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'));
        add_action('Municipio/desktop_menu_breakpoint', array($this, 'desktopMenuBreakpoint'));
        add_action('Municipio/header_grid_size', array($this, 'headerGridSize'));

        //Reset image filters
        add_filter('modularity/image/slider', array($this, 'filterHeroImageSize'), 150, 2);
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function mobileMenuBreakpoint($classes)
    {
        return "hidden-lg";
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function desktopMenuBreakpoint($classes)
    {
        return "hidden-xs hidden-sm hidden-md";
    }

    /**
     * Width of header, make room for mobile menu in medium
     * @return void
     */
    public function headerGridSize($classes)
    {
        return "grid-lg-12";
    }

    /**
     * REset hero images to 16:9 format
     * @return void
     */
    public function filterHeroImageSize($orginal_size, $args)
    {

        //If slider is shown in top area
        if ($args['id'] == "sidebar-slider-area") {
            return array(1140,641);
        }

        //Default value
        return $orginal_size;
    }
}
