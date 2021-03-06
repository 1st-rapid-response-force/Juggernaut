@extends('frontend.templates.master')

@section('title','Application')

@section('after-styles-end')
    <link rel="stylesheet" type="text/css" href="/plugins/gridforms/gridforms.css">
@endsection

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
                            <div class="alert alert-warning">
                                <p>The 1st Rapid Response Force does not allow dual-claning within active membership, you can still join the unit and participate in operations but you will be limited to the Reserve Pool.</p>
                                <p>We review applications weekly, each Saturday in bulk. We will email you our decision.</p>
                            </div>
                            <HR>
                            <div class="well">
                                {{ Form::open(['route' => 'frontend.apply.application.post', 'class' => 'grid-form', 'role' => 'form', 'method' => 'post']) }}
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>ENLISTMENT/REENLISTMENT DOCUMENT</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> To record enlistment or reenlistment into the 1st Rapid Response Force. This information becomes a part of the subject's military personnel records which are used to document promotion, reassignment, training, medical support, and other personnel management actions.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Master File and Field Personnel File.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; however, failure to furnish personal identification information may negate the enlistment/reenlistment application</p>
                                    <fieldset>
                                        <legend>A. ENLISTEE/REENLISTEE IDENTIFICATION DATA</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <label>FIRST NAME</label>
                                                <input type="text" name="first_name" value="{{\Auth::User()->first_name}}" required>
                                            </div>
                                            <div data-field-span="1">
                                                <label>LAST NAME</label>
                                                <input type="text" name="last_name" value="{{\Auth::User()->last_name}}" required>
                                            </div>
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input type="text" name="steam_id" readonly value="{{\Auth::User()->steam_id}}">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="1">
                                                <label>DATE OF BIRTH</label>
                                                <input type="text" id="dob" name="dob" placeholder="MM/DD/YYYY">
                                            </div>
                                            <div data-field-span="2">
                                                <label>Nationality</label>
                                                @include('frontend.apply.include.nationality')
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="4" data-field-error="Please enter a valid email address">
                                                <label>E-mail</label>
                                                <input type="email" name="email" readonly value="{{\Auth::User()->email}}">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. ENLISTMENT SECTION</legend>
                                        <fieldset>
                                            <legend>PREVIOUS EXPERIENCE</legend>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>HAVE YOU BEEN IN A MILSIM UNIT BEFORE</label>
                                                    <label><input type="radio" name="prior_experience" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="prior_experience" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>HAVE YOU BEEN DISHONORABLY DISCHARGED/REMOVED FROM A UNIT</label>
                                                    <label><input type="radio" name="dishonorable_discharge" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="dishonorable_discharge" value="0" checked> NO</label> &nbsp;
                                                </div>
                                            </div>
                                            <div data-row-span="1">
                                                <div data-field-span="1">
                                                    <label>WHAT POSITION ARE YOU APPLYING FOR</label>
                                                    <textarea name="position" rows="1" placeholder="Leave blank if you were not referred by a recruitment post."></textarea>
                                                </div>
                                            </div>
                                            <div data-row-span="1">
                                                <div data-field-span="1">
                                                    <label>REASONING FOR JOINING THE 1ST RRF</label>
                                                    <textarea name="reason_for_joining" rows="3" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </fieldset>



                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>WHAT GROUPS HAVE YOU BEEN A PART OF:</label>
                                                <input type="text" name="prior_groups" placeholder="LEAVE THE REST OF THIS SECTION BLANK, IF NOT APPLICABLE">
                                            </div>
                                        </div>
                                        <div data-row-span="2">
                                            <div data-field-span="1">
                                                <label>HIGHEST RANK ATTAINED</label>
                                                <input type="text" name="highest_rank" placeholder="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RELEVANT TRAINING:</label>
                                                <input type="text" name="relevant_training" placeholder="">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>REASON FOR DEPARTURE FROM PREVIOUS UNIT</label>
                                                <input type="text" name="departure_reason" placeholder="">
                                            </div>
                                        </div>
                                        <br>
                                        <fieldset>
                                            <legend>AGREEMENTS</legend>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>I UNDERSTAND THAT I AM JOINING A MILITARY SIMULATION UNIT</label>
                                                    <label><input type="radio" name="agreement_milsim" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_milsim" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>I UNDERSTAND I WILL BE EXPECTED TO SHOW UP TWICE A WEEK TO EVENTS (UNLESS I NOTIFY IN ADVANCE I WILL NOT BE ABLE TO ATTEND)</label>
                                                    <label><input type="radio" name="agreement_twice" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_twice" value="0" checked> NO</label> &nbsp;
                                                </div>
                                            </div>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>I UNDERSTAND IF ACCEPTED INTO THE 1RRF, I WILL BE ASSIGNED RECRUIT STATUS AND CAN BE DISMISSED AT ANYTIME (UNTIL COMPLETION OF RECRUITMENT PHASE).</label>
                                                    <label><input type="radio" name="agreement_recruit" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_recruit" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>I UNDERSTAND IF ACCEPTED INTO THE 1RRF, I WILL BE ASSIGNED TO AN EXISTING RRF MEMBER FOR TRAINING</label>
                                                    <label><input type="radio" name="agreement_buddy" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_buddy" value="0" checked> NO</label> &nbsp;
                                                </div>
                                            </div>
                                        </fieldset>
                                        <br>
                                        <div class="pull-right">
                                            <input class="btn btn-primary" type="submit">
                                        </div>
                                    </fieldset>
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

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/gridforms/gridforms.js"></script>
@endsection
