@extends('templates.master')

@section('content')

@if (is_active_sidebar('content-area'))
<section class="creamy creamy-border-bottom gutter-xl gutter-vertical sidebar-content-area">
    <div class="container main-container">
        <div class="grid">
            {{ dynamic_sidebar('content-area') }}
        </div>
    </div>
</section>
@endif

<div class="container gutter-xl gutter-vertical sidebar-content-area-bottom">
    <div class="grid">
        {{ dynamic_sidebar('content-area-bottom') }}
    </div>
</div>

@stop
