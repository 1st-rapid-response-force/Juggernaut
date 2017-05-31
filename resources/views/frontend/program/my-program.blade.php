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
                                    @if(!\Auth::User()->member->current_program_id)
                                        <h2><a href="#">My Program</a></h2>
                                    @else
                                        <h2>My Program - {{\Auth::User()->member->program->name}}</h2>
                                    @endif
                                </div>
                            </div>

                            @if(!\Auth::User()->member->current_program_id)
                                <p>You are currently not enrolled in a training program.</p>
                                <p>Please select a training program:</p>
                                @foreach(\App\Models\Unit\Program::whereStatus(1)->get() as $program)
                                <div class="well">
                                    <h2>{{$program->name}}</h2>
                                    <p>{{$program->description}}</p>
                                    {{ Form::open(['route' => ['frontend.files.my-program.post'], 'role' => 'form', 'method' => 'post']) }}
                                        <input type="hidden" name="program_id" value="{{$program->id}}">
                                        <button type="submit" class="btn btn-primary">Enroll</button>
                                    {{ Form::close() }}
                                </div>
                                @endforeach
                            @else
                                <p>{{\Auth::User()->member->program->description}}</p>
                                @if(\Auth::User()->member->program->getMedia('attachments')->count())

                                    <div class="attachment">
                                        <h4>Program Files</h4>
                                        @foreach(\Auth::User()->member->program->getMedia('attachments') as $attachment)
                                            <a href="{{$attachment->getUrl()}}"><i class="fa fa-unlink"></i> {{$attachment->file_name}}</a><br>
                                        @endforeach
                                    </div>

                                @endif
                                <br><br>
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