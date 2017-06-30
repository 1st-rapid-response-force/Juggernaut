@extends ('backend.layouts.master')

@section ('title', 'Ribbons')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Ribbons
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Ribbons</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the ribbons that have been set up in the unit.</p>
            <h4>Administrative Options</h4>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newRibbon">New Ribbon</button>
            </p>
            <hr>
            <br>
            @if (count($ribbons) != 0)
                @if (count($ribbons) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ribbons as $ribbon)
                            <tr>
                                <td><img class="img-responsive" src="{{$ribbon->getImage()}}" class="center-block"></td>
                                <td>{{$ribbon->name}}</td>
                                <td>{{$ribbon->description}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('admin.ribbons.edit',array($ribbon->id)) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('admin.ribbons.destroy',array($ribbon->id)) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Ribbons in the database, add one by using the Administrator tools.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newRibbon" tabindex="-1" role="dialog" aria-labelledby="newRibbonModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newRibbonModal">New Ribbon</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Ribbon">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Descriptions: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Brief Description">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ribbon_image" class="col-sm-2 control-label">Image: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="ribbon_image" name="ribbon_image">
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