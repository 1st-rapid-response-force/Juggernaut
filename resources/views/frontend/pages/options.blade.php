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

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.apply')}}"><h2>Apply</h2></a><br>
                                            <i class="fa fa-folder-open-o fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href=""><h2>Paperwork</h2></a><br>
                                            <i class="fa fa-file fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href=""><h2>Teamspeak</h2></a><br>
                                            <i class="fa fa-microphone fa-5x" aria-hidden="true"></i>
                                        </div>
                                    </div>
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