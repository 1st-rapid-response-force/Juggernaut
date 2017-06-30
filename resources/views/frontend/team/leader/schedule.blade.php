@extends('frontend.templates.master')

@section('title','Home')


@section('after-styles-end')
    {{ Html::style("plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}
@stop

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image or $team->randomHeader()}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">{{$team->name}}</a></div>
                    <p>{{$team->motto}}</p>
                    <p><img src="{{$team->team_image}}" class="center-block"></p>
                    <br>
                </div>
            </div>
        </section>

        @include('frontend.team.include.nav')
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.team',$team->id)}}">{{$team->name}}</a></li>
                    <li><a href="{{route('frontend.team.leader',$team->id)}}">Leader Panel</a></li>
                    <li class="active"><a href="{{route('frontend.team.leader.schedule',$team->id)}}">Training Schedule</a></li>
                </ol>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Training Schedule</h2>
                                </div>
                            </div>
                            <p>You can setup your teams weekly training here, once initialized your training will appear on the calendar every week.</p>
                            {{ Form::open(['route' => ['frontend.team.leader.schedule.post',$team->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                            @if(!isset($team->schedule))
                            <div class="form-group">
                                {{ Form::label('day', ' Day', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::select('day', ['0'=> "Sunday",'1'=>'Monday','2'=>'Tuesday','3'=> 'Wednesday', '4'=>'Thursday','5'=>'Friday','6'=> 'Saturday'], null, ['class' => 'form-control', 'placeholder' => 'Day of the Week','required' => 'required']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->
                            <p>Times below should be scheduled in your timezone, once in the system it will auto convert to everyone's specific timezone in the Calendar.</p>
                            <hr>

                                <div class="form-group">
                                    {{ Form::label('time', ' Hour', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-5">
                                        {{ Form::select('hour', [
                                        '0'=> "00",
                                        '1'=>'01',
                                        '2'=>'02',
                                        '3'=> '03',
                                        '4'=>'04',
                                        '5'=>'05',
                                        '6'=> '06',
                                        '7'=>'07',
                                        '8'=>'08',
                                        '9'=>'09',
                                        '10'=>'10',
                                        '11'=>'11',
                                        '12'=>'12',
                                        '13'=>'13',
                                        '14'=>'14',
                                        '15'=>'15',
                                        '16'=>'16',
                                        '17'=>'17',
                                        '18'=>'18',
                                        '19'=>'19',
                                        '20'=>'20',
                                        '21'=>'21',
                                        '22'=>'22',
                                        '23'=>'23',
                                        ], null, ['class' => 'form-control', 'placeholder' => 'Hour','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                    <div class="col-lg-5">
                                        {{ Form::select('minute', [
                                        '0'=> "00",
                                        '15'=>'15',
                                        '30'=>'30',
                                        '45'=> '45',
                                        ], null, ['class' => 'form-control', 'placeholder' => 'Day','required' => 'required']) }}
                                    </div><!--col-lg-5-->

                                </div><!--form control-->
                            @else
                                <div class="form-group">
                                    {{ Form::label('day', ' Day', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::select('day', ['0'=> "Sunday",'1'=>'Monday','2'=>'Tuesday','3'=> 'Wednesday', '4'=>'Thursday','5'=>'Friday','6'=> 'Saturday'], $team->getSchedule()->day, ['class' => 'form-control', 'placeholder' => 'Day of the Week','required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->
                                <p>Times below should be scheduled in your local time, once in the system it will auto convert to everyone's specific timezone in the Calendar.</p>
                                <hr>

                                <div class="form-group">
                                    {{ Form::label('time', ' Hour', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-5">
                                        {{ Form::select('hour', [
                                        '0'=> "00",
                                        '1'=>'01',
                                        '2'=>'02',
                                        '3'=> '03',
                                        '4'=>'04',
                                        '5'=>'05',
                                        '6'=> '06',
                                        '7'=>'07',
                                        '8'=>'08',
                                        '9'=>'09',
                                        '10'=>'10',
                                        '11'=>'11',
                                        '12'=>'12',
                                        '13'=>'13',
                                        '14'=>'14',
                                        '15'=>'15',
                                        '16'=>'16',
                                        '17'=>'17',
                                        '18'=>'18',
                                        '19'=>'19',
                                        '20'=>'20',
                                        '21'=>'21',
                                        '22'=>'22',
                                        '23'=>'23',
                                        ], $team->getSchedule()->hour, ['class' => 'form-control', 'placeholder' => 'Hour','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                    <div class="col-lg-5">
                                        {{ Form::select('minute', [
                                        '0'=> "00",
                                        '15'=>'15',
                                        '30'=>'30',
                                        '45'=> '45',
                                        ], $team->getSchedule()->minute, ['class' => 'form-control', 'placeholder' => 'Day','required' => 'required']) }}
                                    </div><!--col-lg-5-->

                                </div><!--form control-->
                            @endif


                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/jquery-minicolors/jquery.minicolors.min.js") }}
    {{ Html::script("plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js") }}
    {{ Html::script("plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#start_date').datetimepicker({
                inline: true,
                sideBySide: true
            });
            $('#end_date').datetimepicker({
                inline: true,
                sideBySide: true
            });
        });
    </script>

@endsection