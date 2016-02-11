<?php

namespace Dunkers\Theme;

class Filters
{
    public function __construct()
    {
        add_action('Municipio/mobile_menu_breakpoint', array($this, 'mobileMenuBreakpoint'));
        add_action('Municipio/desktop_menu_breakpoint', array($this, 'desktopMenuBreakpoint'));
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function mobileMenuBreakpoint($classes)
    {
        return "hidden-lg";
    }

    /**
     * Show mobile menu in all but large size.
     * @return void
     */
    public function desktopMenuBreakpoint($classes)
    {
        return "hidden-xs hidden-sm hidden-md";
    }
}
