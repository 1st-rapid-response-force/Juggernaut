@extends ('backend.layouts.master')

@section ('title', 'Promotion Eligibility List')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Promotion Eligibility List
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Promotion Eligibility List</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>Based on Time in Service requirements, the following users are eligible to promote.</p>
            @if(count($files) > 0)
                <table class = "table">
                    <caption>Member Files</caption>

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>Next Rank</th>
                        <th>Time in Service</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($files as $file)
                        <tr>
                            <td>{{$file->id}}</td>
                            <td>{{$file}}</td>
                            <td>{{$file->team->name}}</td>
                            <td>{{$file->position}}</td>
                            <td>{{\App\Models\Unit\Rank::find($file->rank->id+1)->name}}</td>
                            <td>{{$file->time_in_service}} days</td>
                            <td>{!! $file->getActive() !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No Members are eligible to promote.</p>
            @endif

        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    {{ HTML::script("plugins/footable/js/footable.js") }}
@stop