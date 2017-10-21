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
                                    <h2><a href="#">Application for the TF Everest</a></h2>
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
                                <p>The TF Everest does not allow dual-clanning within active membership. Breaking this rule is grounds for dishonorable discharge.</p>
                                <p>We review applications weekly, each Saturday in bulk. We will email you our decision.</p>
                            </div>
                            <HR>
                            <div class="well">
                                {{ Form::open(['route' => 'frontend.apply.application.post', 'class' => 'grid-form', 'role' => 'form', 'method' => 'post']) }}
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>ENLISTMENT/REENLISTMENT DOCUMENT</strong><br> TF EVEREST<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> TFE-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> To record enlistment or reenlistment into the Task Force Everest. This information becomes a part of the subject's military personnel records which are used to document promotion, reassignment, training, medical support, and other personnel management actions.</p>
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
                                        <div data-row-span="2">
                                            <div data-field-span="1">
                                                <label>DATE OF BIRTH</label>
                                                <input type="text" id="dob" name="dob" placeholder="DD-MM-YYYY">
                                            </div>
                                            <div data-field-span="1" data-field-error="Please enter a valid email address">
                                                <label>E-mail</label>
                                                <input type="email" name="email" readonly value="{{\Auth::User()->email}}">
                                            </div>
                                        </div>
                                        <div data-row-span="2">
                                            @if(isset($app->getApplication()->locality))
                                                <div data-field-span="1">
                                                    <label>CURRENT LOCALITY</label>
                                                    @include('frontend.apply.include.local')
                                                </div>
                                            @endif
                                            <div data-field-span="1">
                                                <label>Nationality</label>
                                                @include('frontend.apply.include.nationality')
                                            </div>

                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. ENLISTMENT SECTION</legend>
                                        <fieldset>
                                            <legend>GENERAL</legend>
                                            <div data-row-span="1">
                                                <div data-field-span="1">
                                                    <label>WHAT CHAIN OF COMMAND ARE YOU APPLYING FOR?</label>
                                                    <select name="position">
                                                        <option>Headquarters</option>
                                                        <option>Infantry</option>
                                                        <option>Cavalry</option>
                                                        <option>Fleet Air</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if(isset($app->getApplication()->new_to_arma))
                                            <br>
                                            <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>I AM INTERESTING IN TAKING THE "INTRODUCTION TO ARMA" SESSION TO ESTABLISH BASIC SKILLS SUCH AS MOVEMENT AND WEAPON HANDLING.</label>
                                                <label><input type="radio" name="new_to_arma" value="1"> YES</label> &nbsp;
                                                <label><input type="radio" name="new_to_arma" value="0" checked> NO</label> &nbsp;
                                            </div>
                                            </div>
                                            @endif
                                        </fieldset><br>
                                            <fieldset>
                                            <legend>PRIOR SERVICE TRANSFER INFORMATION</legend>
                                                <p>This section is only for use of players who have previously been in an ARMA III Military Simulation group.</p>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>HAVE YOU BEEN IN A MILSIM UNIT BEFORE</label>
                                                    <label><input type="radio" name="prior_experience" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="prior_experience" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>DISCHARGE TYPE (HONOURABLE, GENERAL, ADMINISTRATIVE, DISHONOURABLE)</label>
                                                    <select name="discharge_type">
                                                        <option>Honourable</option>
                                                        <option>General</option>
                                                        <option>Administrative</option>
                                                        <option>Dishonorable</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </fieldset>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>LAST UNIT:</label>
                                                <input type="text" name="prior_groups" placeholder="">
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
                                        <div data-row-span="2">
                                            <div data-field-span="2">
                                                <label>ROLES/MOS OCCUPIED</label>
                                                <input type="text" name="highest_rank" placeholder="">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>REASON FOR DEPARTURE FROM PREVIOUS UNIT</label>
                                                <input type="text" name="departure_reason" placeholder="">
                                            </div>
                                        </div>
                                        @if(isset($app->getApplication()->transfer))
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>I AM INTERESTED IN APPLYING FOR THE STANDARDISED TRANSFER ASSESSMENT TEST (stat) AS PART OF MY APPLICATION.</label>
                                                <label><input type="radio" name="transfer" value="1"> YES</label> &nbsp;
                                                <label><input type="radio" name="transfer" value="0" checked> NO</label> &nbsp;
                                            </div>
                                        </div>
                                        @endif
                                        <br>
                                        <fieldset>
                                            <legend>AGREEMENTS</legend>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>I ASSERT THAT ALL INFORMATION I HAVE PROVIDED IN THIS APPLICATION IS TRUTHFUL AND CORRECT TO THE BEST PART OF MY KNOWLEDGE.</label>
                                                    <label><input type="radio" name="agreement_truth" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_truth" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>I CONSENT FOR MY APPLICATION AND DATA TO BE PROCESSED BY SELECTED MEMBERS OF TASK FORCE EVEREST STAFF DEPARTMENTS</label>
                                                    <label><input type="radio" name="agreement_consent" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_consent" value="0" checked> NO</label> &nbsp;
                                                </div>
                                            </div>
                                            <div data-row-span="2">
                                                <div data-field-span="1">
                                                    <label>I AM NOT CURRENTLY ENLISTED OR PARTICIPATING IN ANOTHER MILITARY SIMULATION, TACTICAL REALISM OR ORGANIZED GAMING COMMUNITY THAT OPERATES WITHIN ARMA III</label>
                                                    <label><input type="radio" name="agreement_dualclan" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_dualclan" value="0" checked> NO</label> &nbsp;
                                                </div>
                                                <div data-field-span="1">
                                                    <label>I AGREE TO BE BOUND BY THE TASK FORCE EVEREST'S UNIFORM CODE OF MILITARY JUSTICE COMMENCING AT THE TIME OF MY SUBMISSION OF THIS APPLICATION FORM UNTIL I RECEIVE MY DD-214 FROM THE S1 DEPARTMENT OF TASK FORCE EVEREST</label>
                                                    <label><input type="radio" name="agreement_ucmj" value="1"> YES</label> &nbsp;
                                                    <label><input type="radio" name="agreement_ucmj" value="0" checked> NO</label> &nbsp;
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
