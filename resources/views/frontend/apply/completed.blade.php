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
                                    <h2><a href="#">Application for the TF Everest</a></h2>
                                </div>
                            </div>

                            <p>Thank you for applying to the Task Force Everest. We review all applications in bulk on Saturday. Please get in touch with any officer ranked member for an quick interview. Our system will email you once we make a decision on your application.</p>

                            <p>While you wait for us to process your application why not:</p>
                            <ul>
                                <li>Hop onto <a href="ts3server://ts.tf-everest.com?port=9987&addbookmark=TFE">Teamspeak Server</a> and get to know everyone</li>
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


