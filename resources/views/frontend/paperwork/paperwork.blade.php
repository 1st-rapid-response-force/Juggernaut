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
                                            <a href="{{route('frontend.paperwork.file-correction')}}"><h2>File Correction Form</h2></a><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.paperwork.bad-conduct')}}"><h2>Bad Conduct Form</h2></a><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body text-center" style="height:250px">
                                            <a href="{{route('frontend.paperwork.discharge')}}"><h2>Discharge Form</h2></a><br>
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