@extends('frontend.templates.master')

@section('title','Apply to the 1st RRF')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-parallax height-450 parallax" style="background-image: url(img/pages/application.png);"></section>

        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Apply to the 1st Rapid Response Force</a></h2>
                                </div>
                            </div>

                            <h3>Overview</h3>
                            <p>The NATO RRF is a strict military simulation unit which operates within ARMA III using a wide variety of combined arms elements.</p>
                            <p>The group is mainly modelled on a US Force, bearing US Army ranks, however its structure is not directly drawn from any real world force. It is instead modelled around what allows us to deploy the best quality of functional simulation in both the meta and game space that the game and circumstance of being a sim unit instead of a real job allow.</p>
                            <h3>Membership Criteria</h3>
                            <br>
                            <h4>Apply to the 1st RRF</h4>
                            <ol>
                                <li>Check your eligibility:</li>
                                <ul>
                                    <li>Members must own a legal copy of ARMA 3.</li>
                                    <li>Members must have a clean Steam VAC and BattlEye Record</li>
                                    <li>Members must be over the age of 16+ for Enlisted, 18+ for Non-commissioned officer, and 20+ for an Officer position.</li>
                                    <li>Members will need to be able to commit to a weekly operations and training schedule.</li>
                                    <li>Members will need speak english in order to properly communicate with the unit.</li>
                                </ul>
                                <li>Review the <a href="/structure-assignments">Structure and Assignments</a> and the <a href="/policies/disciplinary">Disciplinary Policy</a> before completing your application.</li>
                                <li>Login/Create an account with us, if you are new, we will direct you to a registration page, if you are an existing member, we will log you in. - <small>For more information on Steam Open ID <a href="http://steamcommunity.com/dev">click here.</a></small>
                                </li>
                                <li>Fill out the Application and wait for a reply</li>
                                <li>Be active and participate in the community.</li>
                            </ol>
                            <hr>
                            <div class="row text-center">
                                <div class="col-lg-4">
                                    <a class="btn btn-primary" href="{{route('frontend.apply.application','enlisted')}}">Enlisted Application</a>
                                </div>
                                <div class="col-lg-4">
                                    <a class="btn btn-info" href="{{route('frontend.apply.application','nco')}}">NCO Application</a>
                                </div>
                                <div class="col-lg-4">
                                    <a class="btn btn-success" href="{{route('frontend.apply.application','officer')}}">Officer Application</a>
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


