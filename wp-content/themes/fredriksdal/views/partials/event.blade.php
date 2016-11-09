<li>
    <a href="{{ the_permalink() }}">
        <time datetime="{{ mysql2date('Y-m-d H:i', date('Y-m-d H:i', strtotime(get_field('event-date-start')))) }}">{{ mysql2date('d F \k\l\. H:i', date('Y-m-d H:i:s', strtotime(get_field('event-date-start')))) }}</time>
        <h2>{{ the_title() }}</h2>
        {{ the_content() }}
    </a>
</li>
