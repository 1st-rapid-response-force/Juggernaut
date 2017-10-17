<header>
    <div class="container">
        <span class="bar hide"></span>
        <a href="/" class="logo"><img src="/img/logo.png" alt=""></a>
        <nav>
            <div class="nav-control">
                <ul>
                    <li><a href="{{route('frontend.index')}}">Home</a></li>

                    @if(!\Auth::guest())
                    @if(count(\Auth::User()->member))
                    <div class="visible-xs visible-sm">
                        @if(\Auth::User()->admin)
                            <li><a href="{{route('admin.index')}}"><i class="fa fa-lock"></i> Admin</a></li>
                        @endif
                        <li class="divider"></li>
                        <li><a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Sign Out</a></li>
                    </div>
                    @endif
                    @endif

                </ul>
            </div>
        </nav>
        <div class="nav-right">
        @if(!\Auth::guest())
            @if(count(\Auth::User()->member))
            <div class="nav-profile dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span><img src="{{\Auth::User()->member->avatar}}" alt=""> {{\Auth::User()->member}} {!! Auth::user()->newThreadsCount() > 0 ? '<span class="label label-info">'.Auth::user()->newThreadsCount().'</span>' : '' !!}</span></a>
                <ul class="dropdown-menu">
                    @if(\Auth::User()->admin)
                        <li><a href="{{route('admin.index')}}"><i class="fa fa-lock"></i> Admin</a></li>
                    @endif
                    <li class="divider"></li>
                    <li><a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Sign Out</a></li>
                </ul>
            </div>
            @else
                    <div class="nav-profile dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>{{\Auth::User()->name()}}</span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Sign Out</a></li>
                        </ul>
                    </div>
            @endif

        </div>
        @else
            <a data-toggle="modal" href="#signin"><i class="fa fa-key"></i></a>
        @endif
        </div>
    </div>
</header>
<!-- /header -->
