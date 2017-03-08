<li>
    <div class="timeline-badge primary"></div>
    <div class="timeline-panel">
        <div class="timeline-heading">
            <h4><a href="#"><i class="{{$event->EventType()}}"></i> {{$event->name}}</a></h4>
            @if($event->hasPhoto())
            <img class="full-width" src="{{$event->getMedia('images')->first()->getURL()}}" alt="" />
            @endif
        </div>
        <div class="timeline-body">
            <p>{{$event->body}}</p>

        </div>
        <div class="timeline-footer">
            <i class="fa fa-calendar-o"></i> {{$event->date->toFormattedDateString()}} |
            @if((!Auth::guest()) && (($team->leader_id == Auth::User()->id) || Auth::User()->admin))
                <a href="{{ route('frontend.team.leader.delete-timeline-event',[$team->id,$event->id]) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?" >Delete</a>
            @endif
</div>
</div>
</li>