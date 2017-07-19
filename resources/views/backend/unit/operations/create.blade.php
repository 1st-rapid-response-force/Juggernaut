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

            {!! Form::open(['route' => ['admin.operations.store'],'class' => 'form-horizontal', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
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
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('elements', 'Optional Elements', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <select name="optional_elements[]" multiple id="optional" class="form-control">
                                @foreach(\App\Models\Unit\Team::all() as $team)
                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach

                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('start_time', trans('validation.attributes.backend.unit.calendar.events.start_date'), ['class' => 'col-lg-1 control-label']) }}

                        <div class="col-lg-11">
                            {{ Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.start_date'),'required' => 'required', 'id' =>'start_date']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('end_time', trans('validation.attributes.backend.unit.calendar.events.end_date'), ['class' => 'col-lg-1 control-label']) }}

                        <div class="col-lg-11">
                            {{ Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.end_date'),'required' => 'required', 'id' =>'end_date']) }}
                            <p class="help-block">This time is your local time.</p>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('files', 'Files', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <input type="file" name="file[]" accept="media_type" multiple>
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <hr>
                    <div>

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Operation Brief</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Training Focus</a></li>
                            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Admin Notes</a></li>
                            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Credit</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                {{ Form::textarea('training', null, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="messages">
                                {{ Form::textarea('admin', null, ['class' => 'form-control', 'placeholder' => '']) }}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="settings">
                                {{ Form::textarea('credit', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
                {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}
    <script type="text/javascript">
        $(function () {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
        });
    </script>
@stop