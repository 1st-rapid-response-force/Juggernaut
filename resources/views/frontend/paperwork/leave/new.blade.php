@extends('frontend.templates.master')

@section('title','Leave')

@section('after-styles-end')
    {{ Html::style("plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css") }}
@stop

@section('content')

    <!-- wrapper -->
    <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('frontend.files.my-file')}}">{{\Auth::User()->member}}</a></li>
                <li class="active">Leave of Absence</li>
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
                                <h2>Leave of Absence</h2>
                            </div>
                        </div>
                        <p>You can mark yourself on leave if you will be unable to participate actively or are unable to attend an operation. Upon marking yourself on leave your leadership will be notified and your Teamspeak, File, and Team rosters will indicate that you are on leave.</p>

                    {{ Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                    <!-- Form would go here -->
                        <div class="form-group">
                            {{ Form::label('loa', ' On Leave', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                <input type="hidden" name="loa" value="0">
                                {{ Form::checkbox('loa',1, Auth::user()->member->loa) }}<br>
                                <small>Checking this box sets your status to "On Leave", you can manually turn it off or the system will automatically clear the LOA once your anticipated return date arrives.</small>
                            </div><!--col-lg-10-->
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('loa_return', ' Anticipated Return Date', ['class' => 'col-lg-2 control-label']) }}

                            <div class="col-lg-10">
                                {{ Form::text('loa_return', Auth::User()->member->loa_return, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD','required' => 'required','id' => 'anticipatedReturn']) }}
                            </div><!--col-lg-10-->
                        </div><!--form control-->
                        <br>
                        <hr>
                        <br>
                        <div class="form-group pull-left">
                            <a href="{{route('frontend.files.my-file')}}" class="btn btn-danger">Cancel </a>
                        </div>

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
    {{ Html::script("plugins/fullcalendar/lib/moment.min.js") }}
    {{ Html::script("plugins/jquery-minicolors/jquery.minicolors.min.js") }}
    {{ Html::script("plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js") }}
    {{ Html::script("plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js") }}
    <script type="text/javascript">
        $(function () {
            $('#anticipatedReturn').datetimepicker({
                format: "YYYY-MM-DD",
                inline: true,
                keepOpen: true
            });
        });
    </script>
@endsection