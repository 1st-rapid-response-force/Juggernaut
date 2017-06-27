@extends('frontend.templates.master')

@section('title','Assignment')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image or $team->randomHeader()}});">
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
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.team',$team->id)}}">{{$team->name}}</a></li>
                    <li><a href="{{route('frontend.team.leader',$team->id)}}">Leader Panel</a></li>
                    <li class="active"><a href="{{route('frontend.team.leader.assignments',$team->id)}}">Assignment Management</a></li>
                </ol>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Team Positions - Assignments</h2>
                                </div>
                            </div>
                            <div id="vue">
                                <assignments team_id="{{$team->id}}"></assignments>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
@endsection