@extends('frontend.templates.master')

@section('title',$announcement->subject)

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.announcements')}}">Announcements</a> </li>
                    <li class="active">{{$announcement->subject}}</li>
                </ol>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
            <div class="container">
                <div class="row sidebar">
                    <div class="col-md-9 leftside">
                        <div class="post post-single">
                            <div class="post-header post-author">
                                <a href="#" class="author" data-toggle="tooltip"  title="{{$announcement->user->member}}"><img src="{{$announcement->user->member->avatar}}" alt="" /></a>
                                <div class="post-title">
                                    <h2><a href="#">{{$announcement->subject}}</a></h2>
                                    <ul class="post-meta">
                                        <li><a href="#"><i class="fa fa-user"></i> {{$announcement->user->member}}</a></li>
                                        <li><i class="fa fa-calendar-o"></i> {{$announcement->created_at->toFormattedDateString()}}</li>
                                    </ul>
                                </div>
                            </div>

                            {!! $announcement->message !!}
                        </div>
                    </div>

                    <div class="col-md-3 rightside">
                        <div class="widget widget-list">
                            <div class="title">Recent Announcements</div>
                            <ul>
                                @foreach(\App\Models\Unit\Announcement::orderBy('created_at','desc')->take(5)->get() as $announcementSide)
                                    <li>
                                        <div class="widget-list-meta">
                                            <h4 class="widget-list-title"><a href="{{route('frontend.announcements.show',$announcementSide->id)}}">{{$announcementSide->subject}}</a></h4>
                                            <p><i class="fa fa-clock-o"></i> {{$announcementSide->created_at->toFormattedDateString()}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </section>



@endsection