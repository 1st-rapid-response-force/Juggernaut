@extends('frontend.templates.master')

@section('title','Home')

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
                    <li class="active">Members</li>
                </ol>
            </div>
        </section>

        <section class="bg-grey-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header text-center text-initial">Team Members</h4>
                            @foreach($team->members as $member)
                                @include('frontend.team.include.member')
                            @endforeach
                            <div class="clearfix pull-none"></div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection