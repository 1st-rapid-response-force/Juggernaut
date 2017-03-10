@extends('frontend.templates.master')

@section('title','Application')

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
                                    <h2><a href="#">Report Bad Conduct</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.bad-conduct')}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>BAD CONDUCT REPORT FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to report conduct infractions within the unit.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form is used to report conduct which will be reviewed by the Commanding Officer.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; information is internally used and can only be viewed by Unit Commander</p>
                                    <p><strong>INFO: </strong> Upon submitting this form and investigation will be conducted regarding the infraction. You may be contacted for more information regarding this case, however your report or name will never be disclosed to the violating party. This form will not be attached to your file.</p>
                                    <fieldset>
                                        <legend>A. INFRACTION REPORT</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>VIOLATOR NAME:</label>
                                                <select name="violator_name">
                                                    @foreach(\App\Models\Unit\Member::all() as $file)
                                                        <option value="{{$file}}">{{$file}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>SUMMARY OF INTERACTION</label>
                                                <textarea name="violation_summary" rows="15"></textarea>
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