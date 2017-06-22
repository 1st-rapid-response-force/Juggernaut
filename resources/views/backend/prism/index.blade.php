@extends ('backend.layouts.master')

@section ('title', 'Prism')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Prism - Unit Messaging Platform
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Prism</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>This is the unit inbox, all messages that are sent through the platform are accessible here for archive purposes.</p>
            <hr>
            <br>
            @if (count($threads) != 0)
                @if (count($threads) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Sender</th>
                            <th>Last Updated</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($threads as $thread)
                            <tr>
                                <td>{{$thread->id}}</td>
                                <td>{{$thread->subject}}</td>
                                <td>{{$thread->creator()->member->searchable_name}}</td>
                                <td>{{$thread->latestMessage->updated_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.prism.show',array($thread->id)) }}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Messages in the database.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    {{ HTML::script('plugins/footable/js/footable.js') }}

    <script>
        jQuery(function($){
            $('.table').footable({
                "paging": {
                    "enabled": true
                },
                "filtering": {
                    "enabled": true
                },
                "sorting": {
                    "enabled": true
                }
            });
        });
    </script>
@stop