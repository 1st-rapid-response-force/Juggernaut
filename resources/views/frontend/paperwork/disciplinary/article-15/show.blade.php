@extends('frontend.templates.master')

@section('title','Article 15')

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
                                    <h2><a href="#">Article 15 - {{$form->getPaperwork()->current_date}} - #RRF-ART-{{$form->id}}</a></h2>
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
                                        {{Form::select('status',['1' => 'Appeal Requested', '2' => 'Appeal Under Review', '3' => 'Appeal Denied'],$form->appeal)}}
                                        {{ Form::submit('Sign and Submit', ['class' => 'btn btn-sm btn-success']) }}
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <br><br>

                            @endif
                            <div class="well">
                                <form class="grid-form" method="post">
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>ARTICLE 15</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> A summarized Article 15 may be used to impose non-judicial punishment per the policies and procedures of the unit.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form becomes a part of the Service's Enlisted Master File and Field Personnel File.</p>
                                    <p><strong>DISCLOSURE: </strong> Not Applicable, filled out by Commanding Officer</p>
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
                                                <input type="text" id="current_date" name="current_date" placeholder="01/01/2000" readonly value="{{$form->getPaperwork()->current_date}}">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>B. INFRACTION</legend>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>MISCONDUCT SUMMARY</label>
                                                <textarea name="misconduct" readonly rows="15">{{$form->getPaperwork()->misconduct}}</textarea>
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>The member was advised that no statement was required, but that any statement can be used against him or her in further proceedings. After considering all matters presented, the following punishments was imposed.</label>
                                                <label><input readonly type="radio" name="plea" {{$form->getPaperwork()->plea == 1 ? 'checked' : ''}} value="1"> Guilty of all offenses</label> &nbsp;
                                                <label><input readonly type="radio" name="plea" {{$form->getPaperwork()->plea == 0 ? 'checked' : ''}} value="0"> Not guilty of all offenses (do not file this form)</label> &nbsp;
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>Plan of Action</label>
                                                <textarea name="plan_of_action" readonly rows="15">{{$form->getPaperwork()->plan_of_action}}</textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br>
                                    <fieldset>
                                        <legend>C. Counselor Data</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="3">
                                                <label>NAME</label>
                                                <input type="text" name="counselor_name" readonly value="{{$form->getPaperwork()->counselor_name}}">
                                            </div>
                                            <div data-field-span="1">
                                                <label>GRADE</label>
                                                <input type="text" id="counselor_rank" name="counselor_rank" readonly value="{{$form->getPaperwork()->counselor_rank}}">
                                            </div>
                                        </div>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>ORGANIZATION</label>
                                                <input type="text" name="counselor_organization" readonly value="1st Rapid Response Force">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <br><br>
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