@extends('frontend.templates.master')

@section('title','Request a Discharge')

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
                                    <h2><a href="#">Request a Discharge</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.discharge.post')}}">
                                    {!! csrf_field() !!}
                                    <input type="hidden" value="discharge" name="type">
                                    <div class="text-center"><legend><strong>DISCHARGE PAPERWORK</strong><br> TASK FORCE EVEREST<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> TFE-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to document a discharge/separation from the Task Force Everest.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Internal File.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; however, failure to furnish proper information may negate the proper discharge and can lead to punitive action.</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{\Auth::User()->last_name.', '.\Auth::User()->first_name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
                                                <input type="text" name="rank" readonly value="{{\Auth::User()->member->rank->name}}">
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
                                                <input type="text" name="organization" readonly value="Task Force Everest">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. DISCHARGE</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>REASON FOR DISCHARGE</label>
                                                <textarea name="discharge_text" rows="15"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>C. PROCESSING PARTY</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>DISCHARGE TYPE</label>
                                                <input type="text" readonly name="discharge_type" value="PENDING REVIEW">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" readonly name="discharger_name" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>GRADE</label>
                                                <input type="text" readonly name="discharger_grade" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="2">
                                            <div data-field-span="2">
                                                <label>ORGANIZATION</label>
                                                <input type="text" readonly name="discharger_organization" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>SIGNATURE</label>
                                                <input type="text" name="discharger_signature" readonly value="">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                    <p>The only section you need to fillout is the reason for discharge section. Once you submit this form and it is processed, you will be notified via email and your permissions and rank will be removed.</p>
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