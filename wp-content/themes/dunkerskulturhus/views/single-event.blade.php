@extends('templates.master')

@section('content')

<div class="hero hidden-xs hidden-sm">
    <div class="slider">
        <ul>
            <li>
                <div class="slider-image" style="background-image:url('{{ get_field('event-image_url') }}');">
                    <span class="text-block">{{ the_title() }}<br>{{ \Dunkers\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start'))) }}</span>
                </div>
            </li>
        </ul>
    </div>
</div>

<div class="container">
    @include('partials.breadcrumbs')

    <div class="grid no-margin-top">
        <div class="grid-md-8 grid-lg-8">
            @while(have_posts())
                {!! the_post() !!}

                @include('partials.article')
            @endwhile

            {!! dynamic_sidebar('content-area') !!}
        </div>

        @include('partials.sidebar-right')
    </div>
</div>

@stop
