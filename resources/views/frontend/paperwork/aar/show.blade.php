@extends('frontend.templates.master')

@section('title','After Action Report')

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
                                    <h2><a href="#">After Action Report - {{$form->getPaperwork()->date}} - #RRF-AAR-{{$form->id}}</a></h2>
                                </div>
                            </div>
                            @if((\Auth::User()->admin))
                                <br>
                                <div class="pull-right">
                                    <h3>Admin Options</h3>
                                    <form class="grid-form" method="post" action="{{route('frontend.paperwork.admin.post',$form->id)}}">
                                        {{csrf_field()}}
                                        {{Form::select('status',['1' => 'Pending Review', '2' => 'Reviewed', '3' => 'Archived', '4' => 'More Information Needed', '10' => 'Change Implemented','11' => 'Change on hold', '12' => 'Change Declined'],$form->status)}}
                                        {{ Form::submit('Sign and Submit', ['class' => 'btn btn-sm btn-success']) }}
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <br><br>

                            @endif

                            <div class="well">
                                <form class="grid-form">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>AFTER ACTION REPORT FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p>{!! $form->getStatus() !!}</p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to record and reflect on operations and training events.</p>
                                    <p><strong>ROUTINE USE(S): </strong> Credit for operation/training completion, stored on team file.</p>
                                    <fieldset>
                                        <legend>A. IDENTIFICATION DATA</legend>
                                        <div data-row-span="6">
                                            <div data-field-span="2">
                                                <label>NAME</label>
                                                <input type="text" name="name" readonly value="{{$form->getPaperwork()->name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>RANK</label>
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
                                                <input type="text" id="date" name="date" placeholder="01/01/2000" readonly value="{{$form->getPaperwork()->date}}">
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
                                        <legend>B. REPORT</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>EVENT NAME</label>
                                                <input type="text" name="event_name" readonly value="{{$form->getPaperwork()->event_name}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>ATTENDEES</label>
                                                <textarea name="event_attendees" rows="5" placeholder="Who attended this event?">{{$form->getPaperwork()->event_attendees}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>PROS</label>
                                                <textarea name="event_pros" rows="6" placeholder="">{{$form->getPaperwork()->event_pros}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>CONS</label>
                                                <textarea name="event_cons" rows="6" placeholder="">{{$form->getPaperwork()->event_cons}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>OTHER REMARKS</label>
                                                <textarea name="event_remarks" rows="6" placeholder="">{{$form->getPaperwork()->event_remarks}}</textarea>
                                            </div>
                                        </div>


                                    </fieldset>
                                    <br><br>
                                    <hr>
                                    <div class="clearfix"></div>

                                </form>
                            </div>

                            <br>
                            <hr>
                            <h3>Paperwork Notes:</h3>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newPaperworkNote">
                                New Paperwork Note
                            </button>
                            <br><br>

                            @if($form->notes->count() > 0)
                                @foreach($form->notes as $note)
                                    <div class="well">
                                        <strong>{{$note->member}}</strong>
                                        <hr>
                                        {{$note->message}}
                                        <hr>
                                        {{$note->created_at->toDateTimeString()}} | <a href="{{route('frontend.paperwork.note.delete',[$form->id,$note->id])}}"
                                                                                       data-method="delete"
                                                                                       data-trans-button-cancel="Cancel"
                                                                                       data-trans-button-confirm="Delete"
                                                                                       data-trans-title="Are you sure?"
                                                                                       class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
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
@endsection