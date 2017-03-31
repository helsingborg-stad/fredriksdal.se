
@extends('templates.master')

@section('content')

<section class="background-lgren events-wrapper">
    <nav class="event-dates text-center">
        <div class="container">
            <div class="grid">
                <div class="grid-sm-12">
                    <ul class="nav-horizontal nav-justify">
                        @foreach($quaters as $quater)
                        <li>
                            <a href="?from={{ $quater->start_date }}&amp;to={{ $quater->end_date }}" class="{{ $quater->is_active ? 'active' : '' }}">
                                <span class="year">{{ $quater->year }}</span>
                                <span class="months"><span class="start-month">{{ $quater->start_month }}</span> - <span class="end-month">{{ $quater->end_month }}</span></span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    @include('partials.archive-filters')

    <div class="grid">
        <div class="grid-sm-12">
            <nav id="show-filters" class="navbar navbar-event-categories">
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

    @if (is_active_sidebar('content-area-top'))
    <div class="grid">
        <?php dynamic_sidebar('content-area-top'); ?>
    </div>
    @endif
</section>

    @if (have_posts())
        <?php global $post; ?>
        <?php $i = 0; ?>
        @while(have_posts())
            {!! the_post() !!}
            @include('partials.event')
        @endwhile
    @else
        <section class="background-green no-margin">
            <div class="container gutter gutter-xl gutter-vertical">
                <div class="grid">
                    <div class="grid-xs-12">
                        <div class="box box-index">
                            <div class="box-content">
                                <h3 class="box-title">Inga evenemang</h3>
                                <p>
                                    Det finns tyvärr inga planerade evenamng
                                    {{ isset($_GET['from']) && isset($_GET['to']) ? 'mellan ' . $_GET['from'] . ' och ' . $_GET['to'] . '. Du kan välja en annan tidsperiod ovan.' : '' }}.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@stop
