@extends('frontend.templates.master')

@section('title','Application')

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
                                    <h2><a href="#">Training Completion Report</a></h2>
                                </div>
                            </div>
                            <div class="well">
                                <div class="text-center"><legend><strong>TRAINING COMPLETION FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                <div class="text-center"><h5>PRIVACY ACT STATEMENT</h5></div>
                                <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to record the completion of a class within the 1st Rapid Response Force.</p>
                                <p><strong>ROUTINE USE(S): </strong> This form is used by Catalyst to credit users who attend a class.</p>
                                <p><strong>DISCLOSURE: </strong> Mandatory; All classes that are created must be completed or a cancellation form must be filed for investigation.</p>
                                <hr>
                                    {{ Form::open(['role' => 'form', 'method' => 'post']) }}
                                        <div class="form-group">
                                            <strong>Attendees: </strong>
                                            @if(count($paperwork->attendees()) > 0)
                                                @foreach($paperwork->attendees() as $att)
                                                    <li>{{$att->vpf}}</li>
                                                @endforeach
                                            @else
                                                <li>No Attendees</li>
                                            @endif
                                            <strong>Observers: </strong>
                                            @if(count($paperwork->observers()) > 0)
                                                @foreach($paperwork->observers() as $obs)
                                                    <li>{{$obs->vpf}}</li>
                                                @endforeach
                                            @else
                                                <li>No Observers</li>
                                            @endif
                                            <strong>Class Co-Instructors or Helpers: </strong>
                                            @if(count($paperwork->helpers()) > 0)
                                                @foreach($helpers as $help)
                                                    <li>{{$help->vpf}}</li>
                                                @endforeach
                                            @else
                                                <li>No Co-Instructors or Helpers</li>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="comments">Comments/Concerns</label>
                                            <textarea class="form-control" name="comments" rows="15" readonly placeholder="Do you have any general comments about this class session, or general concerns about this class in general">{{$paperwork->getForm()->comments}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="rewards">Rewards/Recogniztion</label>
                                            <textarea class="form-control" name="rewards" rows="15" readonly placeholder="Do you wish to recognize a class participants?">{{$paperwork->getForm()->rewards}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="comments">Issues/Negative Conduct</label>
                                            <textarea class="form-control" name="issues" rows="15" readonly placeholder="Where there any issues with the class, or issues with a class participant (note it here)">{{$paperwork->getForm()->issues}}</textarea>
                                        </div>

                                <div class="clearfix"></div>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


