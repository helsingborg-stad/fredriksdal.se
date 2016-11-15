<header id="site-header" class="site-header header-casual">
    @include('partials.search.top-search')

    <nav class="navbar navbar-mainmenu">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 {!! apply_filters('Municipio/header_grid_size','grid-md-12'); !!}">

                    {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')) !!}

                    {!!
                        wp_nav_menu(array(
                            'theme_location' => 'header-tabs-menu',
                            'container' => 'nav',
                            'container_class' => 'hidden-print hidden-xs hidden-sm hidden-md',
                            'container_id' => 'header-tabs',
                            'menu_class' => 'small navbar',
                            'menu_id' => 'help-menu-top-bar',
                            'echo' => 'echo',
                            'before' => '',
                            'after' => '',
                            'link_before' => '',
                            'link_after' => '',
                            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                            'depth' => 1,
                            'fallback_cb' => '__return_false'
                        ));
                    !!}

                    {!! $navigation['mainMenu'] !!}
                    <a href="#mobile-menu" data-target="#mobile-menu" class="{!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!} menu-trigger"><span class="menu-icon"></span></a>
                </div>
            </div>
        </div>
    </nav>

    @if (strlen($navigation['mobileMenu']) > 0)
        <nav id="mobile-menu" class="nav-mobile-menu nav-toggle {!! apply_filters('Municipio/mobile_menu_breakpoint','hidden-md hidden-lg'); !!}">
            @include('partials.mobile-menu')
        </nav>
    @endif
</header>

@include('partials.hero')
