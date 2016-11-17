@extends('templates.master')

@section('content')

<?php
    $featuredImage = wp_get_attachment_image_src(
        get_post_thumbnail_id(),
        apply_filters('fredriksdal/page_hero',
            municipio_to_aspect_ratio('16:9', array(1140, 641))
        )
    );
?>

@if (!is_active_sidebar('slider-area') && is_array($featuredImage))
<div class="hero event-hero">
    <div class="slider ratio-16-9">
        <ul>
            <li>
                <div class="slider-image" style="background-image:url('{{ $featuredImage[0] }}');"></div>
            </li>
        </ul>
    </div>
</div>
@endif

<div class="container main-container">

    @include('partials.breadcrumbs')

    <div class="grid {{ implode(' ', apply_filters('Municipio/Page/MainGrid/Classes', wp_get_post_parent_id(get_the_id()) != 0 ? array('no-margin-top') : array())) }}">
        @include('partials.sidebar-left')

        <div class="{{ $contentGridSize }} grid-print-12" id="readspeaker-read">

            @if (is_active_sidebar('content-area-top'))
                <div class="grid sidebar-content-area sidebar-content-area-top">
                    <?php dynamic_sidebar('content-area-top'); ?>
                </div>
            @endif

            @while(have_posts())
                {!! the_post() !!}

                @include('partials.article')
            @endwhile

            @if (is_active_sidebar('content-area'))
                <div class="grid sidebar-content-area sidebar-content-area-bottom">
                    <?php dynamic_sidebar('content-area'); ?>
                </div>
            @endif

            <div class="hidden-xs hidden-sm hidden-md hidden-print">
                @include('partials.page-footer')
            </div>
        </div>


        @include('partials.sidebar-right')
    </div>

    <div class="grid hidden-lg hidden-xl">
        <div class="grid-sm-12">
            @include('partials.page-footer')
        </div>
    </div>
</div>

@stop
