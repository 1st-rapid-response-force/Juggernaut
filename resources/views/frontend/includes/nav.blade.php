<header>
    <div class="container">
        <span class="bar hide"></span>
        <a href="index.html" class="logo"><img src="/img/logo.png" alt=""></a>
        <nav>
            <div class="nav-control">
                <ul>
                    <li><a href="{{route('frontend.index')}}">Home</a></li>
                    <li><a href="{{route('frontend.index')}}">About Us</a></li>
                    <li><a href="{{route('frontend.index')}}">Apply</a></li>

                    @if(!\Auth::guest())
                    <li><a href="{{route('frontend.calendar')}}">Calendar</a></li>
                    @endif
                </ul>
            </div>
        </nav>
        <div class="nav-right">
        @if(!\Auth::guest())
            <div class="nav-profile dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span><img src="{{\Auth::User()->member->avatar}}" alt=""> {{\Auth::User()->member}}</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('frontend.team',Auth::user()->member->team_id)}}"><i class="fa fa-users"></i> My Team</a></li>
                    <li><a href="{{route('inbox')}}"><i class="fa fa-envelope-o"></i> My Messages {!! Auth::user()->newThreadsCount() > 0 ? '<span class="label label-info">'.Auth::user()->newThreadsCount().'</span>' : '' !!}</a></li>
                    <li><a href="{{route('frontend.settings')}}"><i class="fa fa-gear"></i> Settings</a></li>
                    @if(\Auth::User()->admin)
                        <li><a href="{{route('admin.index')}}"><i class="fa fa-lock"></i> Admin</a></li>
                    @endif
                    <li class="divider"></li>
                    <li><a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Sign Out</a></li>
                </ul>
            </div>

        </div>
        @else
            <a data-toggle="modal" href="#signin"><i class="fa fa-key"></i></a>
        @endif
        </div>
    </div>
</header>
<!-- /header -->
