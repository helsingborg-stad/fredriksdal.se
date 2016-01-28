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
            <h1 class="text-highlight">Detta händer på Dunkers idag</h1>
        </div>
    </div>

    <div class="grid">
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <div class="box-image" style="background-image:url('http://gigguide.se/static/images/performers/661/markus-krunegard-1-original.jpeg');">
                    <img src="http://gigguide.se/static/images/performers/661/markus-krunegard-1-original.jpeg" alt="Kommunalanställd">
                </div>
                <div class="box-content">
                    <h5 class="link-item link-item-light">Markus Krunegård</h5>
                    <p>
                        Akustisk turné<br>
                        18 mars 2016 kl. 19:00
                    </p>
                </div>
            </a>
        </div>
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <div class="box-image" style="background-image:url('http://mittkulturkort.se/data/kulturkortet/media/news/image/92/13/46/7/5164/e64c22a79bb566db/thumbs/kk_691_518_DEFAULT_cropfit_NORTH.jpg');">
                    <img src="http://mittkulturkort.se/data/kulturkortet/media/news/image/92/13/46/7/5164/e64c22a79bb566db/thumbs/kk_691_518_DEFAULT_cropfit_NORTH.jpg" alt="Kommunalanställd">
                </div>
                <div class="box-content">
                    <h5 class="link-item link-item-light">Arty after work</h5>
                    <p>
                        Häng ut efter jobb<br>
                        Fredagar kl. 16:00
                    </p>
                </div>
            </a>
        </div>
        <div class="grid-md-4 grid-sm-6">
            <a href="#" class="box box-news">
                <div class="box-image" style="background-image:url('http://vansterparlan.v-blog.se/files/2014/07/Athena.jpg');">
                    <img src="http://vansterparlan.v-blog.se/files/2014/07/Athena.jpg" alt="Kommunalanställd">
                </div>
                <div class="box-content">
                    <h5 class="link-item link-item-light">Samtal på Dunkers</h5>
                    <p>
                        Athena Farrokhzad<br>
                        16 mars 2016 14:00
                    </p>
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
