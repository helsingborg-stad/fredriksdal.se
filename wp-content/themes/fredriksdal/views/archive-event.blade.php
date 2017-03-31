
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
                            <a href="{{ $quater->url }}" class="{{ $quater->is_active ? 'active' : '' }}">
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

    <section class="creamy creamy-border-bottom gutter-lg gutter-vertical sidebar-content-area archive-filters">
        <form method="get" action="./" class="container" id="archive-filter">

            <div class="max-width-container">
                <div class="grid">

                    <input type="text" name="from" value="{{ sanitize_text_field($_GET['from']) }}" hidden />
                    <input type="text" name="to" value="{{ sanitize_text_field($_GET['to']) }}" hidden />
                    <input type="text" name="filter" value="{{ sanitize_text_field($_GET['filter']) }}" hidden />

                    <div class="grid-xs-12">
                        <div class="input-group">
                            <input type="text" name="search" id="filter-keyword" class="form-control" value="{{ sanitize_text_field($_GET['search']) }}" placeholder="<?php _e("Ange ett sökord"); ?>">
                            <span class="input-group-addon-btn">
                                <input type="submit" value="<?php _e("Sök"); ?>" class="btn btn-primary btn-block">
                            </span>
                        </div>
                    </div>

                    @if (is_array($links) && !empty($links))
                        <div class="grid-xs-12">
                            <ul id="event-categories" class="nav nav-horizontal">
                                @foreach($links as $link)
                                    <li class="{{ $link->classes }}">
                                        @if(preg_match("/current/i", $link->classes))
                                            <a class="close-me" href="{{ $baseLink }}"><i class="pricon pricon-close"></i></a>
                                        @endif
                                        <a href="{!! $link->link !!}">{{ $link->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>

        </form>

    </section>

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
