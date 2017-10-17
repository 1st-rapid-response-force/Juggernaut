@extends('frontend.templates.master')

@section('title','Apply to the 1st RRF')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-parallax height-450 parallax" style="background-image: url(img/pages/application.png);"></section>
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Apply</li>
                </ol>
            </div>
        </section>


        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Apply to the TF Everest</a></h2>
                                </div>
                            </div>

                            <h3>Overview</h3>
                            <p>Pending Content</p>
                            <h3>Membership Criteria</h3>
                            <br>
                            <h4>Apply to the TF Everest</h4>
                            <ol>
                                <li>Pending Requirements:</li>
                            </ol>
                            <hr>
                            <div class="row text-center">
                                <div class="col-lg-12">
                                    <a class="btn btn-primary" href="{{route('frontend.apply.application')}}">Application</a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


