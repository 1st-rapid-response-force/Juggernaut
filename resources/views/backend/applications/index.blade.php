@extends ('backend.layouts.master')

@section ('title', 'Applications')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Applications
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Applications</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            @if(count($applications) > 0)
            <table class = "table">
                <caption>Applications</caption>

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Steam ID</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>

                <tbody>

                    @foreach($applications as $app)
                    <tr>
                        <td>{{$app->id}}</td>
                        <td>{{$app->user->name()}}</td>
                        <td><a href="http://steamcommunity.com/profiles/{{$app->user->steam_id}}" target="_blank" rel="noopener">{{$app->user->steam_id}}</a></td>
                        <td>{!! $app->getStatus() !!}</td>
                        <td>{!! $app->getActionButtonsAttribute() !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p>No applications</p>
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