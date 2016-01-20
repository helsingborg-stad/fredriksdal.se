<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 * @var bool
 */
define('WP_USE_THEMES', true);

/**
 * Tells WordPress to load from local wp-content, and not vendor wp.
 * @var bool
 */
define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');

/**
 * Tells WordPress to load assets from wp-content and not vendor wp. 
 * @var bool
 */
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content');v

/** Loads the WordPress Environment and Template */
require(dirname(__FILE__) . '/wp/wp-blog-header.php');
