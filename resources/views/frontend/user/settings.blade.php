@extends('frontend.templates.master')

@section('title','Settings')

@section('content')
    <!-- wrapper -->
    <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('frontend.files.my-file')}}">{{\Auth::User()->member}}</a></li>
                <li class="active">Settings</li>
            </ol>
        </div>
    </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Settings</h2>
                                </div>
                            </div>
                            {{ Form::open(['route' => 'frontend.settings.post', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                                <!-- Form would go here -->
                                <div class="form-group">
                                    {{ Form::label('first_name', ' Name', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-5">
                                        {{ Form::text('first_name', Auth::User()->first_name, ['class' => 'form-control', 'placeholder' => 'First Name','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                    <div class="col-lg-5">
                                        {{ Form::text('last_name', Auth::User()->last_name, ['class' => 'form-control', 'placeholder' => 'Last Name','required' => 'required']) }}
                                    </div><!--col-lg-5-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('email', ' Email', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::email('email', Auth::User()->email, ['class' => 'form-control', 'placeholder' => 'Email','required' => 'required']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('steam_id', ' Steam ID', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::text('steam_id', Auth::User()->steam_id, ['class' => 'form-control', 'placeholder' => 'Email','required' => 'required', 'disabled']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('squad_xml', ' SquadXML URL', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::text('squad_xml', url('/squadxml/team-'.Auth::User()->member->team->id.'.xml'), ['class' => 'form-control', 'placeholder' => 'Email','required' => 'required', 'disabled']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('timezone', 'Timezone', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::selectTimezone('timezone', Auth::User()->timezone, ['class' => 'form-control']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('biography', ' Biography', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::textarea('bio', Auth::User()->member->bio, ['class' => 'form-control', 'placeholder' => 'Biography - this will be shown in team member list']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group">
                                    {{ Form::label('signature', 'Signature', ['class' => 'col-lg-2 control-label']) }}

                                    <div class="col-lg-10">
                                        {{ Form::textarea('signature', Auth::User()->signature, ['class' => 'form-control', 'placeholder' => 'Signature is attached to all messages.']) }}
                                    </div><!--col-lg-10-->
                                </div><!--form control-->

                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            {{ Form::close() }}
                            <hr>
                            <div class="row">
                                @if(\Auth::User()->admin)
                                    <h3>Personal Access Tokens</h3> <br>
                                    <div id="vue">
                                        <passport-personal-access-tokens></passport-personal-access-tokens>
                                        <br><small>This is only viewable to administrators</small>
                                    </div>
                                    <hr>
                                @endif
                                <h3>Other</h3> <br>
                                <div class="col-lg-6">
                                    <a href="{{route('frontend.settings.teamspeak')}}" class="btn btn-primary btn-block">Manage Teamspeak</a>
                                </div>


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
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'signature', {
                height: 300
            });
        });
    </script>
@endsection