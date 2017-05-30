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
                                <input type="text" name="first_name" readonly value="{{$app->getApplication()->first_name}}" required>
                            </div>
                            <div data-field-span="1">
                                <label>LAST NAME</label>
                                <input type="text" name="last_name" readonly  value="{{$app->getApplication()->last_name}}" required>
                            </div>
                            <div data-field-span="2">
                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                <input type="text" name="steam_id" readonly value="{{$app->getApplication()->steam_id or ''}}">
                            </div>
                        </div>
                        <div data-row-span="3">
                            <div data-field-span="1">
                                <label>DATE OF BIRTH</label>
                                <input type="text" id="dob" name="dob" readonly value="{{$app->getApplication()->dob}}" placeholder="MM/DD/YYYY">
                            </div>
                            <div data-field-span="2">
                                <label>Nationality</label>
                                <input type="text" name="nationality" readonly value="{{$app->getApplication()->nationality}}">
                            </div>
                        </div>
                        <div data-row-span="4">
                            <div data-field-span="4" data-field-error="Please enter a valid email address">
                                <label>E-mail</label>
                                <input type="email" name="email" readonly value="{{$app->getApplication()->email or ''}}">
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
                                    <label><input type="radio" name="prior_experience" value="1" {{$app->getApplication()->prior_experience == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="prior_experience" value="0" {{$app->getApplication()->prior_experience == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                <div data-field-span="1">
                                    <label>HAVE YOU BEEN DISHONORABLY DISCHARGED/REMOVED FROM A UNIT</label>
                                    <label><input type="radio" name="dishonorable_discharge" value="1" {{$app->getApplication()->dishonorable_discharge == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="dishonorable_discharge" value="0" {{$app->getApplication()->dishonorable_discharge == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                            </div>
                            <div data-row-span="1">
                                <div data-field-span="1">
                                    <label>REASONING FOR JOINING THE 1ST RRF</label>
                                    <textarea name="reason_for_joining" rows="3" placeholder="">{{$app->getApplication()->reason_for_joining}}</textarea>
                                </div>
                            </div>
                        </fieldset>


                        <div data-row-span="1">
                            <div data-field-span="1">
                                <label>WHAT GROUPS HAVE YOU BEEN A PART OF:</label>
                                <input type="text" name="prior_groups" value="{{$app->getApplication()->prior_groups}}" placeholder="LEAVE THE REST OF THIS SECTION BLANK, IF NOT APPLICABLE">
                            </div>
                        </div>
                        <div data-row-span="2">
                            <div data-field-span="1">
                                <label>HIGHEST RANK ATTAINED</label>
                                <input type="text" name="highest_rank" value="{{$app->getApplication()->highest_rank}}" placeholder="">
                            </div>
                            <div data-field-span="1">
                                <label>RELEVANT TRAINING:</label>
                                <input type="text" name="relevant_training" value="{{$app->getApplication()->relevant_training}}" placeholder="">
                            </div>
                        </div>
                        <div data-row-span="1">
                            <div data-field-span="1">
                                <label>REASON FOR DEPARTURE FROM PREVIOUS UNIT</label>
                                <input type="text" name="departure_reason" value="{{$app->getApplication()->departure_reason}}" placeholder="">
                            </div>
                        </div>
                        <br>
                        <fieldset>
                            <legend>AGREEMENTS</legend>
                            <div data-row-span="2">
                                <div data-field-span="1">
                                    <label>I UNDERSTAND THAT I AM JOINING A MILITARY SIMULATION UNIT</label>
                                    <label><input type="radio" name="agreement_milsim" value="1" {{$app->getApplication()->dishonorable_discharge == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_milsim" value="0" {{$app->getApplication()->dishonorable_discharge == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                @if(isset($app->getApplication()->agreement_guidelines))
                                <div data-field-span="1">
                                    <label>I UNDERSTAND THAT BY SUBMITTING THIS FORM, IT WILL IN EFFECT CHANGE MY STATUS AS A CIVILIAN TO A MEMBER OF THE 1ST RRF AND WILL BE HELD TO UNIT GUIDELINES</label>
                                    <label><input type="radio" name="agreement_guidelines" value="1" {{$app->getApplication()->agreement_guidelines == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_guidelines" value="0" {{$app->getApplication()->agreement_guidelines == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                @endif
                            </div>
                            <div data-row-span="2">
                                <div data-field-span="1">
                                    <label>I UNDERSTAND THAT I AM EXPECTED TO FOLLOW ORDERS GIVEN TO ME</label>
                                    <label><input type="radio" name="agreement_orders" value="1" {{$app->getApplication()->agreement_orders == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_orders" value="0" {{$app->getApplication()->agreement_orders == 0 ? 'checked' : ''}}> NO</label> &nbsp;
                                </div>
                                <div data-field-span="1">
                                    <label>I UNDERSTAND THAT I AM EXPECTED TO RESPECT RANKS, CUSTOMS AND COURTESIES</label>
                                    <label><input type="radio" name="agreement_ranks" value="1" {{$app->getApplication()->agreement_ranks == 1 ? 'checked' : ''}}> YES</label> &nbsp;
                                    <label><input type="radio" name="agreement_ranks" value="0" {{$app->getApplication()->agreement_ranks == 0 ? 'checked' : ''}}> NO</label> &nbsp;
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