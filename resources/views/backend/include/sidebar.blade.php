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

                    <li class="{{ Active::pattern('admin/unit/loadouts*') }}">
                        <a href="{{route('admin.loadouts.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Loadouts</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/files*') }}">
                        <a href="{{route('admin.members.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Member Files</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/paperwork*') }}">
                        <a href="{{route('admin.paperwork.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Paperwork Repository</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/promotions*') }}">
                        <a href="{{route('admin.promotions')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Promotion Eligibility List</span>
                        </a>
                    </li>

                    <li class="{{ Active::pattern('admin/unit/qualifications*') }}">
                        <a href="{{route('admin.qualifications.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Qualifications</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/unit/qualifications*') }}">
                        <a href="{{route('admin.operations.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Operations</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/unit/teams*') }}">
                        <a href="{{route('admin.teams.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Teams</span>
                        </a>
                    </li>
                    <li class="{{ Active::pattern('admin/unit/ribbons*') }}">
                        <a href="{{route('admin.ribbons.index')}}">
                            <i class="fa fa-circle-o"></i>
                            <span>Ribbons</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>
