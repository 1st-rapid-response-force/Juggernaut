@extends('frontend.templates.master')

@section('title','Change Request')

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
                                    <h2><a href="#">Request a Change Form</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.change-request.post')}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>CHANGE REQUEST FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to request/recommend changes for website, training, and operational environments</p>
                                    <p><strong>ROUTINE USE(S): </strong> Used by Squad Leaders and above .</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{\Auth::User()->last_name.', '.\Auth::User()->first_name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
                                                <input type="text" name="grade" readonly value="{{\Auth::User()->member->rank->name}}">
                                            </div>

                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>TEAM</label>
                                                <input type="text" name="team" readonly value="{{\Auth::User()->member->team->name}}">
                                            </div>

                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input type="text" name="military_id" readonly value="{{\Auth::User()->steam_id}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>CURRENT DATE</label>
                                                <input type="text" id="date" name="date" placeholder="01/01/2000" readonly value="{{\Carbon\Carbon::now()->toDateString()}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>ORGANIZATION</label>
                                                <input type="text" name="organization" readonly value="1st Rapid Response Force">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. CHANGE SECTION</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Desired Change</label>
                                                <textarea name="desired_change" rows="5" placeholder=""></textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Desired Change</label>
                                                <textarea name="justification" rows="5" placeholder="Why do you need this capability, facility, etc.; must tie to our unit structure, policies, and doctrine; changes or additions to doctrine or policy must include effects to existing processes, capabilites"></textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Requested Priority</label>
                                                <label><input type="radio" name="priority" value="Immediate">
                                                    <a href="#" data-toggle="tooltip" title="(Resolution target is 24 hours)  Lack of critical capability that prevents mission accomplishment or training objective">Immediate</a>
                                                </label> &nbsp;
                                                <label><input type="radio" name="priority" value="Priority">
                                                    <a href="#" data-toggle="tooltip" title="(Resolution target is 48-72 hours)  Lack of capability that has potential future impact on operations, or lack of capability puts unnecessary stress on leaders to accomplish missions and training">Priority</a>
                                                </label> &nbsp;
                                                <label><input type="radio" name="priority" value="Routine">
                                                    <a href="#" data-toggle="tooltip" title="(Resolution target is greater than 72 hours)  Lack of capability that has limited short term effects on operations or training, but may enhance overall unit capability and provide support to existing processes/training/mission">Routine</a>
                                                </label> &nbsp;
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                    <hr>
                                    <div class="pull-right">
                                        {{ Form::submit('Sign and Submit', ['class' => 'btn btn-success']) }}
                                    </div><!--pull-right-->
                                    <div class="clearfix"></div>
                                </form>
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