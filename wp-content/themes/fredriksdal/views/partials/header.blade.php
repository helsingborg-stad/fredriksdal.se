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
                    <span class="dropdown">
                        <span class="dropdown-toggle hidden"><?php _e('More', 'municipio'); ?></span>
                        <ul class="dropdown-menu nav-grouped-overflow hidden"></ul>
                    </span>

                    @if (get_field('header_dropdown_links', 'option') === true && \Municipio\Helper\Navigation::getMenuNameByLocation('dropdown-links-menu'))
                        <span class="c-dropdown js-dropdown ">
                         <span class="c-dropdown-link translate c-dropdown__toggle js-dropdown__toggle">{{ \Municipio\Helper\Navigation::getMenuNameByLocation('dropdown-links-menu')}}</span>
                         <span class="c-dropdown__menu c-dropdown__menu--bubble">
                                    {!! \Municipio\Theme\Navigation::outputDropdownLinksMenu() !!}
                         </span>
                        </span>
                     @endif
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
