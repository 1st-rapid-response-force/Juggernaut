@extends ('backend.layouts.master')

@section ('title', 'Perstat')

@section('after-styles-end')
@stop

@section('page-header')
    <h1>
        Perstat
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Perstat</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>This allows you to view the PERSTAT Information.</p>
            <p><strong>{{$perstat->from}} to {{$perstat->to}}</strong></p>
            <h3>Current Report in Status:</h3>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{$perstat->report_percentage()}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$perstat->report_percentage()}}%;">
                    {{$perstat->report_percentage()}}%
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h4>Reported In</h4>
                    <ol>
                        @foreach($perstat->members as $vpf)
                            <li><a href="{{route('admin.members.show',$vpf->id)}}">{{$vpf}}</a></li>
                        @endforeach
                    </ol>
                </div>
                <div class="col-lg-6">
                    <h4>Pending Reported In</h4>
                    @foreach($perstat->pendingReportIn() as $vpf)
                        <li><a href="{{route('admin.members.show',$vpf->id)}}">{{$vpf}}</a></li>
                    @endforeach
                </div>
            </div>
            <hr>
            <a href="{{ route('admin.perstat.email',array($perstat->id)) }}" data-method="post" rel="nofollow" data-confirm="This will email all users who have not reported in are you sure?" class="btn btn-primary">Email Members who have not reported in</a>

        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
@stop