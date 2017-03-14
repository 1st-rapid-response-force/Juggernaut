@extends('frontend.templates.master')

@section('title','File Correction')

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
                                    <h2><a href="#">Request a File Correction</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.file-correction.post')}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>MEMBER FILE CORRECTION FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to report and correct issues with member file.</p>
                                    <p><strong>ROUTINE USE(S): </strong> Used by S1 to correct issues with member files.</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; however, failure to report issues with a virtual personnel file after becoming aware of an error and can lead to punitive action.</p>
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
                                        <legend>B. CORRECTION SECTION</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>CORRECTION INFORMATION</label>
                                                <textarea name="correction_summary" rows="15" placeholder="Specific exactly what is currently incorrect in your file and the correct value"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                    <p>Under unit policy all personnel files must be accurate. All VPF file corrections are viewed and processed within 48HRS per policy.</p>
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