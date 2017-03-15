@extends ('backend.layouts.master')

@section ('title', 'Program Goals')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        {{$program->name}} - Program Goals
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Program Goal</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">

            {!! Form::open(['route' => ['admin.programs.program-goals.put',$program->id,$goal->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('goal', 'Goal', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('goal', $goal->goal, ['class' => 'form-control', 'placeholder' => 'A sentence describing a program goal for a member to complete']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('category', 'Category', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('category', $goal->category, ['class' => 'form-control', 'placeholder' => 'Category']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                </div>

                <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
        <br><br>
        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.programs.program-goals', 'Cancel', [$program->id], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->
                {!! Form::close() !!}
                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->
@stop
