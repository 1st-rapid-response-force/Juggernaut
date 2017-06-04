@extends('frontend.templates.master')

@section('title','My Inbox')

@section('content')
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="#">{{\Auth::User()->member}}</a></li>
                    <li class="active">My Inbox</li>
                </ol>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
            <div class="container">
                <div class="widget margin-bottom-35">
                    {{ Form::open(['route' => ['inbox.search'], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) }}
                    <div class="btn-inline">
                        <input type="text" name="search" class="form-control padding-right-40"  placeholder="Search Subject">
                        <button type="submit" class="btn btn-link color-grey-700 padding-top-10"><i class="fa fa-search"></i></button>
                    </div>
                    {{ Form::close() }}

                    <div class="text-center">
                        <p><a href="{{route('inbox')}}">Go back to inbox (remove search filter)</a></p>
                    </div>
                </div>
                <br>
                <form action="{{route('inbox.removeThreads')}}" method="post">
                    {{csrf_field()}}
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    <div class="btn-group">
                        <a href="{{route('inbox.create')}}" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o "></i></a>
                        <button class="btn btn-default btn-sm" type="submit"><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                </div>

                    <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tr>
                            <td></td>
                            <td class="mailbox-name">Creator</td>
                            <td class="mailbox-subject">Subject</td>
                            <td class="mailbox-date">Last Response</td>
                        </tr>
                        <tbody>
                        @if($threads->count() > 0)
                            @foreach($threads as $thread)
                                <tr class="{{($thread->isUnread($user->id) == true) ? 'info' : ''}}">
                                    <td><input type="checkbox" name="delete[{{$thread->id}}]" value="{{$thread->id}}"/></td>
                                    <td class="mailbox-name"><img class="img-circle" style="max-height: 30px; max-width: 30px;" src="{{$thread->creator()->member->avatar}}">  <a href="{{route('inbox.show',$thread->id)}}">{{$thread->creator()->member}}</a></td>
                                    <td class="mailbox-subject">{{$thread->subject}}</td>
                                    <td class="mailbox-date">{{$thread->latestMessage->user->member}}<br> {{$thread->latestMessage->updated_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="mailbox-name">No Messages Found</td>
                            </tr>
                        @endif
                        </tbody>

                    </table><!-- /.table -->
                    </form>
                    <div class="text-center">
                        {!! $threads->render() !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->

@endsection
