@extends ('backend.layouts.master')

@section ('title','Member Files')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
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
            <table class = "table" id="table">
                <caption>Member Files</caption>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Team</th>
                    <th>Assignment</th>
                    <th>Steam ID</th>
                    <th>Status</th>
                    <th>LOA</th>
                    <th>Reserve</th>
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
                        <td>{{$file->assignment->name or ''}}</td>
                        <td><a href="http://steamcommunity.com/profiles/{{$file->user->steam_id}}" target="_blank" rel="noopener">{{$file->user->steam_id}}</a></td>
                        <td>{!! $file->getActive() !!}</td>
                        <td>{!! $file->getLOAStatus() !!}</td>

                        <td>@if($member->reserve)
                                <span class="label label-info">Reserve</span>
                            @endif</td>
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
    {{ HTML::script('plugins/footable/js/footable.js') }}

    <script>
        jQuery(function($){
            $('.table').footable({
                "paging": {
                    "enabled": true
                },
                "filtering": {
                    "enabled": true
                },
                "sorting": {
                    "enabled": true
                }
            });
        });
    </script>
@stop