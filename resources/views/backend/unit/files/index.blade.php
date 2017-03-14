@extends ('backend.layouts.master')

@section ('title','Member Files')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Member Files
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Member Files</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            @if(count($files) > 0)
            <table class = "table">
                <caption>Member Files</caption>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Team</th>
                    <th>Position</th>
                    <th>Steam ID</th>
                    <th>Status</th>
                    <th>Reported In</th>
                    <th>Options</th>
                </tr>
                </thead>

                <tbody>

                    @foreach($files as $file)
                    <tr>
                        <td>{{$file->id}}</td>
                        <td>{{$file}}</td>
                        <td>{{$file->team->name}}</td>
                        <td>{{$file->position}}</td>
                        <td><a href="http://steamcommunity.com/profiles/{{$file->user->steam_id}}" target="_blank" rel="noopener">{{$file->user->steam_id}}</a></td>
                        <td>{!! $file->getActive() !!}</td>
                        <td>@if($file->hasReportedIn())
                                <span class="label label-success">Reported in</span>
                            @else
                                <span class="label label-danger">Pending Report in</span>
                            @endif</td>
                        <td>{!! $file->getActionButtonsAttribute() !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No Member Files - Thats odd...</p>
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')

@stop