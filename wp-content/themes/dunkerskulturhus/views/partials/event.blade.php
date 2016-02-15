<a href="{{ the_permalink() }}" class="box box-event">
    @if (is_string(get_field('event-image_url')))
    <span class="box-image" style="background-image:url('{{ get_field('event-image_url') }}');">
        <img src="{{ get_field('event-image_url') }}" alt="{{ get_the_title() }}">
    </span>
    @endif

    <div class="event-information">
        <time class="event-date-start">
            {{ date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start'))) }}

            @if ($post->occations_count > 1)
            <em style="font-style:italic;">(och {{ $post->occations_count }} andra tillfällen)</em>
            @endif
        </time>
        <h3 class="event-title">{{ the_title() }}</h3>
    </div>
    <div class="event-lead">
        {!! the_content() !!}
    </div>
    <span class="event-action btn btn-circle btn-green"><span>Läs mer</span></span>
</a>
