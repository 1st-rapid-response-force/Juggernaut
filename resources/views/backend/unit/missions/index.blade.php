@extends ('backend.layouts.master')

@section ('title', 'Missions Files')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Mission Files
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Mission Files</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>These files are PBO files that are automatically uploaded to the server.</p>
            <h4>Administrative Options</h4>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newMission">New Mission</button>
            </p>
            <hr>
            <br>
            @if (count($missions) != 0)
                @if (count($missions) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Uploaded By</th>
                            <th>Created On</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($missions as $mission)
                            <tr>
                                <td>{{$mission->name}}</td>
                                <td>{{$mission->user->member}}</td>
                                <td>{{$mission->created_at}}</td>
                                <td>{!! $mission->getActionButtonsAttribute() !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Missions in the database, add one by using the Administrator tools.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newMission" tabindex="-1" role="dialog" aria-labelledby="newRibbonModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newMissionModal">New Mission</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Mission File">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ribbon_image" class="col-sm-2 control-label">Mission PBO: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="mission" name="mission">
                            </div>
                        </div>
                        {{csrf_field()}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
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