@extends('templates.master')

@section('content')

@if (is_active_sidebar('content-area'))
<section class="creamy creamy-border-bottom gutter-xl gutter-vertical">
    <div class="container">
        <div class="grid">
            {{ dynamic_sidebar('content-area') }}
        </div>
    </div>
</section>
@endif

<div class="container gutter-xl gutter-vertical">
    <div class="grid">
        {{ dynamic_sidebar('content-area-bottom') }}
    </div>

    <div class="grid">
        <div class="grid-md-6">
            <div class="box box-panel box-panel-secondary">
                <h4 class="box-title"></h4>
                <ul>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                </ul>
            </div>
        </div>
        <div class="grid-md-6">
            <div class="box box-panel box-panel-secondary">
                <h4 class="box-title"></h4>
                <ul>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                    <li><a href="#" class="link-item">Nyhet</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@stop
