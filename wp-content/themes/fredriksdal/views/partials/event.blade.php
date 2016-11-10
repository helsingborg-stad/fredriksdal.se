<li>
    <a href="{{ the_permalink() }}">
        <time datetime="{{ mysql2date('Y-m-d H:i', date('Y-m-d H:i', strtotime(get_field('event-date-start')))) }}">{{ \Fredriksdal\Controller\ArchiveEvent::getEventDate($post->ID) }}</time>
        <h2>{{ the_title() }}</h2>
        <div class="hidden-sm hidden-xs">
        {{ the_content() }}
        </div>
        <div class="hidden-md hidden-lg hidden-xl">
            {{ the_excerpt() }}
        </div>
        <div class="gutter gutter-top hidden-md hidden-lg hidden-xl">
            <span class="btn btn-primary">Visa mer</span>
        </div>
    </a>
</li>
