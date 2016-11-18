@extends('templates.master')

@section('content')
{!! the_post() !!}

<section class="background-white gutter gutter-vertical gutter-xl">
    <div class="container">
        <div class="grid gutter gutter-vertical gutter-xl">
            <div class="grid-md-8 grid-lg-8 grid-sm-12">
                <?php global $post; ?>
                <article class="clearfix">
                    <h1 {!! $image ? 'class="hidden-md hidden-lg"' : '' !!}>
                        <time class="date-box" datetime="{{ get_post_meta(get_the_id(), 'event-date-start', true) }}">
                            <div>
                                <span class="day">{{ mysql2date('j', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
                                <span class="month">{{ mysql2date('M', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
                            </div>
                        </time>

                        {{ the_title() }}
                    </h1>

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
                            <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>

                            @if (mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) !== mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)))
                            till
                            <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)) }}</span>
                            @endif
                        </div>
                        <div class="time clearfix">
                            <div class="time-start">
                                <label><?php _e('From', 'fredriksdal'); ?></label>
                                <div class="value">{{ mysql2date('H:i', get_post_meta(get_the_id(), 'event-date-start', true)) }}</div>
                            </div>
                            <div class="time-end">
                                <label><?php _e('To', 'fredriksdal'); ?></label>
                                <div class="value">{{ mysql2date('H:i', get_post_meta(get_the_id(), 'event-date-end', true)) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="tickets">
                    @if (is_string(get_field('event-ticket_url')) && get_field('event-ticket_url'))
                        <a href="{{ get_field('event-ticket_url') }}" target="_blank">Köp biljetter</a>
                    @else

                    @endif
                    </div>
                </div>

                @if (isset($occations) && count($occations) > 0)
                    <div class="box box-filled background-white">
                        <div class="box-content">
                            <p>
                                <strong>{{ the_title() }}</strong> kan även ses på följande datum:
                            </p>
                            <p>
                                <ul>
                                    @foreach ($occations as $occation)
                                        <li>
                                            <a class="link-item link-item-light" href="{{ get_permalink($occation->ID) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime(get_field('event-date-start', $occation->ID))) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

                {!! dynamic_sidebar('right-sidebar') !!}
            </aside>
        </div>
    </div>
</section>

@stop
