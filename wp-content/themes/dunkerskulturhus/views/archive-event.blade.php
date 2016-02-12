@extends('templates.master')

@section('content')

<div class="container">
    @include('partials.breadcrumbs')

    <div class="grid">
        <div class="grid-sm-12">
            <h1><strong>Kommande</strong> evenemang</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-sm-12">
            <nav id="show-filters" class="navbar navbar-event-categories">
                <a href="#show-filters" class="event-categories-filter">Filtrera</a>
                <a href="#" class="event-categories-filter close">Dölj filter</a>
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
                        'fallback_cb' => '__return_false'
                    ));
                !!}
            </nav>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-12">
            <div class="grid" data-equal-container>
                <?php global $post; ?>
                <?php $i = 0; ?>
                @while(have_posts())
                    {!! the_post() !!}
                    <?php $i++; ?>

                    <div class="{{ ($i == 1) ? 'grid-md-8' : 'grid-md-4' }} grid-sm-6">
                        @include('partials.event')
                    </div>
                @endwhile
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="grid-sm-12 text-center">
            {!!
                paginate_links(array(
                    'type' => 'list'
                ))
            !!}
        </div>
    </div>
</div>

@stop
