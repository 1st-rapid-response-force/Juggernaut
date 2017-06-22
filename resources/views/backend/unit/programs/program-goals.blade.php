@extends ('backend.layouts.master')

@section ('title', 'Program Goals')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        {{$program->name}} - Program Goals
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Programs</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the program goals for {{$program->name}}.</p>
            <h4>Administrative Options</h4>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newProgram">New Program Goal</button>
            </p>
            <hr>
            <br>
            @if (count($program->goals) != 0)
                @if (count($program->goals) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Goal</th>
                            <th>Category</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($program->goals as $goal)
                            <tr>
                                <td class="col-lg-6">{{$goal->goal}}</td>
                                <td class="col-lg-4">{{$goal->category}}</td>
                                <td class="col-lg-2">
                                    <a class="btn btn-success" href="{{ route('admin.programs.program-goals.edit',[$program->id,$goal->id]) }}">Edit</a>
                                    <a class="btn btn-danger" href="{{ route('admin.programs.program-goals.delete',array($program->id, $goal->id)) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Programs goals for this program, add one by using the Administrator tools.</p>
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
                    <h4 class="modal-title" id="newProgramModal">New Program Goal</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{route('admin.programs.program-goals.post',$program->id)}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="goal" class="col-sm-2 control-label">Goal: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="goal" name="goal" placeholder="A sentence describing a program goal for a member to complete.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="goal" class="col-sm-2 control-label">Category: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="category" name="category" placeholder="General">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop