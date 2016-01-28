@extends($wp_parent_theme . '.views.templates.master')

@section('content')

<section class="creamy creamy-border-bottom gutter-xl gutter-vertical">
    <div class="container">
        <div class="grid">
            <div class="grid-lg-6">
                <div class="box box-panel">
                    <h4 class="box-title">Öppettider</h4>
                    <div class="box-content gutter">
                        <p>
                            <strong>Utställningarna:</strong><br>
                            Måndag: Stängt<br>
                            Tis-tors: 10:00-18:00<br>
                            Fredag: 10:00-20:00<br>
                            Lör-sön: 10:00-17:00
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid-lg-6">
                <div class="box box-panel">
                    <h4 class="box-title">Senaste nytt</h4>
                    <ul>
                        <li><a href="#" class="link-item">Utställning i konsthallen: Den konstiga konsten</a></li>
                        <li><a href="#" class="link-item">Tisdag-fredag serveras veckans lunchrätt</a></li>
                        <li><a href="#" class="link-item">Dolly Parton inställt, gratis biljetter till alla</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container gutter-xl gutter-vertical">
    <div class="grid">
        <div class="grid-lg-12">
            <h1 class="text-highlight">Aktuellt i Helsingborgs stad</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <img src="http://www.helsingborg.se/wp-content/uploads/2014/12/Kommunalanstalld_420x280.jpg" alt="Kommunalanställd">
                <div class="box-content">
                    <h5 class="link-item link-item-light">Ledia jobb i Helsingborgs stad</h5>
                </div>
            </a>
        </div>
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <img src="http://www.helsingborg.se/wp-content/uploads/2014/12/Kommunalanstalld_420x280.jpg" alt="Kommunalanställd">
                <div class="box-content">
                    <h5 class="link-item link-item-light">Ledia jobb i Helsingborgs stad</h5>
                </div>
            </a>
        </div>
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <img src="http://www.helsingborg.se/wp-content/uploads/2014/12/Kommunalanstalld_420x280.jpg" alt="Kommunalanställd">
                <div class="box-content">
                    <h5 class="link-item link-item-light">Ledia jobb i Helsingborgs stad</h5>
                </div>
            </a>
        </div>
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
