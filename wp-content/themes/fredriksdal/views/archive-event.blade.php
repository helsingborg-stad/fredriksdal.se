
@extends('templates.master')

@section('content')

<section class="background-lgren">
    <div class="container">
        <div class="grid">
            <div class="grid-sm-12">

                <div class="events-wrapper">

                    <nav class="event-dates text-center">
                        <ul class="nav-horizontal">
                            @foreach($quaters as $quater)
                            <li>
                                <a href="#">
                                    <span class="start-month">{{ $quater->start_month }}</span> - <span class="end-month">{{ $quater->end_month }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>

                </div>

            </div>
        </div>
    </div>
</section>

@stop
