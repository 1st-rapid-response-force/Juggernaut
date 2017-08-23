@extends ('backend.layouts.master')

@section ('title', 'Operations')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Operations
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Operations</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the operations in the unit.</p>
            <h4>Administrative Options</h4>
            <p><a href="{{route('admin.operations.create')}}" class="btn btn-success">New Operation</a>
            </p>
            <hr>
            <br>
            @if (count($operations) != 0)
                @if (count($operations) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Attendance %</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($operations as $operation)
                            <tr>
                                <td class="col-lg-6">{{$operation->name}}</td>
                                <td class="col-lg-2">{{$operation->start_time->toDateTimeString()}}</td>
                                <td class="col-lg-2">NA</td>
                                <td class="col-lg-2">
                                   {!! $operation->getActionButtonsAttribute() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            @else
            <p>There is no Operations in the database, add one by using the Administrator tools.</p
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