@extends('templates.master')

@section('content')

<div class="container">
    @include('partials.breadcrumbs')

    <div class="grid">
        <div class="grid-sm-12">
            <h1>Kommande evenemang</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-12">
            <div class="grid" data-equal-container>
                @while(have_posts())
                    {!! the_post() !!}

                    <div class="grid-md-4">
                        @include('partials.event')
                    </div>
                @endwhile
            </div>
        </div>
    </div>
</div>

@stop
