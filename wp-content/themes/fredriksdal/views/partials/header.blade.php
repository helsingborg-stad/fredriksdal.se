<header id="site-header" class="site-header header-casual">
    <div class="search-top {!! apply_filters('Municipio/desktop_menu_breakpoint','hidden-sm'); !!}" id="search">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12">
                    {{ get_search_form() }}
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-mainmenu">
        <div class="container">
            <div class="grid">
                <div class="grid-xs-12 {!! apply_filters('Municipio/header_grid_size','grid-md-12'); !!}">

                    {!! municipio_get_logotype(get_field('header_logotype', 'option'), get_field('logotype_tooltip', 'option')) !!}

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
