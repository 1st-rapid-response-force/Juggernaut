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

        <section class="bg-grey-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header text-center text-initial"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::now()->toFormattedDateString()}}</h4>
                        <ul class="timeline">
                            @foreach($events as $event)
                                @include('frontend.team.include.timeline-event')
                            @endforeach
                            <div class="clearfix pull-none"></div>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection