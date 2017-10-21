@extends ('backend.layouts.master')

@section ('title', 'Applications')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
    <link rel="stylesheet" type="text/css" href="/plugins/gridforms/gridforms.css">
@stop

@section('page-header')
    <h1>
        Show Application - {{$app->getApplication()->first_name}}
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Applications</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="container">
                <div class="well">
                    {{ Form::open(['route' => 'frontend.apply.application.post', 'class' => 'grid-form', 'role' => 'form', 'method' => 'post']) }}
                    {!! csrf_field() !!}
                    <div class="text-center"><legend><strong>ENLISTMENT/REENLISTMENT DOCUMENT</strong><br> TF EVEREST<br><br></legend></div>
                    @if(isset($app->getApplication()->reserve) && ($app->getApplication()->reserve))
                        <div class="text-center"> <span class="label label-danger">RESERVE APPLICATION</span></div>
                    @elseif(isset($app->getApplication()->reserve) && (!$app->getApplication()->reserve))
                        <div class="text-center"> <span class="label label-primary">ACTIVE APPLICATION</span></div>
                    @endif
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
                                <input type="text" name="first_name" readonly value="{{$app->getApplication()->first_name}}" required>
                            </div>
                            <div data-field-span="1">
                                <label>LAST NAME</label>
                                <input type="text" name="last_name" readonly  value="{{$app->getApplication()->last_name}}" required>
                            </div>
                            @if(isset($app->getApplication()->steam_id))
                            <div data-field-span="2">
                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                <input type="text" name="steam_id" readonly value="{{$app->getApplication()->steam_id}}">
                            </div>
                            @endif
                        </div>
                        <div data-row-span="2">
                            <div data-field-span="1">
                                <label>DATE OF BIRTH</label>
                                <input type="text" id="dob" name="dob" readonly value="{{$app->getApplication()->dob}}" placeholder="MM/DD/YYYY">
                            </div>
                            <div data-field-span="1" data-field-error="Please enter a valid email address">
                                <label>E-mail</label>
                                <input type="email" name="email" readonly value="{{$app->getApplication()->email}}">
                            </div>
                        </div>
                        <div data-row-span="2">
                            <div data-field-span="2">
                                <label>Nationality</label>
                                <input type="text" name="nationality" readonly value="{{$app->getApplication()->nationality}}">
                            </div>
                            <div data-field-span="1">
                                <label>CURRENT LOCALITY</label>
                                <input type="text" id="dob" name="locality" readonly value="{{$app->getApplication()->locality}}" placeholder="Country of Residence">
                            </div>

                            <div data-field-span="1">
                                <label>I AM INTERESTING IN TAKING THE "INTRODUCTION TO ARMA" SESSION TO ESTABLISH BASIC SKILLS SUCH AS MOVEMENT AND WEAPON HANDLING.</label>
                                <label><input type="radio" name="new_to_arma" value="1" {{$app->getApplication()->new_to_arma == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                <label><input type="radio" name="new_to_arma" value="0" {{$app->getApplication()->new_to_arma == 0 ? 'checked' : ''}}> NO</label> &nbsp;
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
                                        <option {{$app->getApplication()->position == 'Headquarters' ? 'selected' : ''}}>Headquarters</option>
                                        <option {{$app->getApplication()->position == 'Infantry' ? 'selected' : ''}}>Infantry</option>
                                        <option {{$app->getApplication()->position == 'Cavalry' ? 'selected' : ''}}>Cavalry</option>
                                        <option {{$app->getApplication()->position == 'Fleet Air' ? 'selected' : ''}}>Fleet Air</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset><br>
                        <fieldset>
                            <legend>PRIOR SERVICE TRANSFER INFORMATION</legend>
                            <div data-row-span="2">
                                <div data-field-span="1">
                                    <label>HAVE YOU BEEN IN A MILSIM UNIT BEFORE</label>
                                    <label><input type="radio" name="prior_experience" value="1" {{$app->getApplication()->prior_experience == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="prior_experience" value="0" {{$app->getApplication()->prior_experience == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                <div data-field-span="1">
                                    <label>DISCHARGE TYPE (HONOURABLE, GENERAL, ADMINISTRATIVE, DISHONOURABLE)</label>
                                    <select name="discharge_type">
                                        <option {{$app->getApplication()->discharge_type == 'Honourable' ? 'selected' : ''}}>Honourable</option>
                                        <option {{$app->getApplication()->discharge_type == 'General' ? 'selected' : ''}}>General</option>
                                        <option {{$app->getApplication()->discharge_type == 'Administrative' ? 'selected' : ''}}>Administrative</option>
                                        <option {{$app->getApplication()->discharge_type == 'Dishonorable' ? 'selected' : ''}}>Dishonorable</option>
                                    </select>
                                </div>
                            </div>

                        </fieldset>
                        <div data-row-span="1">
                            <div data-field-span="1">
                                <label>LAST UNIT:</label>
                                <input type="text" name="prior_groups" placeholder="" value="{{$app->getApplication()->prior_groups}}">
                            </div>
                        </div>
                        <div data-row-span="2">
                            <div data-field-span="1">
                                <label>HIGHEST RANK ATTAINED</label>
                                <input type="text" name="highest_rank" placeholder="" value="{{$app->getApplication()->highest_rank}}">
                            </div>
                            <div data-field-span="1">
                                <label>RELEVANT TRAINING:</label>
                                <input type="text" name="relevant_training" placeholder="" value="{{$app->getApplication()->relevant_training}}">
                            </div>
                        </div>
                        <div data-row-span="2">
                            <div data-field-span="2">
                                <label>ROLES/MOS OCCUPIED</label>
                                <input type="text" name="highest_rank" placeholder="" value="{{$app->getApplication()->highest_rank}}">
                            </div>
                        </div>
                        <div data-row-span="1">
                            <div data-field-span="1">
                                <label>REASON FOR DEPARTURE FROM PREVIOUS UNIT</label>
                                <input type="text" name="departure_reason" placeholder="" value="{{$app->getApplication()->departure_reason}}">
                            </div>
                        </div>
                        <div data-row-span="1">
                            <div data-field-span="1">
                                <label>I AM INTERESTED IN APPLYING FOR THE STANDARDISED TRANSFER ASSESSMENT TEST (stat) AS PART OF MY APPLICATION.</label>
                                <label><input type="radio" name="transfer" value="1" {{$app->getApplication()->transfer == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                <label><input type="radio" name="transfer" value="0" {{$app->getApplication()->transfer == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                            </div>
                        </div>
                        <br>
                        <fieldset>
                            <legend>AGREEMENTS</legend>
                            <div data-row-span="2">
                                <div data-field-span="1">
                                    <label>I ASSERT THAT ALL INFORMATION I HAVE PROVIDED IN THIS APPLICATION IS TRUTHFUL AND CORRECT TO THE BEST PART OF MY KNOWLEDGE.</label>
                                    <label><input type="radio" name="agreement_truth" value="1" {{$app->getApplication()->agreement_truth == 1 ? 'checked' : ''}} > YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_truth" value="0" {{$app->getApplication()->agreement_truth == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                <div data-field-span="1">
                                    <label>I CONSENT FOR MY APPLICATION AND DATA TO BE PROCESSED BY SELECTED MEMBERS OF TASK FORCE EVEREST STAFF DEPARTMENTS</label>
                                    <label><input type="radio" name="agreement_consent" value="1" {{$app->getApplication()->agreement_consent == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_consent" value="0" {{$app->getApplication()->agreement_consent == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                            </div>
                            <div data-row-span="2">
                                <div data-field-span="1">
                                    <label>I AM NOT CURRENTLY ENLISTED OR PARTICIPATING IN ANOTHER MILITARY SIMULATION, TACTICAL REALISM OR ORGANIZED GAMING COMMUNITY THAT OPERATES WITHIN ARMA III</label>

                                        <label><input type="radio" name="agreement_dualclan" value="1" {{$app->getApplication()->agreement_dualclan == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_dualclan" value="0" {{$app->getApplication()->agreement_dualclan == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                <div data-field-span="1">
                                    <label>I AGREE TO BE BOUND BY THE TASK FORCE EVEREST'S UNIFORM CODE OF MILITARY JUSTICE COMMENCING AT THE TIME OF MY SUBMISSION OF THIS APPLICATION FORM UNTIL I RECEIVE MY DD-214 FROM THE S1 DEPARTMENT OF TASK FORCE EVEREST</label>
                                    <label><input type="radio" name="agreement_ucmj" value="1" {{$app->getApplication()->agreement_ucmj == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_ucmj" value="0" {{$app->getApplication()->agreement_ucmj == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="pull-right">
                            @if($app->status == 1)
                                <a href="{{route('admin.applications.decline',$app->id)}}" class="btn btn-danger">Decline Applicant</a>
                                <a href="{{route('admin.applications.accept',$app->id)}}" class="btn btn-success">Accept Applicant</a>
                            @else
                                This application has already been processed.
                            @endif
                        </div><!--pull-right-->
                    </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/gridforms/gridforms.js"></script>
@stop