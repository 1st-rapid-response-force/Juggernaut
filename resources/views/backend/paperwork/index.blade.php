@extends ('backend.layouts.master')

@section ('title', 'Unit Paperwork')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Paperwork - <small>Archive</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Paperwork Repository</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>This is the unit paperwork repository, all paperwork is stored here for archive purposes.</p>
            <hr>
            <br>
            @if (count($paperwork) != 0)
                @if (count($paperwork) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Issuer</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Team</th>
                            <th>Date Created</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($paperwork as $paper)
                            <tr>
                                <td>{{$paper->id}}</td>
                                <td>{{$paper->member->searchable_name}}</td>
                                <td>{{$paper->getType()}}</td>
                                <td>{!! $paper->getStatus() !!}</td>
                                <td>{{$paper->team->name or 'NA'}}</td>
                                <td>{{$paper->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('frontend.paperwork.show',$paper->id)}}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Paperwork in the database.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
@stop