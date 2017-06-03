@extends('frontend.templates.master')

@section('title','Change Request')

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
                                    <h2><a href="#">Change Request - {{$form->getPaperwork()->date}} - #RRF-CR-{{$form->id}}</a></h2>
                                </div>
                            </div>
                            @if(\Auth::User()->admin)
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
                                <form class="grid-form" method="post" action="{{route('frontend.paperwork.change-request.post')}}">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>CHANGE REQUEST FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p>{!! $form->getStatus() !!}</p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to request/recommend changes for website, training, and operational environments</p>
                                    <p><strong>ROUTINE USE(S): </strong> Used by Squad Leaders and above .</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary</p>
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
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>TEAM</label>
                                                <input type="text" name="team" readonly value="{{$form->getPaperwork()->team}}">
                                            </div>

                                        </div>
                                        <div data-row-span="3">
                                            <div data-field-span="2">
                                                <label>MILITARY IDENTIFICATION NUMBER</label>
                                                <input  type="text" name="military_id" readonly value="{{$form->getPaperwork()->military_id}}">
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
                                        <legend>B. CHANGE SECTION</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Desired Change</label>
                                                <textarea readonly name="desired_change" rows="5" placeholder="">{{$form->getPaperwork()->desired_change}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Desired Change</label>
                                                <textarea readonly name="justification" rows="5" placeholder="Why do you need this capability, facility, etc.; must tie to our unit structure, policies, and doctrine; changes or additions to doctrine or policy must include effects to existing processes, capabilites">{{$form->getPaperwork()->justification}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Requested Priority</label>
                                                <label><input type="radio" disabled name="priority" value="Immediate" {{$form->getPaperwork()->priority == 'Immediate' ? 'checked' : ''}}>
                                                    <a href="#" data-toggle="tooltip" title="(Resolution target is 24 hours)  Lack of critical capability that prevents mission accomplishment or training objective">Immediate</a>
                                                </label> &nbsp;
                                                <label><input type="radio" disabled name="priority" value="Priority" {{$form->getPaperwork()->priority == 'Priority' ? 'checked' : ''}}>
                                                    <a href="#"  data-toggle="tooltip" title="(Resolution target is 48-72 hours)  Lack of capability that has potential future impact on operations, or lack of capability puts unnecessary stress on leaders to accomplish missions and training">Priority</a>
                                                </label> &nbsp;
                                                <label><input type="radio" disabled name="priority" value="Routine" {{$form->getPaperwork()->priority == 'Routine' ? 'checked' : ''}}>
                                                    <a href="#" data-toggle="tooltip" title="(Resolution target is greater than 72 hours)  Lack of capability that has limited short term effects on operations or training, but may enhance overall unit capability and provide support to existing processes/training/mission">Routine</a>
                                                </label> &nbsp;
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>

                                    <div class="pull-right">

                                    </div><!--pull-right-->
                                    <div class="clearfix"></div>
                                </form>
                                <hr>

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