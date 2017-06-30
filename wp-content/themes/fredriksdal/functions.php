<?php

define('FREDRIKSDAL_PATH', get_stylesheet_directory() . '/');

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

add_action('after_setup_theme', function () {
    load_theme_textdomain('fredriksdal', get_stylesheet_directory() . '/languages');
});

require_once FREDRIKSDAL_PATH . 'library/Vendor/Psr4ClassLoader.php';
$loader = new Fredriksdal\Vendor\Psr4ClassLoader();
$loader->addPrefix('Fredriksdal', FREDRIKSDAL_PATH . 'library');
$loader->addPrefix('Fredriksdal', FREDRIKSDAL_PATH . 'source/php/');
$loader->register();

add_action('init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('fredriksdal');
    $acfExportManager->setExportFolder(FREDRIKSDAL_PATH . 'library/AcfFields');
    $acfExportManager->autoExport(array(
        'fredriksdal-menu'             => 'group_581b2c1c5fb02',
        'fredriksdal-section'          => 'group_5810c4152dd10',
        'fredriksdal-campaign'         => 'group_58243e71da006',
        'fredriksdal-options'          => 'group_5825cca7a2d15',
    ));
    $acfExportManager->import();
});

new Fredriksdal\App();
