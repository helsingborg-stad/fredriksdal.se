<?php

define('FREDRIKSDAL_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

require_once FREDRIKSDAL_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new FREDRIKSDAL\Vendor\Psr4ClassLoader();
$loader->addPrefix('Fredriksdal', FREDRIKSDAL_PATH . 'library');
$loader->addPrefix('Fredriksdal', FREDRIKSDAL_PATH . 'source/php/');
$loader->register();

new Fredriksdal\App();
