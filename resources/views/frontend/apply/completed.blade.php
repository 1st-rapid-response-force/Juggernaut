@extends('frontend.templates.master')

@section('title','Application')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.apply')}}">Apply</a></li>
                    <li class="active">Completed Application</li>
                </ol>
            </div>
        </section>
        <section class="padding-top-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Application for the 1st Rapid Response Force</a></h2>
                                </div>
                            </div>

                            <p>Thank you for applying to the 1st Rapid Response Force. We review all applications in bulk on Saturday. Please get in touch with any officer ranked member for an quick interview. Our system will email you once we make a decision on your application.</p>

                            <p>While you wait for us to process your application why not:</p>
                            <ul>
                                <li>Hop onto <a href="ts3server://ts.1st-rrf.com?port=9987&addbookmark=1st Rapid Response Force">Teamspeak Server</a> and get to know everyone</li>
                                <li>Sign up to the <a href="http://steamcommunity.com/groups/1st-rrf">1st RRF Steam group</a> and get notifications when the public server is running an organized event.</li>
                                <li><a href="steam://url/CommunityFilePage/928980735"><strong>Download the Modpack (You will need to Friend Striker, A, to be able to access this.)</strong></a>.</li>
                                <li>Play on the Public Server and Check out the training server.</li>
                            </ul>
                            <p>See you on the Battlefield.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


