<?php
namespace Fredriksdal;

class App
{
    public function __construct()
    {
        new \Fredriksdal\Theme\Enqueue();
    }
}