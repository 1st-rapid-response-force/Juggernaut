@extends ('backend.layouts.master')

@section ('title', 'Member Files')

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
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Member File</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.members.update',$file->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-10">
                    <legend>User</legend>
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-5">
                            {{ Form::text('user[first_name]', $file->user->first_name, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                        </div><!--col-lg-5-->
                        <div class="col-lg-5">
                            {{ Form::text('user[last_name]', $file->user->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                        </div><!--col-lg-5-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('steam_id', 'Steam ID', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('user[steam_id]', $file->user->steam_id, ['class' => 'form-control', 'placeholder' => 'Steam ID']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('timezone', 'Timezone', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::selectTimezone('user[timezone]', $file->user->timezone, ['class' => 'form-control']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('admin', 'Admin Access (Backend)', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::radio('user[admin]', '1', $file->user->admin) }} Yes <br>
                            {{ Form::radio('user[admin]', '0', !$file->user->admin) }} No
                        </div>
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('board_member', 'Board Member', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::radio('user[board_member]', '1', $file->user->board_member) }} Yes <br>
                            {{ Form::radio('user[board_member]', '0', !$file->user->board_member) }} No
                        </div>
                    </div><!--form control-->

                    <legend>RRF Member</legend>
                    <div class="form-group">
                        {{ Form::label('position', 'Position', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('member[position]', $file->position, ['class' => 'form-control', 'placeholder' => 'Steam ID']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('team_id', 'Team', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <select name="member[team_id]" class="form-control">
                                @foreach($teams as $team)
                                    <option value="{{$team->id}}" {{($team->id == $file->team_id) ? 'selected':''}}>{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('current_program_id', 'Current Program', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <select name="member[current_program_id]" class="form-control">
                                    <option value="0" {{($file->current_program_id == 0) ? 'selected':''}}>No Active Program</option>
                                @foreach(\App\Models\Unit\Program::all() as $program)
                                    <option value="{{$program->id}}" {{($program->id == $file->current_program_id) ? 'selected':''}}>{{$program->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('rank_id', 'Rank', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <select name="member[rank_id]" class="form-control">
                                @foreach($ranks as $rank)
                                    <option value="{{$rank->id}}" {{($rank->id == $file->rank_id) ? 'selected':''}}>{{$rank->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('active', 'Status', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <select name="member[active]" class="form-control">
                                <option value="1" {{(1 == $file->active) ? 'selected':''}}>Active</option>
                                <option value="0" {{(0 == $file->active) ? 'selected':''}}>Not Active</option>
                                <option value="2" {{(2 == $file->active) ? 'selected':''}}>Leave of Absence</option>
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                    <br>
                    <legend>File</legend>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Ribbons</h4>
                                    </div><!--panel-heading-->

                                    <div class="panel-body text-center">
                                        @if(count($file->ribbons) > 0)
                                            <div class="row">
                                                <?php $i = 3; ?>
                                                @foreach($file->ribbons as $ribbon)
                                                    <div class="col-lg-4">
                                                        <img style="width: 125px; height:35px;" src="{{$ribbon->getImage()}}"><br>
                                                        <small>{{$ribbon->name}}</small>
                                                    </div>
                                                    <?php if (($i != 0) && (($i % 1) == 1)) echo '</div><div class="row">'; ?>
                                                    <?php $i--; ?>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>This member does not have any ribbons</p>
                                        @endif
                                    </div><!--panel-body-->
                                </div><!--panel-->
                            </div><!--col-xs-12-->
                        </div><!--row-->
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Service History</h4>
                                    </div><!--panel-heading-->

                                    <div class="panel-body">
                                        @if($file->serviceHistory->count() > 0)
                                            <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                <thead>
                                                <th>Date</th>
                                                <th>Note</th>
                                                </thead>
                                                <tbody>
                                                @foreach($file->serviceHistory()->orderBy('date','desc')->get() as $serviceHistory)
                                                    <tr>
                                                        <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d',$serviceHistory->date)->toFormattedDateString()}}</td>
                                                        <td class="col-lg-10">{{$serviceHistory->text}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No Service History for this member.</p>
                                        @endif
                                    </div><!--panel-body-->
                                </div><!--panel-->
                            </div><!--col-xs-12-->
                        </div><!--row-->
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Awards</h4>
                                    </div><!--panel-heading-->

                                    <div class="panel-body">
                                        @if($file->awards->count() > 0)
                                            <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                <thead>
                                                <th>Date Awarded</th>
                                                <th>Award</th>
                                                <th>Note</th>
                                                </thead>
                                                <tbody>
                                                @foreach($file->awards()->get() as $awards)
                                                    <tr>
                                                        <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$awards->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                        <td class="col-lg-4">{{$awards->name}}</td>
                                                        <td class="col-lg-6">{{$awards->pivot->note}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No Awards for this member.</p>
                                        @endif
                                    </div><!--panel-body-->
                                </div><!--panel-->
                            </div><!--col-xs-12-->
                        </div><!--row-->
                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Qualifications</h4>
                                    </div><!--panel-heading-->

                                    <div class="panel-body">
                                        @if($file->serviceHistory->count() > 0)
                                            <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                <thead>
                                                <th>Date Awarded</th>
                                                <th>Qualification</th>
                                                <th>Note</th>
                                                </thead>
                                                <tbody>
                                                @foreach($file->qualifications()->get() as $qualifications)
                                                    <tr>
                                                        <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$qualifications->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                        <td class="col-lg-4">{{$qualifications->name}}</td>
                                                        <td class="col-lg-6">{{$qualifications->pivot->note}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No Service History for this member.</p>
                                        @endif
                                    </div><!--panel-body-->
                                </div><!--panel-->
                            </div><!--col-xs-12-->
                        </div><!--row-->

                        <br>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4>Training Programs</h4>
                                    </div><!--panel-heading-->

                                    <div class="panel-body">
                                        @if($file->serviceHistory->count() > 0)
                                            <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                <thead>
                                                <th>Date Awarded</th>
                                                <th>Qualification</th>
                                                <th>Note</th>
                                                </thead>
                                                <tbody>
                                                @foreach($file->qualifications()->get() as $qualifications)
                                                    <tr>
                                                        <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$qualifications->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                        <td class="col-lg-4">{{$qualifications->name}}</td>
                                                        <td class="col-lg-6">{{$qualifications->pivot->note}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No Training Programs for this member.</p>
                                        @endif
                                    </div><!--panel-body-->
                                </div><!--panel-->
                            </div><!--col-xs-12-->
                        </div><!--row-->

                    </div><!--col-md-12-->
                    <legend>Options</legend>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#addAward">Add Award</button>
                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#addQualification">Add Qualification</button>
                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#addProgram">Add Training Program</button>

                        </div>
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#addRibbon">Add Ribbon</button>
                            <button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#addServiceHistory">Add Service History</button>
                        </div>
                    </div>
                    <br>
                </div>

                <div class="col-lg-2">
                    <div class="pull-right">

                        @if($file->hasReportedIn())
                            <span class="label label-success">Reported in</span>
                        @else
                            <span class="label label-danger">Pending Report in</span>
                        @endif
                            <br><br>
                        <img src="{{$file->showCAC()}}" class="img img-thumbnail">

                    </div>

                </div>

                <div class="clearfix"></div>
            </div>

        </div>

        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <!-- /.box-body -->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.members.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')
    <!-- Add Award -->
    <div class="modal fade" id="addAward" tabindex="-1" role="dialog" aria-labelledby="addAwardModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addAwardModal">Add Award</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.members.edit.add-award',$file->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @if(\App\Models\Unit\Award::all()->count() >0)
                        <div class="form-group">
                            {{ Form::label('award_id', 'Award', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                <select name="award_id" class="form-control">
                                    @foreach(\App\Models\Unit\Award::all() as $award)
                                        <option value="{{$award->id}}">{{$award->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--col-lg-10-->

                        </div>
                            <div class="form-group">
                                {{ Form::label('note', 'Note', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('note', null, ['class' => 'form-control', 'placeholder' => 'What would you like to record in this members service history?']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('awarded_at', 'Date', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('awarded_at', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
                                    <small>Make sure to follow the format YYYY-MM-DD</small>
                                </div><!--col-lg-10-->
                            </div><!--form control-->
                        @else
                            <p>There are currently no awards</p>
                        @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Qualification -->
    <div class="modal fade" id="addQualification" tabindex="-1" role="dialog" aria-labelledby="addQualificationModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addQualificationModal">Add Qualification</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.members.edit.add-qualification',$file->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @if(\App\Models\Unit\Qualification::all()->count() >0)
                            <div class="form-group">
                                {{ Form::label('qualification_id', 'Qualification', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    <select name="qualification_id" class="form-control">
                                        @foreach(\App\Models\Unit\Qualification::all() as $qualification)
                                            <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-lg-10-->
                            </div>
                            <div class="form-group">
                                {{ Form::label('note', 'Note', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('note', null, ['class' => 'form-control', 'placeholder' => 'What would you like to record in this members service history?']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('awarded_at', 'Date', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('awarded_at', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
                                    <small>Make sure to follow the format YYYY-MM-DD</small>
                                </div><!--col-lg-10-->
                            </div><!--form control-->
                        @else
                            <p>There are currently no qualifications</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Ribbon -->
    <div class="modal fade" id="addRibbon" tabindex="-1" role="dialog" aria-labelledby="addRibbonModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addRibbonModal">Add Ribbon</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.members.edit.add-ribbon',$file->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        @if(\App\Models\Unit\Ribbon::all()->count() >0)
                            <div class="form-group">
                                {{ Form::label('ribbon_id', 'Ribbon', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    <select name="ribbon_id" class="form-control">
                                        @foreach(\App\Models\Unit\Ribbon::all() as $ribbon)
                                            <option value="{{$ribbon->id}}">{{$ribbon->name}}</option>
                                        @endforeach
                                    </select>
                                </div><!--col-lg-10-->

                            </div>

                            <div class="form-group">
                                {{ Form::label('note', 'Note', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('note', null, ['class' => 'form-control', 'placeholder' => 'What would you like to record in this members service history?']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('awarded_at', 'Date', ['class' => 'col-lg-2 control-label']) }}
                                <div class="col-lg-10">
                                    {{ Form::text('awarded_at', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
                                    <small>Make sure to follow the format YYYY-MM-DD</small>
                                </div><!--col-lg-10-->
                            </div><!--form control-->
                        @else
                            <p>There are currently no qualifications</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Ribbon -->
    <div class="modal fade" id="addServiceHistory" tabindex="-1" role="dialog" aria-labelledby="addServiceHistoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addServiceHistoryModal">Add Service History</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{route('admin.members.edit.add-service-history',$file->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            {{ Form::label('text', 'Text', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::text('text', null, ['class' => 'form-control', 'placeholder' => 'What would you like to record in this members service history?']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) }}
                            <div class="col-lg-10">
                                {{ Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
                                <small>Make sure to follow the format YYYY-MM-DD</small>
                            </div><!--col-lg-10-->
                        </div><!--form control-->
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