@extends('frontend.templates.master')

@section('title','Application')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Application for the 1st Rapid Response Force</a></h2>
                                </div>
                            </div>

                            <p>This paperwork is for a fictional organization, we are not affiliated or associated with any real life entity. We are simply a MILSIM oriented group for ARMA 3. The information you are providing is for your
                                character.</p>
                            <p>However your application must meet the following requirements</p>
                            <ul>
                                <li>Your name must be realistic but does not need to be your real name - an example of this would be "James Edward"</li>
                                <li>The age field must be accurate. Failure to disclose your actual age will result in discharge from the unit.</li>
                            </ul>
                            @if($type == 'enlisted')
                                <p>You are currently applying as an enlisted member. You must be atleast 16 years of age or older</p>
                            @endif
                            @if($type == 'nco')
                                <p>You are currently applying as an NCO. You must be atleast 18 years of age or older</p>
                            @endif
                            @if($type == 'officer')
                                <p>You are currently applying as an Officer. You must be atleast 20 years of age or older</p>
                            @endif
                            <HR>
                            {{ Form::open(['route' => 'frontend.apply.application.post', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
                            <div class="form-group">
                                {{ Form::label('first_name', 'First Name', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('last_name', 'Last Name', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->

                            <div class="form-group">
                                {{ Form::label('steam_id', 'Military ID', ['class' => 'col-lg-2 control-label']) }}

                                <div class="col-lg-10">
                                    {{ Form::text('steam_id', \Auth::User()->steam_id, ['class' => 'form-control', 'disabled']) }}
                                </div><!--col-lg-10-->
                            </div><!--form control-->


                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


