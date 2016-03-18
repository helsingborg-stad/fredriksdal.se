@if (is_active_sidebar('slider-area') === true )
<div class="hero sidebar-slider-area">
    @if (is_active_sidebar('slider-area'))
        {{ dynamic_sidebar('slider-area') }}
    @endif

    @include('partials.stripe')

    @if (is_front_page() && get_field('front_page_hero_search', 'option') === true)
        {{ get_search_form() }}
    @endif

    <div class="scroll-down-please">
        <div class="scroll-down-please-icon"></div>
        Scrolla ner
    </div>
</div>
@endif
