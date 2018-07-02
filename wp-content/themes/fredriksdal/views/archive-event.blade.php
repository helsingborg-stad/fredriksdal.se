
@extends('templates.master')

@section('content')

<section class="background-lgren events-wrapper">
    <nav class="event-dates text-center">
    </nav>



    @if (is_active_sidebar('content-area-top'))
    <div class="grid">
        <?php dynamic_sidebar('content-area-top'); ?>
    </div>
    @endif

</section>
@include('partials.archive-filters')
    @if (have_posts())
        <?php global $post; ?>
        <?php $i = 0; ?>
        @while(have_posts())
            {!! the_post() !!}
            @include('partials.event')
        @endwhile
    @else
        <section class="background-green no-margin">
            <div class="container gutter gutter-xl gutter-vertical">
                <div class="grid">
                    <div class="grid-xs-12">
                        <div class="box box-index">
                            <div class="box-content">
                                <h3 class="box-title">Inga evenemang</h3>
                                <p>
                                    Det finns tyvärr inga planerade evenamng
                                    {{ isset($_GET['from']) && isset($_GET['to']) ? 'mellan ' . $_GET['from'] . ' och ' . $_GET['to'] . '. Du kan välja en annan tidsperiod ovan.' : '' }}.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

@stop
