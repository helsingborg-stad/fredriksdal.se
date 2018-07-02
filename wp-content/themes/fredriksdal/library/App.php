<?php
namespace Fredriksdal;

class App
{
    public function __construct()
    {
        new \Fredriksdal\Theme\Enqueue();
        new \Fredriksdal\Theme\Filters();

        new \Fredriksdal\Controller\Admin\RemoveOnePageMetaBox();

        // new \Fredriksdal\Theme\EventArchive();
        new \Fredriksdal\Theme\OnePage();
        new \Fredriksdal\Theme\OnePageMenu();
        new \Fredriksdal\Theme\DisableComments();
        new \Fredriksdal\Theme\News();
        new \Fredriksdal\Theme\Navigation();

        new \Fredriksdal\Theme\CustomTemplates();
        new \Fredriksdal\Theme\Api();

        if (is_admin()) {
            new \Fredriksdal\Admin\ThemeOptions();
        }
    }
}
