@extends('templates.master')

@section('content')

<div class="container">
    @include('partials.breadcrumbs')

    <div class="grid no-margin-top">
        @include('partials.sidebar-left')

        <div class="grid-md-12">
            <div class="grid" data-equal-container>
                @while(have_posts())
                    {!! the_post() !!}

                    <div class="grid-md-4">
                        @include('partials.event')
                    </div>
                @endwhile
            </div>

            {!! dynamic_sidebar('content-area') !!}
        </div>

        @include('partials.sidebar-right')
    </div>
</div>

@stop
