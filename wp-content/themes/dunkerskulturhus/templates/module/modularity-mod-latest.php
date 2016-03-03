<?php

$fields = json_decode(json_encode(get_fields($module->ID)));
$posts = array();

if ($fields->post_type == 'event') {
    $posts = get_posts(array(
        'post_type' => $fields->post_type,
        'posts_per_page' => $fields->number_of_posts,
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

    include 'modularity-mod-latest-event.php';
} else {
    $posts = get_posts(array(
        'post_type' => $fields->post_type,
        'posts_per_page' => $fields->number_of_posts,
        'orderby' => $fields->sorted_by,
        'order' => $fields->order
    ));

    include 'modularity-mod-latest-default.php';
}
?>
