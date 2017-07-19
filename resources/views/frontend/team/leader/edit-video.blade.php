@extends('frontend.templates.master')

@section('title','Home')
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
                    <li class="active"><a href="#">Edit Video</a></li>
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
                                    <h2>Add Video</h2>
                                </div>
                            </div>
                            {{ Form::open(['route' => ['frontend.team.leader.edit-video',$team->id,$video->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                                <!-- Form would go here -->
                                <div class="form-group">
                                    {{ Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::text('name', $video->name, ['class' => 'form-control', 'placeholder' => 'Video Name','required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('youtube_url', 'Youtube URL', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::text('youtube_url', 'https://www.youtube.com/watch?v='.$video->youtube_url, ['class' => 'form-control', 'placeholder' => 'Youtube URL','required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('description', 'Description', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::textarea('description', $video->description, ['class' => 'form-control', 'placeholder' => 'Short Description','required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('content_video', 'Body', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::textarea('content_video', $video->content, ['class' => 'form-control', 'placeholder' => 'Content','required' => 'required', 'id'=>'content']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->
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
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js" type="text/javascript"></script>
@endsection