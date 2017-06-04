@extends ('backend.layouts.master')

@section ('title', 'Program')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Qualification Program
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Qualification Program</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.programs.update',$program->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('name', $program->name, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('description', $program->description, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('qualification_id', 'Qualification', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <select class="form-control" name="qualification_id">
                                @foreach(\App\Models\Unit\Qualification::all() as $qualification)
                                    <option value="{{$qualification->id}}" {{$qualification->id == $program->qualification_id ? 'selected' : ''}}>{{$qualification->name}}</option>
                                @endforeach
                            </select>
                        </div><!--col-lg-10-->
                    </div><!--form control-->
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
                {{ link_to_route('admin.programs.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
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

@stop