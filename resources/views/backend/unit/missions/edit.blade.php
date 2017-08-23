@extends ('backend.layouts.master')

@section ('title', 'Missions')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Missions
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Mission</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.missions.update',$mission->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('name', $mission->name, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('mission', 'Mission PBO', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <input type="file" name="mission" accept="media_type">
                            <ul>
                                @foreach($mission->getMedia('mission') as $attachment)
                                    <li style="padding-top:5px"><a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a> </li>
                                @endforeach
                            </ul>
                            <small>Reuploading it will overwrite the previous file.</small><br>
                            <p>File was uploaded on {{$mission->updated_at}} by {{$mission->user->member}}</p>
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
                {{ link_to_route('admin.missions.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
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