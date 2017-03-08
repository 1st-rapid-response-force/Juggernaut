<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    <div class="card card-video">
        <div class="card-img">
            <a href="{{route('frontend.team.videos.view',[$team->id, $video->id])}}"><img src="http://i1.ytimg.com/vi/{{$video->youtube_id}}/mqdefault.jpg" alt=""></a>
        </div>
        <div class="caption">
            <h3 class="card-title"><a href="{{route('frontend.team.videos.view',[$team->id, $video->id])}}">{{$video->name}}</a></h3>
            <ul>
                <li><i class="fa fa-clock-o"></i> {{$video->posted_at->toFormattedDateString()}}</li>
                <li><i class="fa fa-eye"></i> {{$video->viewer_count or 0}} views</li>
            </ul>
            <p>{{str_limit($video->description,80)}}</p>
        </div>
    </div>
</div>