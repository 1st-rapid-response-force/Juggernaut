@extends('frontend.templates.master')

@section('title','Register')

@section('content')
    <!-- wrapper -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Register</h2>
                                </div>
                            </div>
                            <p>This registration form is used to create an account on the 1st RRF systems. This will allow you apply to the unit.</p>
                            <p>1st Rapid Response Force systems use Steam Open ID authentication for login. For more information <a href="http://steamcommunity.com/dev">click here.</a></p>
                            <hr>
                            {{ Form::open(['route' => 'frontend.user.register.post', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                                <!-- Form would go here -->
                                <div class="form-group">
                                    {{ Form::label('first_name', ' Name', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-5">
                                        {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                    <div class="col-lg-5">
                                        {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('email', 'Email', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'john.doe@1st-rrf.com']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('steam_id', 'Steam ID', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::text('steam_id', $steam_id, ['class' => 'form-control', 'readonly']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('timezone', 'Timezone', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::selectTimezone('timezone', session('timezone','UTC'), ['class' => 'form-control']) }}
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
    <script src="/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'signature', {
                height: 300
            });
        });
    </script>
@endsection