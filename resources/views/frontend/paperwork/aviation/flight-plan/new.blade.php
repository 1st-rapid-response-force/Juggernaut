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
                                    <h2><a href="#">File Flight Plan</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.aviation.flight-plan.post')}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>FLIGHT PLAN FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
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
                                                <input type="text" id="date" name="date" placeholder="01/01/2000" readonly value="{{\Carbon\Carbon::now()->toDateString()}}">
                                            </div>
                                            <div data-field-span="2">
                                                <label>Aircraft Callsign</label>
                                                <input type="text" name="name" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>Departure Point</label>
                                                <input type="text" name="departure_point" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Aircraft Type</label>
                                                <input type="text" name="aircraft_type" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="1">
                                                <label>Departure Time Proposed (Z)</label>
                                                <input type="text" name="departure_proposed_time" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Departure Time Actual (Z)</label>
                                                <input type="text" name="departure_actual_time" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Cruising Altitude</label>
                                                <input type="text" name="cruising_altitude" value="">
                                            </div>
                                        </div>


                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. FLIGHT PLAN</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <label>Altitude</label>
                                                <input type="text" name="flight[0][altitude]" placeholder="750m">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Airspeed</label>
                                                <input type="text" name="flight[0][speed]" value="" placeholder="280km/h">
                                            </div>
                                            <div data-field-span="2">
                                                <label>Route of Flight</label>
                                                <input type="text" name="flight[0][route]" value="" placeholder="10491042">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[1][altitude]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[1][speed]" value="">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[1][route]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[2][altitude]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[2][speed]" value="">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[2][route]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[3][altitude]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[3][speed]" value="">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[3][route]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[4][altitude]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[4][speed]" value="">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[4][route]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="1">
                                                <input type="text" name="flight[5][altitude]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="flight[5][speed]" value="">
                                            </div>
                                            <div data-field-span="2">
                                                <input type="text" name="flight[5][route]" value="">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>C. MISC</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Remarks</label>
                                                <textarea name="remarks" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <legend>D. CREW</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <label>Name</label>
                                                <input type="text" name="crew[0][name]" placeholder="PILOT IN COMMAND">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Rank</label>
                                                <input type="text" name="crew[0][rank]" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <label>Position</label>
                                                <input type="text" name="crew[0][position]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" name="crew[1][name]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[1][rank]" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[1][position]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" name="crew[2][name]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[2][rank]" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[2][position]" value="">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="2">
                                                <input type="text" name="crew[3][name]">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[3][rank]" value="">
                                            </div>
                                            <div data-field-span="1">
                                                <input type="text" name="crew[3][position]" value="">
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