@extends('frontend.templates.master')

@section('title','Home')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <div id="full-carousel" class="ken-burns carousel slide full-carousel carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#full-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#full-carousel" data-slide-to="1"></li>
                <li data-target="#full-carousel" data-slide-to="2"></li>
                <li data-target="#full-carousel" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active inactiveUntilOnLoad">
                    <img src="img/arma/1.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 bounceInDown">Combined Arms Military Simulation</h1>
                            <p data-animation="animated animate7 fadeInUp">The 1st RRF provides a well trained combined arms task force inside of ARMA III</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/2.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeInDown">Regular and Consistent Operations</h1>
                            <p data-animation="animated animate7 fadeIn">The 1st RRF has official operations every Saturday at 2200 UTC and many more throughout the week</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/3.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">High Quality Training</h1>
                            <p data-animation="animated animate7 fadeIn">The 1st RRF uses a well written and flexible training program to teach authentic tactics and skills</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/4.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">Stable and Experienced Leadership</h1>
                            <p data-animation="animated animate7 fadeIn">The 1st RRF has been run by the same command team for over four years and provides structured leadership development for new players</p>
                        </div>
                    </div>
                </div>

                <a class="left carousel-control" href="#full-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                </a>
                <a class="right carousel-control" href="#full-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
@endsection

@section('after-scripts-emd')
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script>
        (function($) {
            "use strict";
            var owl = $(".owl-carousel");

            owl.owlCarousel({
                items : 4, //4 items above 1000px browser width
                itemsDesktop : [1000,3], //3 items between 1000px and 0
                itemsTablet: [600,1], //1 items between 600 and 0
                itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
            });

            $(".next").click(function(){
                owl.trigger('owl.next');
                return false;
            })
            $(".prev").click(function(){
                owl.trigger('owl.prev');
                return false;
            })
        })(jQuery);
    </script>
@endsection