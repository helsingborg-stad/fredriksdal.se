@if (is_active_sidebar('slider-area') === true )
<div class="hero sidebar-slider-area">
    @if (is_active_sidebar('slider-area'))
        {{ dynamic_sidebar('slider-area') }}
    @endif

    @include('partials.stripe')

    @if (is_front_page() && get_field('front_page_hero_search', 'option') === true)
        {{ get_search_form() }}
    @endif

    <a href="#main-content" class="scroll-down-please">
        <div class="scroll-down-please-icon"></div>
        {{ __("Scroll down", 'fredriksdal') }}
    </a>
</div>
@else
<?php
    $featuredImage = null;

    if (is_single() || is_page()) {
        $featuredImage = wp_get_attachment_image_src(
            get_post_thumbnail_id(),
            apply_filters('fredriksdal/page_hero',
                municipio_to_aspect_ratio('16:9', array(1140, 641))
            )
        );
    }
?>

@if (is_array($featuredImage))
<div class="hero hero-featured-image">
    <div class="slider ratio-16-9">
        <ul>
            <li>
                <div class="slider-image" style="background-image:url('{{ $featuredImage[0] }}');"></div>
            </li>
        </ul>
    </div>
</div>
@endif
@endif
