@extends ('backend.layouts.master')

@section ('title', 'Announcements')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
    <script src="/plugins/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: 'textarea',
            height: 500,
            theme: 'modern',
            browser_spellcheck: true,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true
        });</script>
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
            <h3 class="box-title">Create Announcements</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.announcements.store'],'class' => 'form-horizontal', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('subject', 'Subject', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Name']) }}
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
                            ], 'unit', ['class' => 'form-control']) }}
                        </div><!--col-lg-10-->
                    </div><!--form control-->
                    <div class="form-group">
                        {{ Form::label('sendEmail', 'Send Email', ['class' => 'col-lg-1 control-label']) }}
                        <div class="col-lg-11">
                            <input type="hidden" name="sendEmail" value="0">
                            {{ Form::checkbox('sendEmail', '1',null) }} - If checked, this will send a unit wide email
                        </div><!--col-lg-10-->
                    </div><!--form control-->

                </div><!--form control-->
            </div>

             {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => '']) }}
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
                {{ Form::submit('Create', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')
@stop