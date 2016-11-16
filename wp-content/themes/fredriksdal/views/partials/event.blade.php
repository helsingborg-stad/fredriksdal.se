<?php

    $attachmentId = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src($attachmentId, 'original');

    if (isset($image[0])) {
        $image = $image[0];
    } else {
        $image = '';
    }

?>

<li>
    <a href="{{ the_permalink() }}" style="background-image:url('{{ $image }}');">
        <div class="event-information">
            <div class="fix-bottom">
            <div class="container">
                <div class="grid">
                    <div class="grid-sm-12 pos-relative">
                        <time datetime="{{ get_post_meta(get_the_id(), 'event-date-start', true) }}">
                            {{ \Fredriksdal\Controller\ArchiveEvent::getEventDate($post->ID) }}
                        </time>

                        <h1>{{ the_title() }}</h1>

                        <span class="more-btn pricon pricon-3x pricon-next"></span>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </a>
</li>
