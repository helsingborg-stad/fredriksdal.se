@extends('templates.master')

@section('content')

<div class="container">
    @include('partials.breadcrumbs')

    <div class="grid">
        <div class="grid-sm-12">
            <h1>Kommande evenemang</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-sm-12">
            <nav class="navbar navbar-event-categories">
            {!!
                wp_nav_menu(array(
                    'theme_location' => 'event-categories',
                    'container' => false,
                    'container_class' => 'menu-{menu-slug}-container',
                    'container_id' => '',
                    'menu_class' => 'nav nav-horizontal',
                    'menu_id' => 'event-categories',
                    'echo' => false,
                    'before' => '',
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 1,
                ));
            !!}
            </nav>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-12">
            <div class="grid" data-equal-container>
                @while(have_posts())
                    {!! the_post() !!}

                    <div class="grid-md-4">
                        @include('partials.event')
                    </div>
                @endwhile
            </div>
        </div>
    </div>
</div>

@stop
