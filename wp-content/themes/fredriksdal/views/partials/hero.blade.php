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
        <?php _e("Scroll down", 'fredriksdal'); ?>
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
    <div class="slider ratio-16-9 slider-layout-default">
        <div data-flickity='{"cellSelector":".slide","cellAlign":"left","wrapAround":false,"pageDots":false,"freeScroll":false,"groupCells":false,"draggable":false,"prevNextButtons":false,"autoPlay":false}'>
            <li class="slide type-image">
                <div class="slider-image" style="background-image:url('{{ $featuredImage[0] }}');"></div>
            </li>
        </div>
    </div>
</div>
@endif
@endif

<div class="hero has-stripe sidebar-slider-area">
        <div class="grid no-gutter">
            <div class="modularity-mod-slider modularity-mod-slider-162"><div class="modularity-edit-module"><a href="https://dinstad.helsingborg.se/wp/wp-admin/post.php?post=162&amp;action=edit&amp;is_thickbox=true&amp;is_inline=true">Edit module</a></div>
<div>

<div class="slider ratio-16-9 slider-layout-default">
    <div data-flickity="{&quot;cellSelector&quot;:&quot;.slide&quot;,&quot;cellAlign&quot;:&quot;left&quot;,&quot;wrapAround&quot;:false,&quot;pageDots&quot;:false,&quot;freeScroll&quot;:false,&quot;groupCells&quot;:false,&quot;draggable&quot;:false,&quot;prevNextButtons&quot;:false,&quot;autoPlay&quot;:false}" class="flickity-enabled" tabindex="0">

        <div class="flickity-viewport" style="height: 1047.38px;"><div class="flickity-slider" style="left: 0px; transform: translateX(0%);"><div class="slide type-image is-selected" style="position: absolute; left: 0%;">

            <!-- Link start -->

            <!-- Slides -->

                                <div class="slider-image slider-image-desktop hidden-xs hidden-sm" style="background-image:url(https://dinstad.helsingborg.se/wp-content/uploads/sites/8/2017/01/top1-1140x641.jpg)"></div>
                                                <div class="slider-image slider-image-mobile hidden-md hidden-lg" style="background-image:url(https://dinstad.helsingborg.se/wp-content/uploads/sites/8/2017/01/top1-500x500.jpg)"></div>


            <!-- Text -->

                    </div></div></div></div>

</div>
</div>
</div>        </div>

        <div class="stripe">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

            </div>
