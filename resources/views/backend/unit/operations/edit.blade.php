@extends ('backend.layouts.master')

@section ('title', 'Operations')

@section('after-styles-end')
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
    {{ Html::style("plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}
    <script src="/plugins/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            browser_spellcheck: true,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true
        });</script>
@stop

@section('page-header')
    <h1>
        Operations
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Operation</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.operations.update',$operation->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            {{ Form::text('name', $operation->name, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="pull-right">
                        <small>Hold CTRL to select multiple elements.</small>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        {{ Form::label('elements', 'Required Elements', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <select name="required_elements[]" multiple id="required" class="form-control">
                                @foreach(\App\Models\Unit\Team::all() as $team)
                                    <option value="{{$team->id}}" {{$operation->requiredElement($team->id) ? "selected" : ""}}>{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('elements', 'Optional Elements', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <select name="optional_elements[]" multiple id="optional" class="form-control">
                                @foreach(\App\Models\Unit\Team::all() as $team)
                                    <option value="{{$team->id}}" {{$operation->optionalElement($team->id) ? "selected" : ""}}>{{$team->name}}</option>
                                @endforeach

                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('start_time', trans('validation.attributes.backend.unit.calendar.events.start_date'), ['class' => 'col-lg-1 control-label']) }}

                        <div class="col-lg-11">
                            {{ Form::text('start_time', $operation->start_time->setTimezone(\Auth::User()->timezone)->format('m/d/Y h:i A'), ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.start_date'),'required' => 'required', 'id' =>'start_date']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('end_time', trans('validation.attributes.backend.unit.calendar.events.end_date'), ['class' => 'col-lg-1 control-label']) }}

                        <div class="col-lg-11">
                            {{ Form::text('end_time', $operation->end_time->setTimezone(\Auth::User()->timezone)->format('m/d/Y h:i A'), ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.end_date'),'required' => 'required', 'id' =>'end_date']) }}
                            <p class="help-block">This time is your local time.</p>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('files', 'Files', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <input type="file" name="file[]" accept="media_type" multiple>
                            <ul>
                            @foreach($operation->getMedia('attachments') as $attachment)
                                <li style="padding-top:5px"><a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a> {!! $operation->getDeleteAttachment($operation->id,$attachment->id) !!}</li>
                            @endforeach
                            </ul>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('mission', 'Mission PBO', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <input type="file" name="mission" accept="media_type">
                            <ul>
                                @foreach($operation->getMedia('mission') as $attachment)
                                    <li style="padding-top:5px"><a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a> {!! $operation->getDeleteAttachment($operation->id,$attachment->id) !!}</li>
                                @endforeach
                            </ul>
                            <small>You can upload the final mission PBO here, reuploading it will overwrite the previous file.</small>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <hr>
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#accountability" aria-controls="settings" role="tab" data-toggle="tab">Attendance/Accountability</a></li>
                            <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Operation Brief</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Training Focus</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Admin Notes</a></li>
                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Credit</a></li>
                            <li role="presentation"><a href="#fragos" aria-controls="settings" role="tab" data-toggle="tab">FRAGOs</a></li>

                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="home">
                                {{ Form::textarea('description', $operation->description, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                {{ Form::textarea('training', $operation->training, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">
                                {{ Form::textarea('admin', $operation->admin, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="settings">
                                {{ Form::textarea('credit', $operation->credit, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="fragos">
                                <br>
                                <p><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newFRAGO">New FRAGO</button>
                                <br>

                                @if (count($operation->fragos) != 0)
                                    @if (count($operation->fragos) != 0)
                                        <table id="table" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Author</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($operation->fragos as $frago)
                                                <tr>
                                                    <td class="col-lg-4">FRAGO #{{$loop->iteration}}</td>
                                                    <td class="col-lg-2">{{$frago->created_at->toDayDateTimeString()}}</td>
                                                    <td class="col-lg-4">
                                                        {{$frago->member->searchable_name}}
                                                    </td>
                                                    <td class="col-lg-4">
                                                        {!! $frago->getActionButtonsAttribute() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                @else
                                    <p>There is no FRAGOS for this operation, add one by using the Administrator tools.</p>
                                @endif
                            </div>

                            <div role="tabpanel" class="tab-pane active" id="accountability">
                                <h3>Required Elements</h3>
                                @foreach($operation->getAccountability()['required'] as $group)
                                    <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                    @foreach($group->assignments()->orderBy('order')->get() as $assignment)
                                        @if($assignment->members->count() >0)
                                            @foreach($assignment->members as $member)
                                                <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$assignment->name}} - {{$member->searchable_name}}</a> - {!! $operation->getOperationalStatus($member->id) !!}</br>
                                            @endforeach
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                                <h3>Optional Elements</h3>
                                @foreach($operation->getAccountability()['optional'] as $group)
                                    <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                    @foreach($group->assignments()->orderBy('order')->get() as $assignment)
                                        @if($assignment->members->count() >0)
                                            @foreach($assignment->members as $member)
                                                <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$assignment->name}} - {{$member->searchable_name}}</a> - {!! $operation->getOperationalStatus($member->id) !!}</br>
                                            @endforeach
                                        @else
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>



                    </div>
                </div><!--form control-->
            </div>


                <div class="clearfix"></div>
            </div>

        </div>
    <!-- /.box -->
    <!-- /.box-body -->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.operations.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit('Save', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newFRAGO" tabindex="-1" role="dialog" aria-labelledby="newProgramModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newProgramModal">New FRAGO</h4>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal" action="{{route('admin.operations.frago.store',$operation->id)}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}
    <script type="text/javascript">
        $(function () {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
        });
    </script>
@stop