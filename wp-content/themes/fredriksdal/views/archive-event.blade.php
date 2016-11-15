
@extends('templates.master')

@section('content')

<section class="background-lgren gutter gutter-bottom gutter-xl">
    <div class="container">
        <div class="grid">
            <div class="grid-sm-12">

                <div class="events-wrapper">

                    <nav class="event-dates text-center">
                        <ul class="nav-horizontal">
                            @foreach($quaters as $quater)
                            <li>
                                <a href="?s=&amp;from={{ $quater->start_date }}&amp;to={{ $quater->end_date }}">
                                    <span class="year">{{ $quater->year }}</span>
                                    <span class="months"><span class="start-month">{{ $quater->start_month }}</span> - <span class="end-month">{{ $quater->end_month }}</span></span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>

                    @if (is_active_sidebar('content-area-top'))
                    <div class="grid">
                        <?php dynamic_sidebar('content-area-top'); ?>
                    </div>
                    @endif

                    <?php global $post; ?>
                    <?php $i = 0; ?>
                    <div class="gutter gutter-xl">
                        <div class="grid">
                        @while(have_posts())
                            {!! the_post() !!}
                            @include('partials.event')
                        @endwhile
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

@stop
