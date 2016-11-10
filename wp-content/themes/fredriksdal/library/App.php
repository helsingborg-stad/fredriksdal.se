<?php
namespace Fredriksdal;

class App
{
    public function __construct()
    {
        new \Fredriksdal\Theme\Enqueue();
        new \Fredriksdal\Theme\Filters();

        new \Fredriksdal\Controller\Admin\RemoveOnePageMetaBox();

        new \Fredriksdal\Theme\EventArchive();
        new \Fredriksdal\Theme\OnePage();
        new \Fredriksdal\Theme\OnePageMenu();

        new \Fredriksdal\Theme\CustomTemplates();
    }
}
