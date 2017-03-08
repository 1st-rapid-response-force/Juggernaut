@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.calendar.management'))

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('labels.backend.calendar.management') }}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.calendar.name') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.calendar.includes.partials.calendar-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            {!! $calendar->calendar() !!}
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/fullcalendar/fullcalendar.js") }}
    {!! $calendar->script() !!}
@stop