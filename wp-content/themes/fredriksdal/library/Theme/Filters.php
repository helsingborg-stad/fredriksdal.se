<?php

namespace Fredriksdal\Theme;

class Filters
{
    public function __construct()
    {

        //Add filter
        add_action('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'));
        add_action('Municipio/desktop_menu_breakpoint', array($this, 'desktopMenuBreakpoint'));
        add_action('Municipio/header_grid_size', array($this, 'headerGridSize'));
        add_filter('wp_nav_menu_items', array($this, 'addSocialIconsToMenu'), 10, 2);
        add_filter('Municipio/main_menu/items', array($this, 'addSocialIconsToMenu'), 10, 2);
        add_filter('excerpt_more', array($this, 'exerptMore'));

        /*
        add_filter('Modularity/Module/Classes', function ($classes, $postType, $args) {
            if ($postType !== 'mod-posts') {
                return $classes;
            }

            if ($key = array_search('box-news-horizontal', $classes)) {
                unset($classes[$key]);
            }

            return $classes;
        }, 10, 3);
        */

        // Search
        add_filter('Municipio/search_result/date', array($this, 'eventDate'), 10, 2);

        //Remove base-theme filters
        add_action('init', array($this, 'unregisterMunicipioImageFilter'));

        add_filter('Modularity/Module/Classes', function ($classes, $moduleType, $sidebarArgs) {
            if ($key = array_search('box-filled', $classes)) {
                unset($classes[$key]);
                $classes[] = 'box-panel';
            }
            return $classes;
        }, 100, 3);

        add_filter('openhours/shortcode', function ($input, $isException) {
            if (empty($input)) {
                return "";
            }
            if (!$isException) {
                $input = '<div>' . __("Open today: ", 'fredriksdal') . ' </div>' . $input;
            }
            return '<time class="open-hours-label button opaque">' . $input . '</time>';
        }, 10, 2);

        // Make posts compatible with flickity
        add_filter('acf/load_value/name=posts_columns', function ($value, $post_id, $field) {
            if (!is_admin()) {
                return 'grid-xs-12 grid-sm-6 '.$value;
            }

            return $value;
        }, 10, 3);

        // Titles
        add_filter('the_title', array($this, 'theTitle'), 1);
        add_filter('wp_title', array($this, 'wpTitle'), 1);

        // Sidebar WpWidget module
        add_filter('Modularity/Module/WpWidget/before', array($this, 'wpWidgetBefore'), 11, 3);

        //Body classes (removing material design, this is flat)
        add_filter('body_class', array($this, 'wpAddBodyClass'));

        //Make 16:9 to sqare
        foreach (array(
            'modularity/image/posts/items',
            'modularity/image/posts/news'
        ) as $imageFilter) {
            add_filter($imageFilter, array($this, 'imageAspectRatioSquare'), 50, 2);
        }
    }

    public function exerptMore($more)
    {
        return '…';
    }

    public function addSocialIconsToMenu($items, $args = null)
    {
        if ($args && $args->theme_location != apply_filters('Municipio/main_menu_theme_location', 'main-menu')) {
            return $items;
        }

        //Not in child (if inherited from main)
        if ($args && (isset($args->child_menu) && $args->child_menu == true) && $args->theme_location == "main-menu") {
            return $items;
        }

        $socialIcons = (array) get_field('fredriksdal_social_icons', 'option');
        foreach ($socialIcons as $icon) {
            $svg = \Municipio\Helper\Svg::extract(get_attached_file($icon['icon']['id']));
            $items .= '<li class="menu-item-social"><a href="' . $icon['link'] . '"><span data-tooltip="' . $icon['tooltip'] .'">' . $svg . '</span></a></li>' . "\n";
        }

        return $items;
    }

    /**
     * Remove material design with class
     * @return array
     */
    public function wpAddBodyClass($classes)
    {
        if (is_array($classes)) {
            $classes[] = "material-no-radius";
            $classes[] = "material-no-shadow";
        }
        return $classes;
    }

    public function wpWidgetBefore($before, $sidebarArgs, $module)
    {
        if (get_field('mod_standard_widget_type', $module->ID) == 'WP_Widget_Search') {
            return '<div>';
        }

        // Box panel in content area and content area bottom
        if (in_array($sidebarArgs['id'], array('content-area', 'content-area-bottom')) && !is_front_page()) {
            $before = '<div class="box box-panel box-panel-secondary">';
        }

        // Sidebar boxes (should be filled)
        if (in_array($sidebarArgs['id'], array('left-sidebar-bottom', 'left-sidebar', 'right-sidebar'))) {
            $before = '<div class="box box-panel">';
        }

        return $before;
    }

    public function wpTitle($title)
    {
        return str_replace(array('{', '}', '&#8211;', '-'), '', $title);
    }

    public function theTitle($title)
    {
        if (!in_the_loop()) {
            $title = str_replace(array('{', '}', '-'), '', $title);
            return $title;
        }

        $title = preg_replace('/(.*)?[-](.*)?/', '<strong>$1</strong> $2', $title);
        $title = preg_replace('/{(.*)?}/', '<strong>$1</strong>', $title);

        return trim($title);
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
        \Municipio\Theme\ImageSizeFilter::removeFilter('Modularity/slider/image', 'filterHeroImageSize', 100);
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

    public function imageAspectRatioSquare($size, $args)
    {
        if (round($size[0] / $size[1], 2) == 1.78) {
            $size[1] = $size[0];
        }
        return $size;
    }
}
