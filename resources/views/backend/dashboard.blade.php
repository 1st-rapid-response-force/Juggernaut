@extends('backend.layouts.master')

@section('page-header')
    <h1>
        RRF
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('strings.backend.dashboard.welcome') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
        <p>Welcome to the 1st Rapid Response Force Admin panel.</p>
        </div><!-- /.box-body -->
    </div><!--box box-success-->

    <!-- Notifications Boxes -->
    <div class="row">
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Members</span>
                    <span class="info-box-number">{{$members}}</span>
                    <span class="info-box-content"><a class="btn btn-default btn-sm" href="{{route('admin.members.index')}}">More Info</a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-folder"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Active Applications</span>
                    <span class="info-box-number">{{$applications}}</span>
                    <span class="info-box-content"><a class="btn btn-default btn-sm" href="{{route('admin.applications.index')}}">More Info</a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
        <div class="col-lg-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Report in Status</span>
                    <span class="info-box-number">{!! $perstat->report_percentage() !!}%</span>
                    <span class="info-box-content"><a class="btn btn-default btn-sm" href="{{route('admin.perstat.index')}}">More Info</a></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div>
    </div>
@endsection