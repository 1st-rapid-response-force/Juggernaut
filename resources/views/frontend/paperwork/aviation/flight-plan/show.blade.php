@extends('frontend.templates.master')

@section('title','Flight Plan')

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
                                    <h2><a href="#">Flight Plan - {{$paperwork->getPaperwork()->date}} - #RRF-FL-{{$paperwork->id}}</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form">
                                    <input type="hidden" name="_method" value="PUT">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>FLIGHT PLAN FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p><span class="label label-info">ARCHIVED</span></p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> To aid in accurate identification of personnel participating in the filed flight.</p>
                                    <p><strong>ROUTINE USE(S): </strong> To provide data required to process flight plans with appropriate air traffic service authorities. A file is retained by the agency processing the flight plan.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary</p>
                                    <fieldset>
                                        <legend>A. BASIC INFORMATION</legend>
                                        <div data-row-span="3">
                                            <div data-field-span="1">
                                                <label>Date</label>
                                                <input type="text" id="date" name="date" placeholder="01/01/2000" readonly value="{{$paperwork->getPaperwork()->date}}">
                                            </div>
                                            <div data-field-span="2">
                                                <label>Aircraft Callsign</label>
                                                <input type="text" name="aircraft_callsign" readonly value="{{$paperwork->getPaperwork()->aircraft_callsign or ''}}">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>Departure Point</label>
                                                <input type="text" name="departure_point" readonly value="{{$paperwork->getPaperwork()->departure_point}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Aircraft Type</label>
                                                <input type="text" name="aircraft_type" readonly value="{{$paperwork->getPaperwork()->aircraft_type}}">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="1">
                                                <label>Departure Time Proposed (Z)</label>
                                                <input type="text" name="departure_proposed_time" readonly value="{{$paperwork->getPaperwork()->departure_proposed_time or ''}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Departure Time Actual (Z)</label>
                                                <input type="text" name="departure_actual_time" readonly value="{{$paperwork->getPaperwork()->departure_actual_time or ''}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Cruising Altitude</label>
                                                <input type="text" name="cruising_altitude" readonly value="{{$paperwork->getPaperwork()->cruising_altitude}}">
                                            </div>
                                        </div>


                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. FLIGHT PLAN</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <label>Altitude</label>
                                                <input type="text" name="flight[0][altitude]" readonly placeholder="750m" value="{{$paperwork->getPaperwork()->flight[0]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Airspeed</label>
                                                <input type="text" name="flight[0][speed]" readonly value="{{$paperwork->getPaperwork()->flight[0]->speed}}" placeholder="280km/h" >
                                            </div>
                                            <div data-field-span="2">
                                                <label>Route of Flight</label>
                                                <input type="text" name="flight[0][route]" readonly value="{{$paperwork->getPaperwork()->flight[0]->route}}" placeholder="10491042">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[1][altitude]" readonly value="{{$paperwork->getPaperwork()->flight[1]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[1][speed]" value="{{$paperwork->getPaperwork()->flight[1]->speed}}">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[1][route]" value="{{$paperwork->getPaperwork()->flight[1]->route}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[2][altitude]" readonly value="{{$paperwork->getPaperwork()->flight[2]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[2][speed]" readonly value="{{$paperwork->getPaperwork()->flight[2]->speed}}">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[2][route]" readonly value="{{$paperwork->getPaperwork()->flight[2]->route}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[3][altitude]" readonly value="{{$paperwork->getPaperwork()->flight[3]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[3][speed]" readonly value="{{$paperwork->getPaperwork()->flight[3]->speed}}">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[3][route]" readonly value="{{$paperwork->getPaperwork()->flight[3]->route}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[4][altitude]" readonly value="{{$paperwork->getPaperwork()->flight[4]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[4][speed]" readonly value="{{$paperwork->getPaperwork()->flight[4]->speed}}">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[4][route]" readonly value="{{$paperwork->getPaperwork()->flight[0]->route}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[5][altitude]" readonly value="{{$paperwork->getPaperwork()->flight[5]->altitude}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[5][speed]" readonly value="{{$paperwork->getPaperwork()->flight[5]->speed}}">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[5][route]" readonly value="{{$paperwork->getPaperwork()->flight[5]->route}}">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>C. MISC</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Remarks</label>
                                                <textarea name="remarks" readonly rows="5">{{$paperwork->getPaperwork()->remarks}}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <legend>D. CREW</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <label>Name</label>
                                                <input type="text" readonly name="crew[0][name]" placeholder="PILOT IN COMMAND" value="{{$paperwork->getPaperwork()->crew[0]->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Rank</label>
                                                <input type="text" readonly name="crew[0][rank]" value="{{$paperwork->getPaperwork()->crew[0]->rank}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Position</label>
                                                <input type="text" readonly name="crew[0][position]" value="{{$paperwork->getPaperwork()->crew[0]->position}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" readonly name="crew[1][name]" value="{{$paperwork->getPaperwork()->crew[1]->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[1][rank]" value="{{$paperwork->getPaperwork()->crew[1]->rank}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[1][position]" value="{{$paperwork->getPaperwork()->crew[1]->position}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" readonly name="crew[2][name]" value="{{$paperwork->getPaperwork()->crew[2]->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[2][rank]" value="{{$paperwork->getPaperwork()->crew[2]->rank}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[2][position]" value="{{$paperwork->getPaperwork()->crew[2]->position}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" readonly name="crew[3][name]" value="{{$paperwork->getPaperwork()->crew[3]->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[3][rank]" value="{{$paperwork->getPaperwork()->crew[3]->rank}}">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" readonly name="crew[3][position]" value="{{$paperwork->getPaperwork()->crew[3]->position}}">
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