<?php
namespace Dunkers;

class App
{
    public function __construct()
    {
		new \Dunkers\ChildTheme\Enqueue();
    }
}
