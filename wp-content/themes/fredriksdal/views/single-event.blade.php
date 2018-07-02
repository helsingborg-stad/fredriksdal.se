@extends('templates.master')

@section('content')
{!! the_post() !!}
<section class="background-white gutter gutter-vertical gutter-xl">
    <div class="container">
        <div class="grid gutter gutter-vertical gutter-xl">
            <div class="grid-md-9 grid-lg-9 grid-sm-12">

                <article class="clearfix">
                    <header>
                    <h1 {!! $image ? 'class="hidden-md hidden-lg"' : '' !!}>
                        <div class="tc">
                            <time class="date-box" datetime="{{ get_post_meta(get_the_id(), 'event-date-start', true) }}">
                                <div>
                                    <span class="day">{{ $occasion['date_parts']['date'] ?? '' }}</span>
                                    <span class="month">{{ $occasion['date_parts']['month'] ?? '' }}</span>
                                </div>
                            </time>
                        </div>

                        <div class="tc">{{ the_title() }}</div>
                    </h1>
                    </header>

                    @if (isset(get_extended($post->post_content)['main']) && strlen(get_extended($post->post_content)['main']) > 0 && isset(get_extended($post->post_content)['extended']) && strlen(get_extended($post->post_content)['extended']) > 0)

                        {!! apply_filters('the_lead', get_extended($post->post_content)['main']) !!}
                        {!! apply_filters('the_content', get_extended($post->post_content)['extended']) !!}

                    @else
                        @if (substr($post->post_content, -11) == '<!--more-->')
                        {!! apply_filters('the_lead', get_extended($post->post_content)['main']) !!}
                        @else
                        {!! the_content() !!}
                        @endif

                    @endif

                    <footer>
                        @include('partials.accessibility-menu')
                    </footer>

                </article>

                @if (is_active_sidebar('content-area'))
                <div class="sidebar-content-area">
                    {!! dynamic_sidebar('content-area') !!}
                </div>
                @endif
            </div>

            <aside class="grid-lg-3 grid-md-4 grid-sm-12 sidebar-right-sidebar">
                <div class="box box-ticket background-white">
                    <h3 class="box-title">
                        {{ the_title() }}
                        <small class="block-level">Fredriksdal Museer och trädgårdar</small>
                    </h3>
                    <div class="box-content">
                        <div class="date">
                            <label><?php _e('Date', 'fredriksdal'); ?></label>

                            @if (strtotime($occasion['start_date']) >= time())
                                <span class="value">{{explode(' ', $occasion['start_date'])[0]}}</span>
                            @elseif(count($occations) > 0)
                                <span class="value" style="text-decoration: line-through;">{{explode(' ', $occasion['start_date'])[0]}}</span>
                            @else
                                <span class="value">Passerat</span>
                            @endif

                            @if (mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) !== mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)))
                            till
                            <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)) }}</span>
                            @endif

                        </div>

                        @if (is_array(explode(' ', $occasion['start_date'])) && count(explode(' ', $occasion['start_date'])) > 1 && is_array(explode(' ', $occasion['end_date'])) && count(explode(' ', $occasion['end_date'])) > 1)
                        <div class="time clearfix">
                            <div class="time-start">
                                <label><?php _e('From', 'fredriksdal'); ?></label>
                                <div class="value">{{ mysql2date('H:i', $occasion['start_date']) }}</div>
                            </div>
                            <div class="time-end">
                                <label><?php _e('To', 'fredriksdal'); ?></label>
                                <div class="value">{{ mysql2date('H:i', $occasion['end_date']) }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="tickets">
                    @if (is_string(get_field('event-ticket_url')) && get_field('event-ticket_url'))
                        <a href="{{ get_field('event-ticket_url') }}" target="_blank">Köp biljetter</a>
                    @endif
                    </div>

                    @if (isset($occations) && (count($occations) > 0 ))
                    <div class="box-ticket-occasions">

                        <p>
                            <strong>{{ the_title() }}</strong> kan också besökas på:
                        </p>
                        <p>
                            <ul>
                                @foreach ($occations as $eventOccation)
                                    <li>
                                        @if (strtotime($eventOccation->start_date) <= time())
                                        <a class="link-item" style="text-decoration: line-through;" href="{{ esc_url(add_query_arg('date', preg_replace('/\D/', '', $eventOccation->start_date), the_permalink())) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime($eventOccation->start_date)) }}</a>
                                        @else
                                        <a class="link-item" href="{{ esc_url(add_query_arg('date', preg_replace('/\D/', '', $eventOccation->start_date), the_permalink())) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime($eventOccation->start_date)) }}</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </p>
                    </div>
                    @endif
                </div>

                {!! dynamic_sidebar('right-sidebar') !!}
            </aside>
        </div>
    </div>
</section>

@stop
