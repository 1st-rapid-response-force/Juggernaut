@extends ('backend.layouts.master')

@section ('title', 'Edit FRAGO')

@section('page-header')
    <h1>
        Edit FRAGO
    </h1>
@endsection

@section('after-styles-end')
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

@section('content')
    {{ Form::open(['route' => ['admin.operations.frago.update',$operation->id, $frago->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'put', 'files' => false]) }}
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Edit FRAGO</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <!-- Form would go here -->

            <div class="form-group">
                {{ Form::label('FRAGO', 'FRAGO', ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-10">
                    {{ Form::textarea('message', $frago->message, ['class' => 'form-control', 'placeholder' => '']) }}
                </div><!--col-lg-10-->
            </div><!--form control-->


        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-body">
            <div class="pull-left">
                <a href="{{route('admin.operations.edit',$operation->id)}}" class="btn btn-danger btn-xs">Cancel</a>
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit('Save', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->

            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts-end')

@stop