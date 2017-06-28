@extends('frontend.templates.master')

@section('title','Home')

@section('content')
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Videos</li>
                </ol>
            </div>
        </section>

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
                            @include('frontend.pages.include.video')
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