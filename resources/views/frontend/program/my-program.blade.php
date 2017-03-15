@extends('frontend.templates.master')

@section('title','My Program')

@section('content')
    <div id="wrapper">
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    @if(!\Auth::User()->member->current_program_id)
                                        <h2><a href="#">My Program<a></h2>
                                    @else
                                        <h2>My Program - {{\Auth::User()->member->program->name}}</h2>
                                    @endif
                                </div>
                            </div>

                            @if(!\Auth::User()->member->current_program_id)
                                <p>You are currently not enrolled in a training program.</p>
                            @else
                                <p>{{\Auth::User()->member->program->description}}</p>
                            <div class="well">
                                <table class="table table-condensed" id="serviceHistoryTable">
                                    <thead>
                                    <th>Training Goal</th>
                                    <th>Status</th>
                                    </thead>
                                    <tbody>
                                    @foreach(\Auth::User()->member->program->goals as $goal)
                                        <tr>
                                            <td class="col-lg-8">{{$goal->goal}}</td>
                                            <td class="col-lg-2">{!! $goal->getMemberStatusButton(\Auth::User()->member) !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            @endif
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