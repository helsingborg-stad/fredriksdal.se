<?php

$posts = array();
$fields = json_decode(json_encode(get_fields($module->ID)));

$getPostArgs = array(
    'post_type' => $fields->post_type,
    'posts_per_page' => $fields->number_of_posts,
);

if ($fields->taxonomy_filter === true) {
    $getPostArgs['tax_query'] = array();

    foreach ($fields->filter_posts_by_tag as $tag) {
        $getPostArgs['tax_query'][] = array(
            'taxonomy' => $fields->filter_posts_taxonomy_type,
            'field'    => 'slug',
            'terms'    => $tag,
        );
    }
}

if ($fields->post_type == 'event') {

    $getPostArgs = array_merge($getPostArgs, array(
        'meta_key' => 'event-date-start',
        'orderby' => 'meta_value',
        'order' => 'asc',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key'     => 'event-date-start',
                'value'   => date('Y-m-d H:i:s'),
                'compare' => '>=',
            )
        )
    ));
    $posts = get_posts($getPostArgs);

    include 'modularity-mod-latest-event.php';

} else {

    $getPostArgs = array_merge($getPostArgs, array(
        'orderby' => $fields->sorted_by,
        'order' => $fields->order
    ));
    $posts = get_posts($getPostArgs);

    include 'modularity-mod-latest-default.php';
}
