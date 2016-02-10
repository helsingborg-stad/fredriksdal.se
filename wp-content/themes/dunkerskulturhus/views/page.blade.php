@extends('templates.master')

@section('content')

<div class="container no-margin-top">
    @include('partials.breadcrumbs')

    <div class="grid no-margin-top">
        @include('partials.sidebar-left')

        <div class="{{ is_active_sidebar('right-sidebar') ? 'grid-md-8 grid-lg-6' : 'grid-md-8' }}">
            @while(have_posts())
                {!! the_post() !!}

                @include('partials.article')
            @endwhile

            {!! dynamic_sidebar('content-area') !!}
        </div>

        @if (is_active_sidebar('right-sidebar'))
            @include('partials.sidebar-right')
        @endif
    </div>
</div>

@stop
