@extends('frontend.templates.master')

@section('title','Leave')

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
                                    <h2><a href="#">Leave of Absence - {{$form->getPaperwork()->date}} - #RRF-LOA-{{$form->id}}</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>LEAVE OF ABSENCE FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p>{!! $form->getStatus() !!}</p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to report leave from the unit.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form is used to formally request leave.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; information distributed to all relevant leadership to inform of formal leave</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$form->getPaperwork()->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
                                                <input type="text" name="rank" readonly value="{{$form->getPaperwork()->rank}}">
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
                                    <fieldset>
                                        <legend>B. LEAVE REQUEST</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <label>START DATE</label>
                                                <input type="text" name="start_date" placeholder="YYYY-MM-DD" readonly value="{{$form->getPaperwork()->start_date}}">
                                            </div>
                                            <div data-field-span="2">
                                                <label>END DATE</label>
                                                <input type="text" name="end_date" placeholder="YYYY-MM-DD" readonly value="{{$form->getPaperwork()->end_date}}">
                                            </div>
                                        </div>

                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>REASON FOR LEAVE</label>
                                                <textarea name="leave_reason" rows="15" placeholder="">{{$form->getPaperwork()->leave_reason}}</textarea>
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