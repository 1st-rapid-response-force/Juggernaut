@extends('frontend.templates.master')

@section('title','Goliath')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Dashboard</a></h2>
                                </div>
                            </div>
                            @if(count(\Auth::User()->member))
                            <div class="row">
                                <div class="pull-right">
                                    <strong>{{\Auth::User()->member}}</strong><br/>
                                    <small>
                                        {{\Auth::User()->member->team->name}} <br/>
                                        Military ID: {{\Auth::User()->steam_id}} <br/>
                                        Time in Service: {{\Auth::User()->member->time_in_service}} days<br/>
                                        Roster Number: TFE-{{\Auth::User()->member->id}} <br/>
                                    </small>
                                </div>
                                <img class="media-object img-circle" src="{{\Auth::User()->member->avatar}}" alt="Profile picture">

                            </div>
                            <hr>
                            @endif

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.apply.application')}}"><h2>Apply</h2></a><br>
                                            @if(count(\Auth::User()->application))
                                                <p>Your Application Status: <br>{!! \Auth::User()->application->getStatus() !!}</p>
                                            @endif
                                            <i class="fa fa-folder-open-o fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                @if(count(\Auth::User()->member))
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.paperwork')}}"><h2>Paperwork</h2></a><br>
                                            <i class="fa fa-file fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.settings.teamspeak')}}"><h2>Teamspeak</h2></a><br>
                                            <i class="fa fa-microphone fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->




@endsection