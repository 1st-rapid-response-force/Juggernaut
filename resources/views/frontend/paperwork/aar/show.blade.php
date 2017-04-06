@extends('frontend.templates.master')

@section('title','After Action Report')

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
                                    <h2><a href="#">After Action Report - {{$form->getPaperwork()->date}} - #RRF-AAR-{{$form->id}}</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>AFTER ACTION REPORT FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p>{!! $form->getStatus() !!}</p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to record and reflect on operations and training events.</p>
                                    <p><strong>ROUTINE USE(S): </strong> Credit for operation/training completion, stored on team file.</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$form->getPaperwork()->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
                                                <input type="text" name="grade" readonly value="{{$form->getPaperwork()->grade}}">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input type="text" name="military_id" readonly value="{{$form->getPaperwork()->military_id}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>CURRENT DATE</label>
                                                <input type="text" id="date" name="date" placeholder="01/01/2000" readonly value="{{$form->getPaperwork()->date}}">
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
                                        <legend>B. REPORT</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>EVENT NAME</label>
                                                <input type="text" name="event_name" readonly value="{{$form->getPaperwork()->event_name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>ATTENDEES</label>
                                                <textarea name="event_attendees" rows="5" placeholder="Who attended this event?">{{$form->getPaperwork()->event_attendees}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>PROS</label>
                                                <textarea name="event_pros" rows="6" placeholder="">{{$form->getPaperwork()->event_pros}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>CONS</label>
                                                <textarea name="event_cons" rows="6" placeholder="">{{$form->getPaperwork()->event_cons}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>OTHER REMARKS</label>
                                                <textarea name="event_remarks" rows="6" placeholder="">{{$form->getPaperwork()->event_remarks}}</textarea>
                                            </div>
                                        </div>


                                    </fieldset>
                                    <br><br>
                                    <hr>
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