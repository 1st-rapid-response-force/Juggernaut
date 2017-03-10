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
            <h3 class="box-title">File Program Completion Form</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form method="post" action="{{route('admin.paperwork.program-completion.post')}}">
                {!! csrf_field() !!}
                <div class="text-center"><legend><strong>TRAINING COMPLETION FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                <div class="text-center"><h5>PRIVACY ACT STATEMENT</h5></div>
                <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to record the completion of a class within the 1st Rapid Response Force.</p>
                <p><strong>ROUTINE USE(S): </strong> This form is used by Catalyst to credit users who attend a class.</p>
                <p><strong>DISCLOSURE: </strong> Mandatory; All classes that are created must be completed or a cancellation form must be filed for investigation.</p>
                <hr>
                <div class="form-group">
                    <strong>Attendees: </strong>
                    <input type="text" id="autocomplete" name="attendees" /><br>
                    <strong>Observers: </strong> <small>This can be left blank</small>
                    <input type="text" id="autocomplete_observers" name="observers" /><br>
                    <strong>Class Co-Instructors or Helpers: </strong> <small>This can be left blank</small>
                    <input type="text" id="autocomplete_helpers" name="helpers" /><br>
                </div>

                <div class="form-group">
                    <label for="comments">Comments/Concerns</label>
                    <textarea class="form-control" name="comments" rows="15" placeholder="Do you have any general comments about this class session, or general concerns about this class in general"></textarea>
                </div>
                <div class="form-group">
                    <label for="rewards">Rewards/Recogniztion</label>
                    <textarea class="form-control" name="rewards" rows="15" placeholder="Do you wish to recognize a class participants?"></textarea>
                </div>
                <div class="form-group">
                    <label for="comments">Issues/Negative Conduct</label>
                    <textarea class="form-control" name="issues" rows="15" placeholder="Where there any issues with the class, or issues with a class participant (note it here)"></textarea>
                </div>

                <p><small>It is important to note that participants will not be credited with completing the school, they are being credited for attending the class session. This form is being sent to Command for review and admin will mark the school as complete once all courses, and sessions have been attended.</small> </p>


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
                {{ Form::submit('Mark as Reviewed', ['class' => 'btn btn-success btn-xs']) }}
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