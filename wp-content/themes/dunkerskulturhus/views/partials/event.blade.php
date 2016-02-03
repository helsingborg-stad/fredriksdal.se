<div class="box box-event" data-equal-item>
    <img src="{{ get_field('event-image_url') }}" alt="{{ get_the_title() }}" class="box-event-image">
    <div class="event-information">
        <h3 class="event-title">{{ the_title() }}</h3>
        <span class="event-date-start">{{ date('Y-m-d \k\l\. H:i', strtotime(get_field('event-date-start'))) }}</span>
    </div>
</div>
