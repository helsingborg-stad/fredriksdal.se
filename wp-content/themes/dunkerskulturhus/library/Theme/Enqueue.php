<?php

namespace Dunkers\ChildTheme;

class Enqueue
{
    public function __construct()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'style'));
        add_action('wp_enqueue_scripts', array($this, 'script'));

    }

    /**
     * Enqueue styles
     * @return void
     */
    public function style()
    {
        wp_enqueue_style('dunkers-css', get_stylesheet_directory_uri(). 'assets/dist/css/app.min.css', '', '1.0.0');
    }

    /**
     * Enqueue scripts
     * @return void
     */
    public function script()
    {
        wp_enqueue_script('dunkers-js', get_stylesheet_directory_uri(). 'assets/dist/js/hbg-prime.min.js', '', '1.0.0', true);

    }

}
