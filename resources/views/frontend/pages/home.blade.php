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
                            <h1 data-animation="animated animate1 bounceInDown">Combined Operations</h1>
                            <p data-animation="animated animate7 fadeInUp">Infantry, Vehicle, Air, and Sea. The 1st RRF uses all elements to accomplish the missions.</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/2.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeInDown">Positions and Roles to fit your playstyle</h1>
                            <p data-animation="animated animate7 fadeIn">Enlisted, NCO, Officer</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/3.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">Striving for Realism</h1>
                            <p data-animation="animated animate7 fadeIn">We strive to play as realistically as possible</p>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <img src="img/arma/4.jpg" alt="">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1 data-animation="animated animate1 fadeIn">Best simulation</h1>
                            <p data-animation="animated animate7 fadeIn">Using custom built technology we provide an experience no other unit can.</p>
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