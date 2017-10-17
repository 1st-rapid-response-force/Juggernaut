@extends('frontend.templates.master')

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
                    <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12 pull-none margin-auto">
                        <div class="panel panel-default panel-login">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-user"></i> Sign in / Register - TF Everest Personnel System</h3>
                            </div>
                            <div class="panel-body">
                                <div class="text-center">
                                    <a href="{{\SteamLogin::url(url('auth/validate'))}}">
                                        <img src="/img/steam_login.png">
                                    </a>
                                </div>
                            </div>
                            <div class="panel-footer">
                                Task Force Everest uses <a href="https://steamcommunity.com/dev">Steam Open Authentication</a>
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
