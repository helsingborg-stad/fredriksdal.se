<?php

/**
* Tell WordPress to load from local wp-content, and not vendor wp.
* @var bool
*/

define('WP_CONTENT_DIR', dirname(dirname(__FILE__)) . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content');
