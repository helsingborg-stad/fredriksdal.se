@extends('templates.master')

@section('content')
{!! the_post() !!}

<style scoped>
#campaign-wrapper {
    background-color: {{ $background_color }};
    color: {{ $text_color }};
}

#campaign-wrapper * {
    color: {{ $text_color }};
}

.campaign-title {
    text-align: {{ $title_alignment }};
    margin: 0;
    padding: 0;
    font-weight: normal;
}
</style>

<section id="campaign-wrapper" class="header-gutter">
    <div class="container gutter gutter-top gutter-xl">
        <div class="grid">
            <div class="grid-xs-12">
                @if ($title_type == 'custom')
                    @foreach ($title_custom as $key => $title)
                        <style scoped>
                            .campaign-title[data-key="{{ $key }}"] {
                                @if (in_array('u', $title['style']))
                                text-decoration: underline;
                                @endif
                                @if (in_array('b', $title['style']))
                                font-weight: bold;
                                @endif
                            }
                        </style>
                        <{{ $title['size'] }} class="campaign-title" data-key="{{ $key }}">{{ $title['title'] }}</{{ $title['size'] }}>
                    @endforeach
                @else
                <h1 class="campaign-title">{{ the_title() }}</h1>
                @endif
            </div>
        </div>
    </div>

    @if (is_active_sidebar('content-area-top'))
    <div class="sidebar-content-area-top gutter gutter-top gutter-xl">
        <div class="grid">
        {!! dynamic_sidebar('content-area-top') !!}
        </div>
    </div>
    @endif

    <div class="container gutter gutter-vertical gutter-xl">
        <div class="grid">
            <div class="grid-xs-12">
                <article class="full">
                    {!! the_content() !!}
                </article>
            </div>
        </div>

        @if (is_active_sidebar('content-area'))
        <div class="grid">
        {!! dynamic_sidebar('content-area') !!}
        </div>
        @endif
    </div>
</section>

@stop

