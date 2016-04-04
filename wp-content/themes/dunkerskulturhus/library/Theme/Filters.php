<?php

namespace Dunkers\Theme;

class Filters
{
    public function __construct()
    {

        //Add filter
        add_action('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'));
        add_action('Municipio/desktop_menu_breakpoint', array($this, 'desktopMenuBreakpoint'));
        add_action('Municipio/header_grid_size', array($this, 'headerGridSize'));

        // Search
        add_filter('Municipio/search_result/date', array($this, 'eventDate'), 10, 2);

        //Remove base-theme filters
        add_action('init', array($this, 'unregisterMunicipioImageFilter'));
    }

    public function eventDate($date, $post)
    {
        if ($post->post_type != 'event') {
            return $date;
        }

        $date = date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start', $post->ID)));

        return $date;
    }

    /**
     * Unregister built in image sizes. Use modularity
     * @return void
     */
    public function unregisterMunicipioImageFilter()
    {
        \Municipio\Theme\ImageSizeFilter::removeFilter('modularity/image/slider', 'filterHeroImageSize', 100);
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
}
