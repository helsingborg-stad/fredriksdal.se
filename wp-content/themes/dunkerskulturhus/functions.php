<?php

//Include vendor files
if (file_exists(dirname(ABSPATH) . '/vendor/autoload.php')) {
    require_once dirname(ABSPATH) . '/vendor/autoload.php';
}

//Run theme functions
require_once get_stylesheet_directory() . '/library/Theme/EventArchive.php';
require_once get_stylesheet_directory() . '/library/Theme/Enqueue.php';
require_once get_stylesheet_directory() . '/library/Theme/Navigation.php';
require_once get_stylesheet_directory() . '/library/App.php';
new Dunkers\App();
