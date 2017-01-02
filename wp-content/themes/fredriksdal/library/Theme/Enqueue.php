<?php

namespace Fredriksdal\Theme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'script'));

        add_filter('style_loader_tag', array($this, 'changeMedia'));
        //add_filter('script_loader_tag', array($this, 'deferMaps'), 10, 2);
    }

    public function deferMaps($tag, $handle)
    {
        if ($handle === 'GoogleMaps') {
            $tag = str_replace('></script>', ' defer></script>', $tag);
        }

        return $tag;
    }

    public function changeMedia($tag)
    {
        $tag = str_replace("id='fredriksdal-font-css'", "id='fredriksdal-font-css' onload=\"if(media!='all')media='all'\"", $tag);
        return $tag;
    }

    /**
     * Enqueue styles
     * @return void
     */
    public function style()
    {
        wp_enqueue_style('fredriksdal-font', '//cloud.typography.com/6096514/6506972/css/fonts.css', '', '1.0.0'. 'none');
        wp_enqueue_style('fredriksdal-css', get_stylesheet_directory_uri(). '/assets/dist/css/app.min.css', '', filemtime(get_stylesheet_directory() . '/assets/dist/css/app.min.css'));
    }

    /**
     * Enqueue scripts
     * @return void
     */
    public function script()
    {
        wp_enqueue_script('Fredriksdal-js', get_stylesheet_directory_uri(). '/assets/dist/js/app.js', '', filemtime(get_stylesheet_directory() . '/assets/dist/js/app.min.js'), true);
        wp_enqueue_script('GoogleMaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCG3F8yqWittpGmEATWu08ftqD6cRiFIo0', 'Fredriksdal-js', '1.0.0', true);
    }
}
