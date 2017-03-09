<div class="media">
    <div class="media-left">
        <a href="#">
            <img class="media-object img-circle" src="{{$member->avatar}}" alt="{{$member}}">
        </a>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('frontend.files.file',$member->id)}}">{{$member}}</a></h4>
        <strong>{{$member->position}}</strong><br>
        {{$member->bio}}
    </div>
</div>