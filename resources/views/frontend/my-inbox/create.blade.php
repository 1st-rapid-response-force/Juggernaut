@extends('frontend.templates.master')

@section('title','My Inbox')

@section('after-styles-end')
    <link href="/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
            selector: 'textarea',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code media'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
            browser_spellcheck: true
        });</script>
@endsection

@section('content')
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">{{\Auth::User()->member}}</a></li>
                    <li><a href="{{route('inbox')}}">My Inbox</a></li>
                    <li class="active">Compose Message</li>
                </ol>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
            <div class="container">
                <h3>Compose new message</h3>
                <hr>
                <form action="{{route('inbox.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="autocomplete" class="control-label">Users</label>
                        <select name="autocomplete[]" multiple id="names" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="subject" class="control-label">Subject</label>
                        <input type="subject" class="form-control" name="subject">
                    </div>

                    <div class="form-group">
                        <label for="message" class="control-label">Message</label>
                        <textarea name="message"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="files" class="control-label">Files</label>
                        <input type="file" name="file[]" accept="media_type" multiple>
                    </div>

                    <div class="form-group pull-right">
                        <input type="submit" class="btn btn-primary">
                    </div>

                </form>

            </div>
    </div>
    </section>
    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $('#names').select2({
            placeholder: 'Search 1st RRF Members',
            minimumInputLength: 3,
            ajax: {
                url: '/autocomplete/members',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                results: function (data, page) {
                    return {results: data};
                }
            },
        });
    </script>
@endsection


