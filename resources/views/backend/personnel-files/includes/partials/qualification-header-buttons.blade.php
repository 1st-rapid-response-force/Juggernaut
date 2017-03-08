<div class="pull-right mb-10">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.unit.personnel-files.qualifications') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{ link_to_route('admin.personnel-file.qualification.index', trans('menus.backend.unit.personnel-files.all-qualifications')) }}</li>

            @permission('manage-qualifications')
                <li>{{ link_to_route('admin.personnel-file.qualification.create', trans('menus.backend.unit.personnel-files.create-qualification')) }}</li>
            @endauth

            <li class="divider"></li>
            <li>{{ link_to_route('admin.personnel-files.qualification.deleted', trans('menus.backend.unit.personnel-files.deleted-qualifications')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
