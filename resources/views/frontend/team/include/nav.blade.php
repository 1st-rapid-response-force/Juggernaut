<section class="tab-select no-padding border-bottom-1 border-grey-300 text-center">
    <div class="container">
        <ul class="nav nav-tabs" role="tablist">
            <li class="{{Active::pattern('team/'.$team->id)}}"><a href="{{route('frontend.team',$team->id)}}">Timeline</a></li>
            <li class="{{Active::pattern('team/'.$team->id.'/members*')}}"><a href="{{route('frontend.team.members',$team->id)}}"><i class="fa fa-users"></i> Members</a></li>
            <li class="{{Active::pattern('team/'.$team->id.'/videos*')}}"><a href="{{route('frontend.team.videos',$team->id)}}"><i class="fa fa-video-camera"></i> Videos</a></li>

            @if((!Auth::guest()) && ($team->id == Auth::User()->member->team->id))
                <!-- <li><a href="#"><i class="fa fa-comments-o"></i> Team Chatter</a></li> -->
            @endif
            @if(($team->isAviation()))
                <li><a href="{{route('frontend.aviation')}}"><i class="fa fa-fighter-jet"></i> Aviation Dashboard</a></li>
            @endif
            @if((!Auth::guest()) && $team->isLeader(\Auth::User()))
                <li class="{{Active::pattern('team/'.$team->id.'/leader*')}}"><a href="{{route('frontend.team.leader',$team->id)}}"><i class="fa fa-star"></i> Leader Panel</a></li>
            @endif
        </ul>
    </div>
</section>