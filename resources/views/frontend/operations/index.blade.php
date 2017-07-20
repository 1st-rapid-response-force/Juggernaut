@extends('frontend.templates.master')

@section('title','Operations')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{\App\Models\Unit\Operation::randomHeader()}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">Unit Operations</a></div>
                    <p></p>
                    <br>
                </div>
            </div>
        </section>

        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Unit Operations</li>
                </ol>
            </div>
        </section>

        <section class="bg-grey-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="page-header text-center text-initial"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::now()->toFormattedDateString()}}</h4>
                        <ul class="timeline">
                            @foreach(\App\Models\Unit\Operation::wherePublished(1)->orderBy('created_at','desc')->get() as $operation)
                                @include('frontend.operations.include.operation-timeline')
                            @endforeach

                                <li>
                                    <div class="timeline-badge primary"></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4><a href="#"><i class="star"></i> 1st Rapid Response Force - Founded</a></h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>The 1st Rapid Response Force was launched on March 15th, 2017</p>

                                        </div>
                                        <div class="timeline-footer">
                                            <i class="fa fa-calendar-o"></i> March 15, 2017
                                        </div>
                                    </div>
                                </li>
                            <div class="clearfix pull-none"></div>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection