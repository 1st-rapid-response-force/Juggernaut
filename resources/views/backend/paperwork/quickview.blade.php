@extends ('backend.layouts.master')

@section ('title', 'Unit Paperwork')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Paperwork - <small>Archive</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Paperwork Quick View</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>This method will be replaced in the future but for now:</p>
            <h2>{!! $paperwork->getType() !!}</h2>
            <pre>{!! $jsonDump !!}</pre>
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    {{ HTML::script('plugins/footable/js/footable.js') }}

    <script>
        jQuery(function($){
            $('.table').footable({
                "paging": {
                    "enabled": true,
                    "size": 100
                    
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