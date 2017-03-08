@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.documentation.name').' - '.trans('labels.backend.documentation.categories'))

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("vendor/datatables/rowReorder.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('labels.backend.documentation.categories') }}
        <small>{{ trans('labels.backend.personnel-files.awards.published') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.personnel-files.awards.published') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.personnel-files.includes.partials.award-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="categories-table" class="table table-condensed table-hover">
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('Documentation') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@stop

@section('after-scripts-end')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}
    {{ Html::script("vendor/datatables/dataTables.rowReorder.min.js") }}

    <script>
        $(function() {
            $('#categories-table').DataTable({
                data: categories,
                columns: [
                    { title: "{{trans('labels.backend.documentation.category.id')}}"},
                    { title: "{{trans('labels.backend.documentation.category.name')}}"},
                    { title: "{{trans('labels.backend.documentation.category.sort_order')}}"},
                    { title: "{{trans('labels.backend.documentation.category.published')}}"},
                    { title: "{{trans('labels.backend.documentation.category.last_updated')}}"},
                    { title: "{{trans('labels.backend.documentation.category.created')}}"}
                ],
                order: [[2, "asc"]]
            });
        });
    </script>
@stop