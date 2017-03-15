@extends('frontend.templates.master')

@section('title','Program Completion')

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
                                    <h2><a href="#">File Program Completion Form</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.team.leader.training.program-completion.post',[$team->id,$member->id])}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>PROGRAM COMPLETION FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to credit members for the completion of a training program.</p>
                                    <p><strong>ROUTINE USE(S): </strong> Credit for program completion, stored on member file.</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$member->user->last_name.', '.$member->user->first_name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
                                                <input type="text" name="grade" readonly value="{{$member->rank->name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input type="text" name="military_id" readonly value="{{$member->user->steam_id}}">
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
                                        <legend>B. PROGRAM</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="2">
                                                <label>PROGRAM NAME</label>
                                                <input type="text" name="program" readonly value="{{$member->program->name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <label>INSTRUCTOR</label>
                                                <input type="text" name="instructor" readonly value="{{\Auth::User()->last_name.', '.\Auth::User()->first_name}}">
                                            </div>
                                            <div data-field-span="2">
                                                <label>INSTRUCTOR</label>
                                                <input type="text" name="instructor_rank" readonly value="{{\Auth::User()->member->rank->name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>REMARKS</label>
                                                <textarea name="program_remarks" rows="15" placeholder=""></textarea>
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