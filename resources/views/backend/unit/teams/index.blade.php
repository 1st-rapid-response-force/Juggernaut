@extends ('backend.layouts.master')

@section ('title', 'Teams')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Teams
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Teams</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the teams that have been set up in the unit.</p>
            <h4>Administrative Options</h4>
            <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newQualification">New Team</button>
            </p>
            <hr>
            <br>
            @if (count($teams) != 0)
                @if (count($teams) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td class="col-lg-1">{{$team->id}}</td>
                                <td class="col-lg-9">{{$team->name}}</td>
                                <td class="col-lg-2">
                                    {!! $team->getActionButtonsAttribute() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Qualifications in the database, add one by using the Administrator tools.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newQualification" tabindex="-1" role="dialog" aria-labelledby="newQualificationModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newQualificationModal">New Team</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Team">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Leader: &nbsp</label>
                            <div class="col-sm-10">
                                <select name="leader_id" class="form-control">
                                @foreach(\App\Models\Unit\Member::all() as $member)
                                    <option value="{{$member->user->id}}">{{$member->searchable_name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Parent: &nbsp</label>
                            <div class="col-sm-10">
                                <select name="parent_id" class="form-control">
                                    @foreach(\App\Models\Unit\Team::all() as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
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