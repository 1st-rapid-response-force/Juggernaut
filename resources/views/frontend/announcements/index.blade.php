@extends('frontend.templates.master')

@section('title','Our Mission')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Announcements</li>
                </ol>
            </div>
        </section>

        <section class="bg-grey-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">



                        @foreach($announcements as $announcement)
                            <div class="panel panel-default panel-post">
                                <div class="panel-body">
                                    <div class="post">
                                        <div class="post-header post-author">
                                            <a href="{{route('frontend.files.file',$announcement->user->member->id)}}" class="author" data-toggle="tooltip" title="{{$announcement->user->member}}"><img src="{{$announcement->user->member->avatar}}" alt=""></a>
                                            <div class="post-title">
                                                <h3><a href="{{route('frontend.announcements.show',$announcement->id)}}">{{$announcement->subject}}</a></h3>
                                                <ul class="post-meta">
                                                    <li><a href="{{route('frontend.files.file',$announcement->user->member->id)}}"><i class="fa fa-user"></i> {{$announcement->user->member}}</a></li>
                                                    <li><i class="fa fa-calendar-o"></i> {{$announcement->created_at->toFormattedDateString()}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        {!! str_limit($announcement->message,100) !!}
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <ul class="post-action">
                                        <li><a href="{{route('frontend.announcements.show',$announcement->id)}}"><i class="fa fa-book"></i> Read more</a></li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach


                        <div class="text-center">
                            {!! $announcements->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>




@endsection