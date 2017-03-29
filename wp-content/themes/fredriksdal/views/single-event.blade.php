@extends('templates.master')

@section('content')
{!! the_post() !!}

<section class="background-white gutter gutter-vertical gutter-xl">
    <div class="container">
        <div class="grid gutter gutter-vertical gutter-xl">
            <div class="grid-md-9 grid-lg-9 grid-sm-12">
                <?php global $post; ?>
                <article class="clearfix">
                    <header>
                    <h1 {!! $image ? 'class="hidden-md hidden-lg"' : '' !!}>
                        <div class="tc">
                            <time class="date-box" datetime="{{ get_post_meta(get_the_id(), 'event-date-start', true) }}">
                                <div>
                                    <span class="day">{{ mysql2date('j', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
                                    <span class="month">{{ mysql2date('M', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
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

                            @if (count($occations) > 0)
                                <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
                            @elseif(count($passedOccations) > 0)
                                <span class="value" style="text-decoration: line-through;">{{ mysql2date('Y-m-d', $passedOccations[0]) }}</span>
                            @else
                                <span class="value">Passerat</span>
                            @endif

                            @if (mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) !== mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)))
                            till
                            <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-end', true)) }}</span>
                            @endif

                        </div>

                        @if (count($occations) > 0)
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

                        @endif
                    </div>

                    <div class="tickets">
                    @if (is_string(get_field('event-ticket_url')) && get_field('event-ticket_url'))
                        <a href="{{ get_field('event-ticket_url') }}" target="_blank">Köp biljetter</a>
                    @endif
                    </div>

                    <?php //var_dump($passedOccations); ?>

                    @if (isset($occations) && isset($passedOccations) && (count($occations) > 0 || count($passedOccations) > 0 ))
                    <div class="box-ticket-occasions">
                        <p>
                            <strong>{{ the_title() }}</strong> kan också besökas på:
                        </p>
                        <p>
                            <ul>
                                @foreach ($passedOccations as $occation)
                                    <li>
                                        <span style="text-decoration: line-through;" class="link-item" >{{ \Municipio\Helper\Dt::dateWithTime(strtotime(get_field('event-date-start', $occation->ID))) }}</span>
                                    </li>
                                @endforeach
                                @foreach ($occations as $occation)
                                    <li>
                                        <a class="link-item" href="{{ get_permalink($occation->ID) }}">{{ \Municipio\Helper\Dt::dateWithTime(strtotime(get_field('event-date-start', $occation->ID))) }}</a>
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
