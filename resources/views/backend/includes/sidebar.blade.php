<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{\Auth::User()->member->avatar}}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ \Auth::User()->member }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                {{ link_to_route('admin.dashboard', trans('menus.backend.sidebar.dashboard')) }}
            </li>

            <li class="{{ Active::pattern('admin/applications*') }}">
                <a href="{{route('admin.applications.index')}}"> <i class="fa fa-file" aria-hidden="true"></i> Applications</a>
            </li>

            <li class="{{ Active::pattern('admin/calendar*') }}">
                <a href="{{route('admin.calendar.index')}}"> <i class="fa fa-calendar" aria-hidden="true"></i> {{trans('menus.backend.unit.calendar.name')}}</a>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>