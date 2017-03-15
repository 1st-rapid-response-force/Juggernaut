<div class="pull-right mb-10">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.unit.calendar.name') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.calendar.index', trans('menus.backend.unit.calendar.name')) }}</li>
            <li class="divider"></li>

                <li>{{ link_to_route('admin.calendar.create.event', trans('menus.backend.unit.calendar.schedule-event')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
