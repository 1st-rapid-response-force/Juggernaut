@extends('frontend.templates.master')

@section('title','Calendar')

@section('after-styles-end')
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('content')
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Calendar</li>
                </ol>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
            {{ Form::open(['route' => 'frontend.calendar.timezone', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
            <div class="form-group">
                {{ Form::label('timezone', 'Timezone', ['class' => 'col-md-3 control-label']) }}
                <div class="col-md-6">
                    {{ Form::selectTimezone('timezone', session('timezone','UTC'), ['class' => 'form-control']) }}
                </div>
                <div class="col-md-1">
                    {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            <div class="container">
                {!! $calendar->calendar() !!}
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/fullcalendar/fullcalendar.js") }}
    {!! $calendar->script() !!}
@stop
