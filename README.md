
 	To install this site, please add the following in your wp-config.php file. 
 
 	/**
	 * Tells WordPress to load from local wp-content, and not vendor wp.
	 * @var bool
	 */
	define('WP_CONTENT_DIR', dirname(__FILE__) . '/wp-content');
	
	/**
	 * Tells WordPress to load assets from wp-content and not vendor wp. 
	 * @var bool
	 */
	define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content');