<?php

define('DUNKERS_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once DUNKERS_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new Dunkers\Vendor\Psr4ClassLoader();
$loader->addPrefix('Dunkers', DUNKERS_PATH . 'library');
$loader->addPrefix('Dunkers', DUNKERS_PATH . 'source/php/');
$loader->register();

new Dunkers\App();
