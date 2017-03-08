@extends('backend.layouts.master')

@section('page-header')
    <h1>
        SDG
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
@endsection