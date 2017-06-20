@extends('frontend.templates.master_banned')

@section('title','Login')

@section('after-styles-end')

@stop

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-panel" style="background-image: url(/img/arma/2.jpg);">
            <div class="hero-bg"></div>
            <div class="container relative">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pull-none margin-auto">
                        <div class="panel panel-default panel-login">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user"></i> Banned</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                   <p style="color: #2a2a2a">You have been banned from the 1st Rapid Response Force.</p>
                                </div>
                            </div>
                            <div class="panel-footer">
                                1st Rapid Response Force
                            </div>
                        </div>
                        <div class="hidden-xs" style="padding-bottom: 500px"></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->


@endsection

@section('after-scripts-end')

@stop
