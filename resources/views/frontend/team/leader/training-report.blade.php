@extends('frontend.templates.master')

@section('title','Home')

@section('content')

    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image or $team->randomHeader()}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">{{$team->name}}</a></div>
                    <p>{{$team->motto}}</p>
                    <p><img src="{{$team->team_image}}" class="center-block"></p>
                    <br>
                </div>
            </div>
        </section>

        @include('frontend.team.include.nav')

        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.team',$team->id)}}">{{$team->name}}</a></li>
                    <li><a href="{{route('frontend.team.leader',$team->id)}}">Leader Panel</a></li>
                    <li><a href="{{route('frontend.team.leader.training',$team->id)}}">Training Management</a></li>
                    <li><a href="#">{{$member->searchable_name}}</a></li>
                    <li class="active">Training Report</li>
                </ol>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Team Training - {{$member->searchable_name}} - Detailed Report</h2>
                                </div>
                            </div>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newTrainingNote">
                                    New Training Note
                                </button>
                            <hr>
                                <div class="well">
                                    <h2>Qualifications</h2>
                                    <hr>
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    {{ Form::open(['route' => ['frontend.team.leader.training.report.mark.bulk.post',$team->id,$member->id], 'role' => 'form', 'method' => 'post']) }}
                                        <div class="pull-right">
                                            <th><button type="submit" class="btn btn-sm btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i></button> </th>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                    @foreach(\App\Models\Unit\Program::all() as $program)
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$program->id}}" aria-expanded="true" aria-controls="collapse{{$program->id}}">
                                                            {{$program->name}}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse{{$program->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$program->id}}">
                                                    <div class="panel-body">

                                                        <table class="table table-condensed" id="serviceHistoryTable">
                                                            <thead>
                                                            <th>Training Goal</th>
                                                            <th>Status</th>
                                                            <th>Completed</th>

                                                            </thead>
                                                            <tbody>
                                                            @foreach($program->goals as $goal)
                                                                <tr>
                                                                    <td class="col-lg-8">{{$goal->goal}}</td>
                                                                    <td class="col-lg-2">{!! $goal->getMemberStatusButton($member) !!}</td>
                                                                    <td class="col-lg-2">
                                                                        @if($goal->getMemberStatus($member))
                                                                            <input checked disabled="" type="checkbox">
                                                                        @else
                                                                            {{Form::checkbox('goal[]', $goal->id,$goal->getMemberStatus($member))}}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                        {{Form::close()}}
                                    </div>
                                    </hr>
                                </div>
                            <br>
                            <hr>
                                <h3>Training Notes:</h3>
                            <br>
                            @if($member->programNotes->count() > 0)
                                @foreach($member->programNotes as $note)
                                    <div class="well">
                                        <strong>{{$note->author}}</strong>
                                        <hr>
                                        {{$note->note}}
                                        <hr>
                                        {{$note->created_at->toDateTimeString()}} | <a href="{{route('frontend.team.leader.training.report.note.delete',[$team->id,$member->id,$note->id])}}"
                                                                                       data-method="delete"
                                                                                       data-trans-button-cancel="Cancel"
                                                                                       data-trans-button-confirm="Delete"
                                                                                       data-trans-title="Are you sure?"
                                                                                       class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                    </div>
                                @endforeach
                            @else
                                <p>No Training Notes</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>


    <!-- uploadHeaderImage -->
    <div class="modal fade" id="newTrainingNote" tabindex="-1" role="dialog" aria-labelledby="newTrainingNoteLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newTrainingNoteLabel">New Training Note</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(['route' => ['frontend.team.leader.training.report.new-note',$team->id,$member->id], 'role' => 'form', 'method' => 'post']) }}
                <!-- Form would go here -->
                    <div class="form-group">
                        {{ Form::label('note', 'Training Note:', ['class' => 'control-label']) }}

                        {{ Form::textarea('note', null, ['class' => 'form-control','required' => 'required']) }}
                    </div><!--form control-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection