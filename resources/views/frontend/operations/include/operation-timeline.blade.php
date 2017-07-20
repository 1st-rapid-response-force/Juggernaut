<li>
    <div class="timeline-badge primary"></div>
    <div class="timeline-panel">
        <div class="timeline-heading">
            <h4><a href="{{route('frontend.operations.show',$operation->id)}}"><i class="fa fa-fighter-jet""></i> {{$operation->name}}</a></h4>
            @if($operation->hasPhoto())
            <img class="full-width" src="{{$operation->getMedia('banner')->first()->getURL()}}" alt="" />
            @endif
        </div>
        <div class="timeline-body">
            <p>{!! str_limit($operation->description,256) !!}</p>
            <hr>
            <ul class="post-action">
                <li><a href="{{route('frontend.operations.show',$operation->id)}}"><i class="fa fa-book"></i> Read more</a></li>
            </ul>
        </div>
        <div class="timeline-footer">
            <i class="fa fa-calendar-o"></i> {{$operation->start_time->toFormattedDateString()}}
</div>
</div>
</li>