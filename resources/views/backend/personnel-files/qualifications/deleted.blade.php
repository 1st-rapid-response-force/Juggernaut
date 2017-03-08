@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.personnel-files.qualifications.management'))

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
@stop

@section('page-header')
    <h1>
        {{ trans('labels.backend.personnel-files.qualifications.management') }}
        <small>{{ trans('labels.backend.personnel-files.qualifications.deleted') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.personnel-files.qualifications.deleted') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.personnel-files.includes.partials.qualification-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
                <table id="awards-table" class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.id') }}</th>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.name') }}</th>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.promotion-points') }}</th>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.published') }}</th>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.created') }}</th>
                            <th>{{ trans('labels.backend.personnel-files.qualifications.table.last_updated') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
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
            {!! history()->renderType('Qualification') !!}
        </div><!-- /.box-body -->
    </div><!--box box-success-->
@stop

@section('after-scripts-end')
    {{ Html::script("js/backend/plugin/datatables/jquery.dataTables.min.js") }}
    {{ Html::script("js/backend/plugin/datatables/dataTables.bootstrap.min.js") }}

    <script>
        $(function() {
            $('#awards-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.personnel-files.qualification.get") }}',
                    type: 'get',
                    data: {published: false, trashed: true}
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'promotion_points', name: 'promotion_points'},
                    {data: 'published', name: 'published'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@stop