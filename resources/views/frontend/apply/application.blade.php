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
                            <div class="well">
                                <div class="text-center"><legend><strong>ENLISTMENT/REENLISTMENT DOCUMENT</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                <p><strong>PRINCIPAL PURPOSE(S): </strong> To record enlistment or reenlistment into the 1st Rapid Response Force. This information becomes a part of the subject's military personnel records which are used to document promotion, reassignment, training, medical support, and other personnel management actions.</p>
                                <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Master File and Field Personnel File.</p>
                                <p><strong>DISCLOSURE: </strong> Voluntary; however, failure to furnish personal identification information may negate the enlistment/reenlistment application</p>
                                    <legend>A. ENLISTEE/REENLISTEE IDENTIFICATION DATA</legend>
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

                                    <div class="form-group">
                                        {{ Form::label('dob', 'Date of Birth', ['class' => 'col-lg-2 control-label']) }}

                                        <div class="col-lg-10">
                                            {{ Form::text('dob', null, ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY']) }}
                                        </div><!--col-lg-10-->
                                    </div><!--form control-->

                                    <div class="form-group">
                                        {{ Form::label('nationality', 'Nationality', ['class' => 'col-lg-2 control-label']) }}

                                        <div class="col-lg-10">
                                            @include('frontend.apply.include.nationality')
                                        </div><!--col-lg-10-->
                                    </div><!--form control-->
                                <legend>B. CONDUCT AND PREVIOUS EXPERIENCE</legend>
                                <div class="form-group">
                                    {{ Form::label('prior_experience', 'Have you been in a unit before:', ['class' => 'col-lg-10 control-label text-left']) }}
                                    <div class="col-lg-2">
                                        {{ Form::radio('prior_experience', '1') }} Yes <br>
                                        {{ Form::radio('prior_experience', '0',true) }} No
                                    </div>
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('dishonorable_discharge', 'Have you been dishonorable discharged/removed from a unit before:', ['class' => 'col-lg-10 control-label text-left']) }}
                                    <div class="col-lg-2">
                                        {{ Form::radio('dishonorable_discharge', '1') }} Yes <br>
                                        {{ Form::radio('dishonorable_discharge', '0',true) }} No
                                    </div>
                                </div><!--form control-->
                                <div class="form-group">
                                    {{ Form::label('prior_groups', 'What groups have you been a part of:', ['class' => 'col-lg-4 control-label']) }}

                                    <div class="col-lg-8">
                                        {{ Form::text('prior_groups', null, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('highest_rank', 'What was the highest rank you have obtained:', ['class' => 'col-lg-4 control-label']) }}

                                    <div class="col-lg-8">
                                        {{ Form::text('highest_rank', null, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('relevant_training', 'Relevant Training:', ['class' => 'col-lg-4 control-label']) }}

                                    <div class="col-lg-8">
                                        {{ Form::text('relevant_training', null, ['class' => 'form-control', 'placeholder' => 'You can leave this field blank if not applicable.']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('departure_reason', 'Reason for departure from previous unit:', ['class' => 'control-label']) }}<br>
                                    <textarea class="form-control" name="departure_reason"></textarea>
                                </div><!--form control-->

                                <legend>C. MISC</legend>
                                <div class="form-group">
                                    {{ Form::label('reason_for_joining', 'Why do you want to join the 1st RRF:', ['class' => 'control-label']) }}<br>
                                    <textarea class="form-control" name="reason_for_joining"></textarea>
                                </div><!--form control-->


                                <legend>D. AGREEMENTS</legend>
                                <div class="form-group">
                                    {{ Form::label('agreement_milsim', 'I understand that I am joining a military simulation unit:', ['class' => 'col-lg-10 control-label text-left']) }}
                                    <div class="col-lg-2">
                                        {{ Form::radio('agreement_milsim', '1') }} Yes <br>
                                        {{ Form::radio('agreement_milsim', '0',true) }} No
                                    </div>
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('agreement_orders', 'I understand that I am expected to follow orders given to me:', ['class' => 'col-lg-10 control-label text-left']) }}
                                    <div class="col-lg-2">
                                        {{ Form::radio('agreement_orders', '1') }} Yes <br>
                                        {{ Form::radio('agreement_orders', '0',true) }} No
                                    </div>
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('agreement_ranks', 'I understand that I am expected to respect ranks, customs, and courtesies:', ['class' => 'col-lg-10 control-label text-left']) }}
                                    <div class="col-lg-2">
                                        {{ Form::radio('agreement_ranks', '1') }} Yes <br>
                                        {{ Form::radio('agreement_ranks', '0',true) }} No
                                    </div>
                                </div><!--form control-->
                                <hr>
                                <div class="pull-right">
                                    {{ Form::submit('Sign and Submit', ['class' => 'btn btn-success']) }}
                                </div><!--pull-right-->
                                <input type="hidden" name="type" value="{{$type}}">

                                <div class="clearfix"></div>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


