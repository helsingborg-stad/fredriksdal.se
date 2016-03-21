@extends('templates.master')

@section('content')
{!! the_post() !!}

<?php

    $attachmentId = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($attachmentId, 'original');
    if (isset($image[0])) {
        $image = $image[0];
    }

?>

@if ($image)
<div class="hero hidden-xs hidden-sm">
    <div class="slider">
        <ul>
            <li class="has-text-block">
                <div class="slider-image" style="background-image:url('{{ $image }}');">
                    <span class="text-block">{{ the_title() }}<br>{{ \Municipio\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start'))) }}</span>
                </div>
            </li>
        </ul>
    </div>
</div>
@endif

<div class="container main-container">
    <div class="grid">
        <div class="grid-md-8 grid-lg-8">
            @include('partials.article')

            @if (is_active_sidebar('content-area'))
            <div class="sidebar-content-area">
                {!! dynamic_sidebar('content-area') !!}
            </div>
            @endif
        </div>

        <aside class="grid-lg-3 grid-md-12 sidebar-right-sidebar">
            @if (is_string(get_field('event-ticket_url')) && get_field('event-ticket_url'))
            <a href="{{ get_field('event-ticket_url') }}" target="_blank" class="btn btn-green btn-block btn-lg">Köp biljetter</a>
            @endif

            <div class="box box-filled">
                <div class="box-content">
                    <p>
                        <strong>Evenemanget äger rum:</strong><br>
                        Den {{ \Municipio\Helper\Dt::toStringFormat(strtotime(get_field('event-date-start'))) }}
                    </p>
                </div>
            </div>

            @if (isset($occations) && count($occations) > 0)
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
                                        <a class="link-item link-item-light" href="{{ get_permalink($occation->ID) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime(get_field('event-date-start', $occation->ID))) }}</a>
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
