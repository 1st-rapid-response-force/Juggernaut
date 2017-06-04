@extends('frontend.templates.master')

@section('title','Negative Counseling Statement')

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
                                    <h2><a href="#">File a Negative Counseling Statement</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.disciplinary.ncs.post',$member->id)}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>NEGATIVE COUNSELING STATEMENT</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong>  To correct the negative actions or behavior of their subordinates. The main requirement of the NCS is the verbal counseling of the soldier by their superior, in which the behavior is addressed and corrected. Superiors will cover the issue, any disciplinary action that will be taken and consequences of future recurrence.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Master File and Field Personnel File.</p>
                                    <p><strong>DISCLOSURE: </strong> Not Applicable, filled out by Chain of Command</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$member}}">
                                            </div>
                                            <div data-field-span="4">
                                                <label>GRADE</label>
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
                                        <legend>B. INFRACTION</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>COUNSELOR</label>
                                                <input type="text" name="counselor_name"  value="{{\Auth::User()->member->searchable_name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>MISCONDUCT SUMMARY</label>
                                                <textarea name="summary_infraction" rows="15" ></textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Plan of Action</label>
                                                <textarea name="action_plan" rows="8" ></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                   <hr>
                                    <p>Upon submission, the NCS will become a part a members file. File this form only if an NCS has been prescribed as per the <a href="https://documentation.1st-rrf.com/about_the_unit/disciplinary_policy.html">Disciplinary Policy</a>.</p>
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