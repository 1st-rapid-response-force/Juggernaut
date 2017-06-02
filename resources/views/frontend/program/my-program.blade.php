@extends('frontend.templates.master')

@section('title','My Program')

@section('content')
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.files.my-file')}}">{{\Auth::User()->member}}</a></li>
                    <li class="active">My Program</li>
                </ol>
            </div>
        </section>
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                        <h2><a href="#">My Qualifications</a></h2>
                                </div>
                            </div>
                                <div class="well">
                                    <hr>
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
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
                                                            </thead>
                                                            <tbody>
                                                            @foreach($program->goals as $goal)
                                                                <tr>
                                                                    <td class="col-lg-10">{{$goal->goal}}</td>
                                                                    <td class="col-lg-2">{!! $goal->getMemberStatusButton(\Auth::User()->member) !!}</td>

                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    </hr>
                                </div>
                                <br>
                                <hr>
                                <h3>Training Notes:</h3>
                                <br>
                                @if(\Auth::User()->member->programNotes->count() > 0)
                                    @foreach(\Auth::User()->member->programNotes as $note)
                                        <div class="well">
                                            <strong>{{$note->author}}</strong>
                                            <hr>
                                            {{$note->note}}
                                            <hr>
                                            {{$note->created_at->toDateTimeString()}}
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

@endsection