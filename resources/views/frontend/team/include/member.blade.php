<div class="media">
    <div class="media-left">
        <a href="#">
            <img class="media-object img-circle" src="{{$member->avatar}}" alt="{{$member}}">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('frontend.files.file',$member->id)}}">{{$member}}</a></h4>
        <strong>{{$member->assignment->name or ''}}</strong><br>
        @if($member->hasReportedIn())
            <span class="label label-success">Reported in</span>
        @else
            <span class="label label-danger">Pending Report in</span>
        @endif

        @if($member->onLOA())
            {!! $member->getLOAStatus() !!}
        @endif

        @if($member->reserve)
            <span class="label label-info">Reserve</span>
        @endif
        <br>
        {{$member->bio}}
    </div>
</div>