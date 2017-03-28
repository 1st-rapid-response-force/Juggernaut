@extends ('backend.layouts.master')

@section ('title', 'Prism')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Prism - Unit Messaging Platform
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Prism</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-lg-3">
                    <h3>Participants</h3>
                    @foreach($thread->participants as $par)
                        <div class="media">
                            <div class="media-left">
                                <a href="/roster/{{$par->user->member->id}}">
                                    <img class="media-object img-circle"  src="{{$par->user->member->avatar}}" style="max-height: 40px; max-width: 40px;">
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="/roster/{{$par->user->member->id}}">{{$par->user->member}}</a></h4>
                                <p><small>Last Viewed: {{(null !== $par->last_read) ? $par->last_read->diffForHumans() : "Unread"}}</small></p>
                            </div>
                        </div>
                    @endforeach
                    <br>
                    <hr>
                </div>
                <div class="col-lg-9">
                    <h3>{!! $thread->subject !!}</h3>

                    @foreach($thread->messages as $message)
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img src="{{$message->user->member->avatar}}" alt="{!! $message->user->member !!}" style="max-width: 100px; max-height: 100px;" class="img-circle">
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>{!! $message->user->member !!}</strong></h5>
                                {!! \Crypt::decrypt($message->body) !!}
                                {!! $message->user->signature or '' !!}
                                <br>
                                @if($message->getMedia('attachments')->count())

                                    <div class="attachment">
                                        <h4>Attachment</h4>
                                        @foreach($message->getMedia('attachments') as $attachment)
                                            <a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a><br>
                                        @endforeach
                                    </div>

                                @endif


                                <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!} {{($message->created_at != $message->updated_at) ? '| Edited '.$message->updated_at->diffForHumans() : ''}}</small></div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
@stop