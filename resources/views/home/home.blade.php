@extends('layouts.principal')

@section('title')
Home
@stop

@section('content')
<div role="main" class="main">
    <div class="slider-container rev_slider_wrapper">
        <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"gridwidth": 1170, "gridheight": 500}'>
            <ul>
                <li data-transition="fade">
                    {!! Html::image('media/slider_news/bg.jpg', 
                    '', ['class' => 'rev-slidebg', 'data-bgposition' => 'center center',
                    'data-bgfit' => 'center center', 'data-bgrepeat' => 'no-repeat']) !!}
<!--                    <img src="img/slides/slide-bg.jpg"  
                         alt=""
                         data-bgposition="center center" 
                         data-bgfit="cover" 
                         data-bgrepeat="no-repeat" 
                         class="rev-slidebg">-->

                    <!--                    <div class="tp-caption"
                                             data-x="177"
                                             data-y="180"
                                             data-start="1000"
                                             data-transform_in="x:[-300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>-->

                    <div class="tp-caption top-label"
                         data-x="227"
                         data-y="180"
                         data-start="500"
                         data-transform_in="y:[-300%];opacity:0;s:500;">Bienvenido</div>

                    <!--                    <div class="tp-caption"
                                             data-x="480"
                                             data-y="180"
                                             data-start="1000"
                                             data-transform_in="x:[300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>-->

                    <div class="tp-caption main-label"
                         data-x="135"
                         data-y="210"
                         data-start="1500"
                         data-whitespace="nowrap"						 
                         data-transform_in="y:[100%];s:500;"
                         data-transform_out="opacity:0;s:500;"
                         data-mask_in="x:0px;y:0px;">Play Social Pass</div>

                    <div class="tp-caption bottom-label"
                         data-x="185"
                         data-y="280"
                         data-start="2000"
                         data-transform_in="y:[100%];opacity:0;s:500;">Somos el primer portal multi-deportes</div>


                    <!--                    <div class="tp-caption"
                                             data-x="910"
                                             data-y="248"
                                             data-start="2500"
                                             data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1300;"><img src="img/slides/slide-concept-2-1.png" alt=""></div>-->

                    <!--                    <div class="tp-caption"
                                             data-x="960"
                                             data-y="200"
                                             data-start="3500"
                                             data-transform_in="y:[300%];opacity:0;s:300;"><img src="img/slides/slide-concept-2-2.png" alt=""></div>-->

                    <!--                    <div class="tp-caption"
                                             data-x="930"
                                             data-y="170"
                                             data-start="3650"
                                             data-transform_in="y:[300%];opacity:0;s:300;"><img src="img/slides/slide-concept-2-3.png" alt=""></div>-->

                    <!--                    <div class="tp-caption"
                                             data-x="880"
                                             data-y="130"
                                             data-start="3750"
                                             data-transform_in="y:[300%];opacity:0;s:300;"><img src="img/slides/slide-concept-2-4.png" alt=""></div>-->

                    <!--                    <div class="tp-caption"
                                             data-x="610"
                                             data-y="80"
                                             data-start="3950"
                                             data-transform_in="y:[300%];opacity:0;s:300;"><img src="img/slides/slide-concept-2-5.png" alt=""></div>-->

                    <div class="tp-caption blackboard-text"
                         data-x="640"
                         data-y="300"
                         data-start="3950"
                         style="font-size: 37px;"
                         data-transform_in="y:[300%];opacity:0;s:300;">donde encontrarás información de competencias de todo el país</div>

                    <div class="tp-caption blackboard-text"
                         data-x="665"
                         data-y="350"
                         data-start="4150"
                         style="font-size: 47px;"
                         data-transform_in="y:[300%];opacity:0;s:300;">e inscribirte de la forma más fácil</div>

                    <!--                    <div class="tp-caption blackboard-text"
                                             data-x="690"
                                             data-y="400"
                                             data-start="4350"
                                             style="font-size: 32px;"
                                             data-transform_in="y:[300%];opacity:0;s:300;">The box :)</div>-->
                </li>
                <!--                <li data-transition="fade">
                                    <img src="img/slides/slide-bg.jpg"  
                                         alt=""
                                         data-bgposition="center center" 
                                         data-bgfit="cover" 
                                         data-bgrepeat="no-repeat" 
                                         class="rev-slidebg" data-no-retina>
                
                                    <div class="tp-caption top-label"
                                         data-x="155"
                                         data-y="100"
                                         data-start="500"
                                         data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power2.easeOut;"><img src="img/slides/slide-concept.png" alt=""></div>
                
                                    <div class="tp-caption blackboard-text"
                                         data-x="285"
                                         data-y="180"
                                         data-start="1000"
                                         style="font-size: 30px;"
                                         data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power2.easeOut;">easy to</div>
                
                                    <div class="tp-caption blackboard-text"
                                         data-x="285"
                                         data-y="220"
                                         data-start="1200"
                                         style="font-size: 40px;"
                                         data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1000;e:Power2.easeOut;">customize!</div>
                
                                    <div class="tp-caption main-label"
                                         data-x="685"
                                         data-y="190"
                                         data-start="1800"
                                         data-whitespace="nowrap"						 
                                         data-transform_in="y:[100%];s:500;"
                                         data-transform_out="opacity:0;s:500;"
                                         data-mask_in="x:0px;y:0px;">DESIGN IT!</div>
                
                                    <div class="tp-caption bottom-label"
                                         data-x="685"
                                         data-y="250"
                                         data-start="2000"
                                         data-transform_idle="o:1;"
                                         data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:600;e:Power4.easeInOut;"
                                         data-transform_out="opacity:0;s:500;"
                                         data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                                         data-splitin="chars" 
                                         data-splitout="none" 
                                         data-responsive_offset="on" 
                                         data-elementdelay="0.05">Create slides with brushes and fonts</div>
                
                                </li> -->
            </ul>
        </div>
    </div>
    <div class="home-intro" id="home-intro">
        <div class="container">

            <div class="row">
                <div class="col-md-2">
                    <span><i class="fa fa-calendar"></i>Calendario</a</span>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::select('disciplina', [0 => "Seleccione Disciplina", 1 => "Ciclismo", 2 => "Atletismo"],
                        0, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::selectMonth('mes', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::selectYear('year', 2010, 2016, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {!! Form::text('name', '', 
                        ['class' => 'form-control',
                        'autocomplete' => 'off', 'required' => true,
                        'placeholder' => 'Competencia']) !!}
                    </div>
                </div>
                <div class="col-md-1">
                    {!! Form::submit('Go',
                    ['class' => 'btn btn-primary pull-right mb-xl',
                    'data-loading-text' => 'Cargando...']) !!}
                </div>
            </div>
        </div>
    </div>

    <!--    <div class="container">
    
            <div class="row center">
                <div class="col-md-12">
                    <h1 class="mb-sm word-rotator-title">
                        Porto is
                        <strong class="inverted">
                            <span class="word-rotate" data-plugin-options='{"delay": 2000, "animDelay": 300}'>
                                <span class="word-rotate-items">
                                    <span>incredibly</span>
                                    <span>especially</span>
                                    <span>extremely</span>
                                </span>
                            </span>
                        </strong>
                        beautiful and fully responsive.
                    </h1>
                    <p class="lead">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.
                    </p>
                </div>
            </div>
    
        </div>-->

    <!--    <div class="home-concept">
            <div class="container">
    
                <div class="row center">
                    <span class="sun"></span>
                    <span class="cloud"></span>
                    <div class="col-md-2 col-md-offset-1">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn">
                            <img src="img/home-concept-item-1.png" alt="" />
                            <strong>Strategy</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="200">
                            <img src="img/home-concept-item-2.png" alt="" />
                            <strong>Planning</strong>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="process-image appear-animation" data-appear-animation="bounceIn" data-appear-animation-delay="400">
                            <img src="img/home-concept-item-3.png" alt="" />
                            <strong>Build</strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="project-image">
                            <div id="fcSlideshow" class="fc-slideshow">
                                <ul class="fc-slides">
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-1.jpg" alt="" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-2.jpg" alt="" /></a></li>
                                    <li><a href="portfolio-single-project.html"><img class="img-responsive" src="img/projects/project-home-3.jpg" alt="" /></a></li>
                                </ul>
                            </div>
                            <strong class="our-work">Our Work</strong>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>-->

    <!--    <div class="container">
    
            <div class="row">
                <hr class="tall">
            </div>
    
        </div>-->

    <!--    <div class="container">
    
            <div class="row">
                <div class="col-md-8">
                    <h2>Our <strong>Features</strong></h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-group"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Customer Support</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-file"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">HTML5 / CSS3 / JS</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, adip.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-google-plus"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">500+ Google Fonts</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-adjust"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Colors</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-film"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Sliders</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, consectetur.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Icons</h4>
                                    <p class="tall">Lorem ipsum dolor sit amet, consectetur adip.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-bars"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Buttons</h4>
                                    <p class="tall">Lorem ipsum dolor sit, consectetur adip.</p>
                                </div>
                            </div>
                            <div class="feature-box">
                                <div class="feature-box-icon">
                                    <i class="fa fa-desktop"></i>
                                </div>
                                <div class="feature-box-info">
                                    <h4 class="heading-primary mb-none">Lightbox</h4>
                                    <p class="tall">Lorem sit amet, consectetur adip.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2>and more...</h2>
    
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="fa fa-usd"></i>
                                        Pricing Tables
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="accordion-body collapse in">
                                <div class="panel-body">
                                    Donec tellus massa, tristique sit amet condim vel, facilisis quis sapien. Praesent id enim sit amet odio vulputate eleifend in in tortor.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="fa fa-comment"></i>
                                        Contact Forms
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="accordion-body collapse">
                                <div class="panel-body">
                                    Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="fa fa-laptop"></i>
                                        Portfolio Pages
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="accordion-body collapse">
                                <div class="panel-body">
                                    Donec tellus massa, tristique sit amet condimentum vel, facilisis quis sapien.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <hr class="tall">
    
            <div class="row center">
                <div class="col-md-12">
                    <h2 class="mb-sm word-rotator-title">
                        We're not the only ones
                        <strong>
                            <span class="word-rotate" data-plugin-options='{"delay": 3500, "animDelay": 400}'>
                                <span class="word-rotate-items">
                                    <span>excited</span>
                                    <span>happy</span>
                                </span>
                            </span>
                        </strong>
                        about Porto Template...
                    </h2>
                    <h4 class="heading-primary lead tall">19,000 customers in 100 countries use Porto Template. Meet our customers.</h4>
                </div>
            </div>
    
            <div class="row center">
                <div class="owl-carousel owl-theme" data-plugin-options='{"items": 6, "autoplay": true, "autoplayTimeout": 3000}'>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-1.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-2.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-3.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-5.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-6.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-responsive" src="img/logos/logo-2.png" alt="">
                    </div>
                </div>
            </div>
    
        </div>-->

<!--    <section class="section section-custom-map">
        <section class="section section-default section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="recent-posts mb-xl">
                            <h2>Latest <strong>Blog</strong> Posts</h2>
                            <div class="row">
                                <div class="owl-carousel owl-theme mb-none" data-plugin-options='{"items": 1}'>
                                    <div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">15</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">15</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">12</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">11</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">15</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat libero. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                        <div class="col-md-6">
                                            <article>
                                                <div class="date">
                                                    <span class="day">15</span>
                                                    <span class="month">Jan</span>
                                                </div>
                                                <h4 class="heading-primary"><a href="blog-post.html">Lorem ipsum dolor</a></h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. <a href="/" class="read-more">read more <i class="fa fa-angle-right"></i></a></p>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2><strong>What</strong> Client’s Say</h2>
                        <div class="row">
                            <div class="owl-carousel owl-theme mb-none" data-plugin-options='{"items": 1}'>
                                <div>
                                    <div class="col-md-12">
                                        <div class="testimonial testimonial-primary">
                                            <blockquote>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.</p>
                                            </blockquote>
                                            <div class="testimonial-arrow-down"></div>
                                            <div class="testimonial-author">
                                                <div class="testimonial-author-thumbnail img-thumbnail">
                                                    <img src="img/clients/client-1.jpg" alt="">
                                                </div>
                                                <p><strong>John Smith</strong><span>CEO & Founder - Okler</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="col-md-12">
                                        <div class="testimonial testimonial-primary">
                                            <blockquote>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.</p>
                                            </blockquote>
                                            <div class="testimonial-arrow-down"></div>
                                            <div class="testimonial-author">
                                                <div class="testimonial-author-thumbnail img-thumbnail">
                                                    <img src="img/clients/client-1.jpg" alt="">
                                                </div>
                                                <p><strong>John Smith</strong><span>CEO & Founder - Okler</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>-->
</div>
@endsection

@include('layouts.message')
