@extends ('backend.layouts.master')

@section ('title', 'Announcements')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Announcements
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Announcements</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <p>The following are the announcements in the unit.</p>
            <h4>Administrative Options</h4>
            <p><a href="{{route('admin.announcements.create')}}" class="btn btn-success">New Announcements</a>
            </p>
            <hr>
            <br>
            @if (count($announcements) != 0)
                @if (count($announcements) != 0)
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Author</th>
                            <th>Created On</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <td class="col-lg-6">{{$announcement->subject}}</td>
                                <td class="col-lg-2">{{$announcement->user->member}}</td>
                                <td class="col-lg-2">{{$announcement->created_at->diffForHumans()}}</td>
                                <td class="col-lg-2">
                                   {!! $announcement->getActionButtonsAttribute() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There is no Programs in the database, add one by using the Administrator tools.</p>
                @endif
            @endif
        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    <!-- Modal -->
    <div class="modal fade" id="newProgram" tabindex="-1" role="dialog" aria-labelledby="newProgramModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newProgramModal">New Program</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name of Program - Basic Training">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Descriptions: &nbsp</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="responsible_team_id" value="1">
                        <input type="hidden" name="status" value="1">


                        {{csrf_field()}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{ HTML::script('plugins/footable/js/footable.js') }}

    <script>
        jQuery(function($){
            $('.table').footable({
                "paging": {
                    "enabled": true,
                    "size": 100
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