<div class="box box-event" data-equal-item>
    <span class="box-image" style="background-image:url('{{ get_field('event-image_url') }}');">
        <img src="{{ get_field('event-image_url') }}" alt="{{ get_the_title() }}">
    </span>
    <div class="event-information">
        <span class="col">
            <h3 class="event-title">{{ the_title() }}</h3>
            <span class="event-date-start">{{ date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start'))) }}</span>
        </span>
        <span class="col event-action">
            <a href="#" class="btn btn-circle btn-green"><span>Läs mer</span></a>
        </span>
    </div>
    <div class="event-lead">
        {!! the_excerpt() !!}
    </div>
</div>
