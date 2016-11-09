<li>
    <a href="{{ the_permalink() }}">
        <time datetime="{{ mysql2date('Y-m-d H:i', date('Y-m-d H:i', strtotime(get_field('event-date-start')))) }}">{{ \Fredriksdal\Controller\ArchiveEvent::getEventDate($post->ID) }}</time>
        <h2>{{ the_title() }}</h2>
        {{ the_content() }}
    </a>
</li>
