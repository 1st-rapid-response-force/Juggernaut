<div class="pull-right mb-10">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.unit.personnel-files.awards') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.personnel-file.award.index', trans('menus.backend.unit.personnel-files.all-awards')) }}</li>

            @permission('manage-awards')
                <li>{{ link_to_route('admin.personnel-file.award.create', trans('menus.backend.unit.personnel-files.create-award')) }}</li>
            @endauth

            <li class="divider"></li>
            <li>{{ link_to_route('admin.personnel-files.award.deleted', trans('menus.backend.unit.personnel-files.deleted-awards')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
