@extends ('backend.layouts.master')

@section ('title', 'Program')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Program
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Program</h3>

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
                        {{ Form::label('video', 'Video (URL)', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('video', $program->video, ['class' => 'form-control', 'placeholder' => 'Video URL - optional']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('video', 'Document (URL)', ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            {{ Form::text('document', $program->document, ['class' => 'form-control', 'placeholder' => 'Document URL - optional']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                    <div class="form-group">
                        {{ Form::label('file', 'Files', ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-10">
                            <input type="file" name="file[]" accept="media_type" multiple>
                            <small>New Files will replace other attachments</small><br>
                            @if($program->getMedia('attachments')->count())

                                <div class="attachment">
                                    <h4>Attachment</h4>
                                    @foreach($program->getMedia('attachments') as $attachment)
                                        <a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a><br>
                                    @endforeach
                                </div>

                            @endif
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