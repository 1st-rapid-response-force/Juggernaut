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
            <p>{!! $event->body !!}</p>

        </div>
        <div class="timeline-footer">
            <i class="fa fa-calendar-o"></i> {{$event->date->toFormattedDateString()}}
</div>
</div>
</li>