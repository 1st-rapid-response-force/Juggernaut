@extends ('backend.layouts.master')

@section ('title', 'Program')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Qualification Program
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Qualification Programs</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the program that have been set up in the unit.</p>
            <h4>Administrative Options</h4>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newProgram">New Program</button>
            </p>
            <hr>
            <br>
            @if (count($programs) != 0)
                @if (count($programs) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($programs as $program)
                            <tr>
                                <td class="col-lg-10">{{$program->name}}</td>
                                <td class="col-lg-2">
                                    <a class="btn btn-success" href="{{ route('admin.programs.edit',array($program->id)) }}">Edit</a>
                                    <a class="btn btn-info" href="{{ route('admin.programs.program-goals',array($program->id)) }}">Program Goals</a>
                                    <a class="btn btn-danger" href="{{ route('admin.programs.destroy',array($program->id)) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Programs in the database, add one by using the Administrator tools.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newProgram" tabindex="-1" role="dialog" aria-labelledby="newProgramModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newProgramModal">New Program</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Program - Basic Training">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Descriptions: &nbsp</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qualification_id" class="col-sm-2 control-label">Qualification: &nbsp</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="qualification_id">
                                    @foreach(\App\Models\Unit\Qualification::all() as $qualification)
                                        <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="responsible_team_id" value="1">
                        <input type="hidden" name="status" value="1">


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