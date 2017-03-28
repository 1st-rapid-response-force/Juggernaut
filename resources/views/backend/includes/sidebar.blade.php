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

            <li class="{{ Active::pattern('admin/prism*') }}">
                <a href="{{route('admin.prism.index')}}"> <i class="fa fa-eye" aria-hidden="true"></i> Prism</a>
            </li>


            <li class="{{ Active::pattern('admin/unit/*') }} treeview">
                <a href="#">
                    <i class="fa fa-sitemap"></i>
                    <span>Unit Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ Active::pattern('admin/unit/*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/unit/*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/unit/awards*') }}">
                        <a href="{{route('admin.awards.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Awards</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/unit/files*') }}">
                        <a href="{{route('admin.members.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Member Files</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/perstat*') }}">
                        <a href="{{route('admin.perstat.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>PERSTAT</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/programs*') }}">
                        <a href="{{route('admin.programs.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Programs</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/qualifications*') }}">
                        <a href="{{route('admin.qualifications.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Qualifications</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/unit/ribbons*') }}">
                        <a href="{{route('admin.ribbons.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Ribbons</span>
                        </a>
                    </li>
                </ul>
            <li class="">
                <a href="/admin/log-viewer"> <i class="fa fa-cogs" aria-hidden="true"></i> Log Viewer</a>
            </li>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>