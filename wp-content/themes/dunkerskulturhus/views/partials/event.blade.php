<a href="{{ the_permalink() }}" class="box box-event" data-equal-item>
    <span class="box-image" style="background-image:url('{{ get_field('event-image_url') }}');">
        <img src="{{ get_field('event-image_url') }}" alt="{{ get_the_title() }}">
    </span>
    <div class="event-information">
        <h3 class="event-title">{{ the_title() }}</h3>
        <span class="event-date-start">
            {{ date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start'))) }}
            @if ($post->occations_count > 1)
            <em style="font-style:italic;">(och {{ $post->occations_count }} andra tillfällen)</em>
            @endif
        </span>
    </div>
    <div class="event-lead">
        {!! the_excerpt() !!}
    </div>
    <span class="event-action btn btn-circle btn-green"><span>Läs mer</span></span>
</a>
