@extends ('backend.layouts.master')

@section ('title', 'Loadout Manager')

@section('after-styles-end')
    {{ Html::style("css/backend/plugin/datatables/dataTables.bootstrap.min.css") }}
    {{ Html::style("plugins/fullcalendar/fullcalendar.min.css") }}
@stop

@section('page-header')
    <h1>
        Loadout Manager
    </h1>
@endsection

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Manager</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">

            {!! Form::open(['route' => ['admin.loadouts.update',$loadout->id],'class' => 'form-horizontal', 'method' => 'PUT', 'role' => 'form', 'files' => true]) !!}

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name: &nbsp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{$loadout->name}}" placeholder="Name of Loadout Item">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Category: &nbsp</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category">
                                <option {{($loadout->category == 'primary') ? 'selected' : ''}} value="primary">Primary Weapon</option>
                                <option {{($loadout->category == 'secondary') ? 'selected' : ''}} value="secondary">Secondary Weapon</option>
                                <option {{($loadout->category == 'launcher') ? 'selected' : ''}} value="launcher">Launcher Weapon</option>
                                <option {{($loadout->category == 'thrown') ? 'selected' : ''}} value="thrown">Thrown</option>
                                <option {{($loadout->category == 'uniform') ? 'selected' : ''}} value="uniform">Uniform</option>
                                <option {{($loadout->category == 'vest') ? 'selected' : ''}} value="vest">Vest</option>
                                <option {{($loadout->category == 'backpack') ? 'selected' : ''}} value="backpack">Backpack</option>
                                <option {{($loadout->category == 'helmet') ? 'selected' : ''}} value="helmet">Helmet</option>
                                <option {{($loadout->category == 'goggles') ? 'selected' : ''}} value="goggles">Goggles Slot</option>
                                <option {{($loadout->category == 'nightvision') ? 'selected' : ''}} value="nightvision">Nightvision Slot</option>
                                <option {{($loadout->category == 'binoculars') ? 'selected' : ''}} value="binoculars">Binoculars Slot</option>
                                <option {{($loadout->category == 'primary_attachments') ? 'selected' : ''}} value="primary_attachments">Primary Attachments</option>
                                <option {{($loadout->category == 'secondary_attachments') ? 'selected' : ''}} value="secondary_attachments">Secondary Attachments</option>
                                <option {{($loadout->category == 'launcher_attachments') ? 'selected' : ''}} value="launcher_attachments">Launcher Attachments</option>
                                <option {{($loadout->category == 'items') ? 'selected' : ''}} value="items">Items</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="class_name" class="col-sm-2 control-label">Class Name ARMA 3: &nbsp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="class_name" value="{{$loadout->class_name}}" name="class_name" placeholder="Class Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Empty Item: &nbsp</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="empty">
                                <option {{($loadout->empty == 0) ? 'selected' : ''}} value="0">False</option>
                                <option {{($loadout->empty == 1) ? 'selected' : ''}} value="1">True</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Required Qualification: &nbsp</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="qualification_id">
                                @foreach($qualifications as $qualification)
                                    <option {{($loadout->qualification_id == $qualification->id) ? 'selected' : ''}} value="{{$qualification->id}}">{{$qualification->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img" class="col-sm-2 control-label">Image: &nbsp</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="img" name="img">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="img" class="col-sm-2 control-label">Current Image: &nbsp</label>
                        <div class="col-sm-10">
                            <img src="{{$loadout->getImage()}}">
                        </div>
                    </div>
                    <br>
                </div>

                <div class="clearfix"></div>
            </div>

        </div>

        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
    <!-- /.box-body -->

    <div class="box box-success">
        <div class="box-body">
            <div class="pull-left">
                {{ link_to_route('admin.loadouts.index', 'Cancel', [], ['class' => 'btn btn-danger btn-xs']) }}
            </div><!--pull-left-->

            <div class="pull-right">
                {{ Form::submit('Update', ['class' => 'btn btn-success btn-xs']) }}
            </div><!--pull-right-->
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div><!-- /.box-body -->
    </div><!--box-->
@stop

@section('after-scripts-end')

@stop