@extends('frontend.templates.master')

@section('title','Home')

@section('content')


    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">{{$team->name}}</a></div>
                    <p>{{$team->motto}}</p>
                    <p><img src="{{$team->team_image}}" class="center-block"></p>
                    <br>
                </div>
            </div>
        </section>

        @include('frontend.team.include.nav')
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.team',$team->id)}}">{{$team->name}}</a></li>
                    <li class="active"><a href="{{route('frontend.team.leader',$team->id)}}">Leader Panel</a></li>
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
                                    <h2>Leader Panel</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3>Content</h3>
                                    <br>

                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#newTimelineEvent" {{$team->isTeamLeader(\Auth::User()) ? 'disabled' : '' }}>
                                        New Timeline Event
                                    </button>

                                    <a href="{{route('frontend.team.leader.add-video',$team->id)}}" class="btn btn-primary btn-block"  {{$team->isTeamLeader(\Auth::User()) ? 'disabled' : '' }}>New Video</a>

                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#uploadHeaderImage"  {{$team->isTeamLeader(\Auth::User()) ? 'disabled' : '' }}>
                                        Upload Team Header
                                    </button>
                                </div>
                                <div class="col-lg-6">
                                    <h3>Team</h3>
                                    <br>
                                    <a href="{{route('frontend.team.leader.positions',$team->id)}}" class="btn btn-primary btn-block"  {{$team->isTeamLeader(\Auth::User()) ? 'disabled' : '' }}>Position Management</a>
                                    <a href="{{route('frontend.team.leader.training',$team->id)}}" class="btn btn-primary btn-block">Training Management</a>
                                    <a href="{{route('frontend.team.leader.aar.team',$team->id)}}" class="btn btn-primary btn-block">After Action Reports</a>
                                    <a href="{{route('frontend.paperwork.change-request')}}" class="btn btn-primary btn-block" {{$team->isTeamLeader(\Auth::User()) ? 'disabled' : '' }}>Unit/Site Change Request Form</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

    <!-- uploadHeaderImage -->
    <div class="modal fade" id="newTimelineEvent" tabindex="-1" role="dialog" aria-labelledby="newTimelineEventLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Timeline Event</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => ['frontend.team.leader.new-timeline-event',$team->id], 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                    <!-- Form would go here -->
                        <div class="form-group">
                            {{ Form::label('name', 'Title:', ['class' => 'control-label']) }}

                            {{ Form::text('name', null, ['class' => 'form-control','required' => 'required']) }}
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('date', 'Date:', ['class' => 'control-label']) }}

                            {{ Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD' ,'required' => 'required']) }}
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('type', 'Event Type:', ['class' => 'control-label']) }}

                            {{ Form::select('type', ['new-member' => 'New Member', 'member-left' => 'Member Left', 'star' => 'Star', 'newspaper'  => 'News' ], null, ['class' => 'form-control','required' => 'required']) }}
                        </div><!--form control-->


                        <div class="form-group">
                            {{ Form::label('timeline_image', 'Event Image (optional)', ['class' => 'control-label']) }}

                                {{ Form::file('timeline_image', null, ['class' => 'form-control']) }}
                        </div><!--form control-->

                        <div class="form-group">
                            {{ Form::label('body', 'Short Description:', ['class' => 'control-label']) }}

                            {{ Form::textarea('body', null, ['class' => 'form-control','required' => 'required']) }}
                        </div><!--form control-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- uploadHeaderImage -->
    <div class="modal fade" id="uploadHeaderImage" tabindex="-1" role="dialog" aria-labelledby="uploadHeaderImageLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Team Header</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(['route' => ['frontend.team.leader.update-header',$team->id], 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                <!-- Form would go here -->
                    <div class="form-group">
                        {{ Form::label('header_image', 'Team Header (image)', ['class' => 'control-label']) }}

                        {{ Form::file('header_image', null, ['class' => 'form-control','required' => 'required']) }}
                    </div><!--form control-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection