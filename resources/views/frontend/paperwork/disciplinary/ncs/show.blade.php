@extends('frontend.templates.master')

@section('title','Negative Counseling Statement')

@section('after-styles-end')
    <link rel="stylesheet" type="text/css" href="/plugins/gridforms/gridforms.css">
@endsection

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Negative Counseling Statement - {{$form->getPaperwork()->date}} - #RRF-NCS-{{$form->id}}</a></h2>
                                </div>
                            </div>
                            @if((!isset($form->appeal)) && ($form->disciplinary_member_id == \Auth::User()->member->id))
                                <br>
                                    <h3>Disciplinary Options</h3>
                                <form class="grid-form" method="post" action="{{route('frontend.disciplinary.appeal.post',$form->id)}}">
                                    {{csrf_field()}}
                                    {{ Form::submit('Appeal Decision', ['class' => 'btn btn-sm btn-success']) }}
                                </form>
                            <hr>

                                <br><br>
                            @endif
                            @if(((\Auth::User()->admin) && isset($form->appeal)))
                                <br>
                                <div class="pull-right">
                                    <h3>Admin Options</h3>
                                    <form class="grid-form" method="post" action="{{route('frontend.disciplinary.appeal.admin.post',$form->id)}}">
                                        {{csrf_field()}}
                                        {{Form::select('appeal',['1' => 'Appeal Requested', '2' => 'Appeal Under Review', '3' => 'Appeal Denied'],$form->appeal)}}
                                        {{ Form::submit('Sign and Submit', ['class' => 'btn btn-sm btn-success']) }}
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <br><br>
                            @endif
                            <div class="well">
                                <form class="grid-form">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>NEGATIVE COUNSELING STATEMENT</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong>  To correct the negative actions or behavior of their subordinates. The main requirement of the NCS is the verbal counseling of the soldier by their superior, in which the behavior is addressed and corrected. Superiors will cover the issue, any disciplinary action that will be taken and consequences of future recurrence.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Master File and Field Personnel File.</p>
                                    <p><strong>DISCLOSURE: </strong> Not Applicable, filled out by Chain of Command</p>
                                    @if($form->appeal == 1)
                                            <blockquote class="blockquote-info">
                                                <h4>This disciplinary action has been appealed and will be investigated soon.</h4>
                                            </blockquote>
                                    @elseif($form->appeal == 2)
                                            <blockquote class="blockquote-warning">
                                                <h4>This disciplinary action appeal is currently being reviewed.</h4>
                                            </blockquote>
                                    @elseif($form->appeal == 3)
                                            <blockquote class="blockquote-danger">
                                                <h4>This disciplinary action has been appealed but has been declined.</h4>
                                            </blockquote>
                                    @endif


                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$form->getPaperwork()->name}}">
                                            </div>
                                            <div data-field-span="4">
                                                <label>GRADE</label>
                                                <input type="text" name="grade" readonly value="{{$form->getPaperwork()->grade}}">
                                            </div>

                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input type="text" name="military_id" readonly value="{{$form->getPaperwork()->military_id}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>CURRENT DATE</label>
                                                <input type="text" id="date" name="date"  placeholder="01/01/2000" readonly value="{{$form->getPaperwork()->date}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>ORGANIZATION</label>
                                                <input type="text" name="organization" readonly value="1st Rapid Response Force">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. INFRACTION</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>COUNSELOR</label>
                                                <input type="text" name="counselor_name" readonly value="{{$form->getPaperwork()->counselor_name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>MISCONDUCT SUMMARY</label>
                                                <textarea name="summary_infraction" readonly rows="15" >{{$form->getPaperwork()->summary_infraction}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Plan of Action</label>
                                                <textarea name="action_plan" readonly rows="8" >{{$form->getPaperwork()->action_plan}}</textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                   <hr>
                                   <div class="pull-right">
                                    </div><!--pull-right-->
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                            <br>
                            <hr>
                            <h3>Paperwork Notes:</h3>
                            @if(\Auth::User()->admin)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newPaperworkNote">
                                    New Paperwork Note
                                </button>
                                <br><br>
                            @endif

                            @if($form->notes->count() > 0)
                                @foreach($form->notes as $note)
                                    <div class="well">
                                        <strong>{{$note->member}}</strong>
                                        <hr>
                                        {{$note->message}}
                                        <hr>
                                        {{$note->created_at->toDateTimeString()}}
                                    </div>
                                @endforeach
                            @else
                                <p>No Program Notes</p>
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
    <script type="text/javascript" src="/plugins/gridforms/gridforms.js"></script>
    @if(\Auth::User()->admin)
    <div class="modal fade" id="newPaperworkNote" tabindex="-1" role="dialog" aria-labelledby="newPaperworkLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newPaperworkNoteLabel">New Paperwork Note</h4>
                </div>
                <div class="modal-body">
                {{ Form::open(['route' => ['frontend.paperwork.note.store',$form->id], 'role' => 'form', 'method' => 'post']) }}
                <!-- Form would go here -->
                    <div class="form-group">
                        {{ Form::label('note', 'Paperwork Note:', ['class' => 'control-label']) }}

                        {{ Form::textarea('message', null, ['class' => 'form-control','required' => 'required']) }}
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
    @endif
@endsection