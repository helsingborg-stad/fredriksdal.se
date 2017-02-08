<?php
$featuredImage = wp_get_attachment_image_src(
    get_post_thumbnail_id(),
    apply_filters('fredriksdal/page_hero',
        municipio_to_aspect_ratio('16:9', array(1140, 641))
    )
);
?>

<section class="news-story">
    @if (isset($featuredImage[0]))
    <div class="background-image" style="background-image:url('{{ $featuredImage[0] }}');"></div>
    @else
    <div class="background-gradient"></div>
    @endif

    <div class="container">
        <div class="grid">
            <div class="grid-xs-12">
                <time datetime="{{ get_post_meta(get_the_id(), 'event-date-start', true) }}">
                    {!! \Fredriksdal\Controller\ArchiveEvent::getEventDate($post) !!}
                </time>

                <h1>{{ the_title() }}</h1>

                <article>
                    {{ the_excerpt() }}
                </article>

                <a href="{{ the_permalink() }}" class="read-more">Läs mer</a>
            </div>
        </div>
    </div>
</section>
