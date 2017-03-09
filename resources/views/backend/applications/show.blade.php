@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.calendar.management'))

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Show Application - {{$app->getApplication()->first_name}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Applications</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="container well">
            <strong>Application Type: {{$app->getApplication()->type}}</strong>
            {{ Form::open(['route' => 'frontend.apply.application.post', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
            <div class="form-group">
                {{ Form::label('first_name', 'First Name', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('first_name', $app->getApplication()->first_name, ['class' => 'form-control', 'placeholder' => 'First Name', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('last_name', 'Last Name', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('last_name', $app->getApplication()->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('steam_id', 'Military ID', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('steam_id', $app->user->steam_id, ['class' => 'form-control', 'disabled']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('dob', 'Date of Birth', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('dob', $app->getApplication()->dob, ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('nationality', 'Nationality', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::text('nationality', $app->getApplication()->nationality, ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('prior_experience', 'Have you been in a unit before:', ['class' => 'col-lg-10 control-label text-left']) }}
                <div class="col-lg-2">
                    {{ Form::radio('prior_experience', '1', $app->getApplication()->prior_experience) }} Yes <br>
                    {{ Form::radio('prior_experience', '0', !$app->getApplication()->prior_experience) }} No
                </div>
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('dishonorable_discharge', 'Have you been dishonorable discharged/removed from a unit before:', ['class' => 'col-lg-10 control-label text-left']) }}
                <div class="col-lg-2">
                    {{ Form::radio('dishonorable_discharge', '1', $app->getApplication()->dishonorable_discharge) }} Yes <br>
                    {{ Form::radio('dishonorable_discharge', '0', !$app->getApplication()->dishonorable_discharge) }} No
                </div>
            </div><!--form control-->
            <div class="form-group">
                {{ Form::label('prior_groups', 'What groups have you been a part of:', ['class' => 'col-lg-4 control-label']) }}

                <div class="col-lg-8">
                    {{ Form::text('prior_groups', $app->getApplication()->prior_groups, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('highest_rank', 'What was the highest rank you have obtained:', ['class' => 'col-lg-4 control-label']) }}

                <div class="col-lg-8">
                    {{ Form::text('highest_rank', $app->getApplication()->highest_rank, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('relevant_training', 'Relevant Training:', ['class' => 'col-lg-4 control-label']) }}

                <div class="col-lg-8">
                    {{ Form::text('relevant_training', $app->getApplication()->relevant_training, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.', 'readonly']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('departure_reason', 'Reason for departure from previous unit:', ['class' => 'control-label', 'readonly']) }}<br>
                <textarea class="form-control" name="departure_reason" readonly>{{$app->getApplication()->departure_reason}}</textarea>
            </div><!--form control-->


            <div class="form-group">
                {{ Form::label('reason_for_joining', 'Why do you want to join the 1st RRF:', ['class' => 'control-label', 'readonly']) }}<br>
                <textarea class="form-control" name="reason_for_joining" readonly>{{$app->getApplication()->reason_for_joining}}</textarea>
            </div><!--form control-->



            <div class="form-group">
                {{ Form::label('agreement_milsim', 'I understand that I am joining a military simulation unit:', ['class' => 'col-lg-10 control-label text-left', 'readonly']) }}
                <div class="col-lg-2">
                    {{ Form::radio('agreement_milsim', '1', $app->getApplication()->agreement_milsim) }} Yes <br>
                    {{ Form::radio('agreement_milsim', '0', !$app->getApplication()->agreement_milsim) }} No
                </div>
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('agreement_orders', 'I understand that I am expected to follow orders given to me:', ['class' => 'col-lg-10 control-label text-left', 'readonly']) }}
                <div class="col-lg-2">
                    {{ Form::radio('agreement_orders', '1', $app->getApplication()->agreement_orders) }} Yes <br>
                    {{ Form::radio('agreement_orders', '0', !$app->getApplication()->agreement_orders) }} No
                </div>
            </div><!--form control-->

            <div class="form-group">
                {{ Form::label('agreement_ranks', 'I understand that I am expected to respect ranks, customs, and courtesies:', ['class' => 'col-lg-10 control-label text-left', 'readonly']) }}
                <div class="col-lg-2">
                    {{ Form::radio('agreement_ranks', '1', $app->getApplication()->agreement_ranks) }} Yes <br>
                    {{ Form::radio('agreement_ranks', '0', !$app->getApplication()->agreement_ranks) }} No
                </div>
            </div><!--form control-->
            <hr>
            <div class="pull-right">
                @if($app->status == 1)
                <a href="{{route('admin.applications.decline',$app->id)}}" class="btn btn-danger">Decline Applicant</a>
                <a href="{{route('admin.applications.accept',$app->id)}}" class="btn btn-success">Accept Applicant</a>
                @else
                    This application has already been processed.
                @endif
            </div><!--pull-right-->

            <div class="clearfix"></div>
            {{ Form::close() }}
            </div>
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')

@stop