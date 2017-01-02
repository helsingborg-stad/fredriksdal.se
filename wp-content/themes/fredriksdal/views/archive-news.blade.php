
@extends('templates.master')

@section('content')

<?php global $post; ?>
<?php $i = 0; ?>
@while(have_posts())
    {!! the_post() !!}

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
                    <time datetime="{{ the_time('Y-m-d H:i:s') }}">{{ the_time(get_option('date_format')) }}</time>
                    <h1>{{ the_title() }}</h1>

                    <article>
                        {{ the_excerpt() }}
                    </article>

                    <a href="{{ the_permalink() }}" class="read-more">Läs mer</a>
                </div>
            </div>
        </div>
    </section>
@endwhile

<?php
    global $wp_query;
?>

@if ($wp_query->max_num_pages > 1)
<section class="pagination-section">
    <div class="container">
        <div class="grid">
            <div class="grid-xs-12">
                {!!
                    paginate_links(array(
                        'type' => 'list'
                    ))
                !!}
            </div>
        </div>
    </div>
</section>
@endif

@stop
