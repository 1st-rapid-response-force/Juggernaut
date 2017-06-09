@extends('frontend.templates.master')

@section('title','Our Structure')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Unit Feed</li>
                </ol>
            </div>
        </section>
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header text-center text-initial"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::now()->toFormattedDateString()}}</h4>
                        <ul class="timeline">
                            @foreach($events as $event)
                                @include('frontend.team.include.timeline-event')
                            @endforeach
                            <div class="clearfix pull-none"></div>
                            <div class="text-center">
                                {{$events->links()}}
                            </div>
                        </ul>

                    </div>
                </div>
            </div>

        </section>
    </div>
    <!-- /#wrapper -->
@endsection