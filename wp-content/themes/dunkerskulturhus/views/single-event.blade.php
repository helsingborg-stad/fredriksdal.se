@extends('templates.master')

@section('content')
{!! the_post() !!}

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
            @include('partials.article')

            {!! dynamic_sidebar('content-area') !!}
        </div>

        <aside class="grid-lg-3 grid-md-12">
            <a href="#" class="btn btn-green btn-block btn-lg">Köp biljetter</a>

            <div class="box box-filled">
                <div class="box-content">
                    <p>
                        <strong>Evenemanget äger rum:</strong><br>
                        Den {{ \Dunkers\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start'))) }}
                    </p>
                </div>
            </div>

            @if (count($occations) > 0)
                <div class="box box-filled">
                    <div class="box-content">
                        <h4>Fler datum för detta evenemang</h4>
                        <p>
                            <strong>{{ the_title() }}</strong> kan även ses på följande datum:
                        </p>
                        <p>
                            <ul>
                                @foreach ($occations as $occation)
                                    <li>
                                        <a class="link-item link-item-light" href="{{ get_permalink($occation->ID) }}">{{ \Dunkers\Helper\Dt::dateWithTime(strtotime(get_field('event-date-start', $occation->ID))) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                </div>
            @endif

            {!! dynamic_sidebar('right-sidebar') !!}
        </aside>
    </div>
</div>

@stop
