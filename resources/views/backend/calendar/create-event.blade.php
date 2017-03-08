@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.calendar.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.calendar.management') }}
    </h1>
@endsection

@section('after-styles-end')
    {{ Html::style("plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}
    {{ Html::style("plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css") }}
@stop

@section('content')
    {{ Form::open(['route' => 'admin.calendar.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.calendar.add_event') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.calendar.includes.partials.calendar-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <!-- Form would go here -->
            <div class="form-group">
                {{ Form::label('title', trans('validation.attributes.backend.unit.calendar.events.title'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.title'),'required' => 'required']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('start_time', trans('validation.attributes.backend.unit.calendar.events.start_date'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('start_time', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.start_date'),'required' => 'required', 'id' =>'start_date']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('end_time', trans('validation.attributes.backend.unit.calendar.events.end_date'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('end_time', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.end_date'),'required' => 'required', 'id' =>'end_date']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('full_day', trans('validation.attributes.backend.unit.calendar.events.all_day'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-1">
                    {{ Form::hidden('full_day',0) }}
                    {{ Form::checkbox('full_day', '1', true) }}
                </div><!--col-lg-1-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('url', trans('validation.attributes.backend.unit.calendar.events.url'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.url')]) }}
                    <p class="help-block">This URL will be used as the link for this event on the public facing calendar.</p>
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('color', trans('validation.attributes.backend.unit.calendar.events.color'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('color', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.calendar.events.color'), 'id' =>'color']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->


        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.calendar.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts-end')
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/jquery-minicolors/jquery.minicolors.min.js") }}
    {{ Html::script("plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js") }}
    {{ Html::script("plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}
    <script type="text/javascript">
        $(function () {
            $('#start_date').datetimepicker();
            $('#end_date').datetimepicker();
            $('#color').colorpicker();
        });
    </script>
@stop