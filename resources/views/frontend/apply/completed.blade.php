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
                                    <h2><a href="#">Application for the 1st Rapid Response Force</a></h2>
                                </div>
                            </div>

                            <p>Thank you for applying to the 1st Rapid Response Force. We will review your application and get back to you soon. Our system will email once we make a decision on your application.</p>
                            @if(\Auth::User()->application->interview_required)
                                <div class="alert alert-warning">
                                    <p><strong>NOTICE: </strong> You have applied for a specialized role - In order for us to make a decision on your application you will need to speak with your assigned interviewer: <strong>{{\Auth::User()->application->interviewer->member->searchable_name}}</strong></p>
                                </div>

                            @endif

                            <p>While you wait for us to process your application why not:</p>
                            <ul>
                                <li>Download the <a href="/modpack">modpack via Infil</a></li>
                                <li>Hop onto <a href="ts3server://ts.1st-rrf.com?port=9987&addbookmark=1st Rapid Response Force">Teamspeak Server</a> and get to know everyone</li>
                                @if(\Auth::User()->application->interview_required)
                                <li>Complete your interview on the Teamspeak</li>
                                @endif
                                <li>Sign up to the <a href="http://steamcommunity.com/groups/1st-rrf">1st RRF Steam group</a> and get notifications when the public server is running an organized event.</li>
                            </ul>
                            <p>See you on the Battlefield.</p>
                            <div class="text-center">
                                <h3>The First Graduating Class of the 1st RRF</h3>
                                <img src="https://i.imgur.com/HG3fYPW.jpg" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


