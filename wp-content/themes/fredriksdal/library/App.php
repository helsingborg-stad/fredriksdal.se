<?php
namespace Fredriksdal;

class App
{
    public function __construct()
    {
        new \Fredriksdal\Theme\Enqueue();
        new \Fredriksdal\Theme\Filters();

        new \Fredriksdal\Controller\Admin\RemoveOnePageMetaBox();
    }
}
