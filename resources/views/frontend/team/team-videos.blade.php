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

        <section class="padding-top-20 padding-bottom-20 border-bottom-1 border-grey-300">
            <div class="container">
                <div class="headline no-margin">
                    <h4>Latest Videos</h4>
                </div>
            </div>
        </section>

        <section class="bg-grey-50">
            <div class="container">
                <div class="card-group">
                    <div class="row">
                        @if($videos->count() > 0)
                        @foreach($videos as $video)
                            @include('frontend.team.include.video')
                        @endforeach
                        @else
                            <p>No videos have been uploaded</p>
                        @endif
                    </div>
                </div>

               {!! $videos->links() !!}
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection