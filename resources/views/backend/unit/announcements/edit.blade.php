@extends ('backend.layouts.master')

@section ('title', 'Announcements')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Announcements
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Announcements</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.announcements.update', $announcement->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('subject', 'Subject', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            {{ Form::text('subject', $announcement->subject, ['class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                    <div class="form-group">
                        {{ Form::label('category', 'Category', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            {{ Form::select('category', [
                            'promotions' => 'Promotions',
                            'modpack' => 'Modpack',
                            'servers' => 'Servers',
                            'operations' => 'Operations',
                            'training' => 'Training',
                            'board' => 'Board News',
                            'unit' => 'Unit News'
                            ], $announcement->category, ['class' => 'form-control']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                </div><!--form control-->
            </div>

             {{ Form::textarea('message', $announcement->message, ['class' => 'form-control', 'placeholder' => '']) }}
            <small>Updating this will <strong>not</strong> send out an email, but will update the announcements on the site.</small>
                <div class="clearfix"></div>
            </div>

        </div>
    <!-- /.box -->
    <!-- /.box-body -->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.announcements.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
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
    <script src="/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'message', {
                height: 400
            });
        });
    </script>
@stop