@extends('frontend.templates.master')

@section('title','Home')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">{{$team->name}}</a></div>
                    <p>{{$team->motto}}</p>
                    <p><img src="{{$team->team_image}}" class="center-block"></p>
                    <br>
                </div>
            </div>
        </section>

        @include('frontend.team.include.nav')

        <section class="background-image padding-top-50 padding-bottom-50" style="background-color: #000000">
            <span class="background-overlay"></span>
            <div class="container">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$video->youtube_id}}?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                </div>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row sidebar">
                    <div class="col-md-12">
                        <div class="post post-single">
                            <div class="post-header post-author">
                                <a href="#" class="author" data-toggle="tooltip" title="YAKUZI"><img src="{{$video->creator->member->avatar}}" alt="" /></a>
                                <div class="post-title">
                                    <h2><a href="#">{{$video->name}}</a></h2>
                                    <ul class="post-meta">
                                        <li><a href="#"><i class="fa fa-user"></i> {{$video->creator->member}}</a></li>
                                        <li><i class="fa fa-clock-o"></i> {{$video->posted_at->toFormattedDateString()}}</li>
                                    </ul>
                                </div>
                            </div>

                            {!! $video->content !!}
                            <hr>
                            <a href="{{route('frontend.team.leader.edit-video',[$team->id,$video->id])}}" class="btn btn-small btn-primary">Edit Video</a>

                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

@endsection