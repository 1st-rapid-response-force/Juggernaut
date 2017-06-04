@extends('frontend.templates.master')

@section('title','Bad Conduct')

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
                                    <h2><a href="#">Bad Conduct - {{$form->created_at->toDateString()}} - #RRF-BC-{{$form->id}}</a></h2>
                                </div>
                            </div>
                                <br>
                                <div class="pull-right">
                                    <h3>Options</h3>
                                    <form class="grid-form" method="post" action="{{route('frontend.paperwork.admin.post',$form->id)}}">
                                        {{csrf_field()}}
                                        {{Form::select('status',['1' => 'Pending Review', '2' => 'Reviewed', '3' => 'Archived', '4' => 'More Information Needed'],$form->status)}}
                                        {{ Form::submit('Sign and Submit', ['class' => 'btn btn-sm btn-success']) }}
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <br><br>

                            <div class="well">
                                <form class="grid-form" >
                                    {!! csrf_field() !!}
                                    <div class="text-center"><legend><strong>BAD CONDUCT REPORT FORM</strong><br> 1ST RAPID RESPONSE FORCE<br><br></legend></div>
                                    <div class="text-center"> <p>{!! $form->getStatus() !!}</p></div>
                                    <div class="text-center"><h3>PRIVACY ACT STATEMENT</h3></div>
                                    <p><strong>AUTHORITY: </strong> 1ST-RRF-POLICIES-PROCEDURES</p>
                                    <p><strong>PRINCIPAL PURPOSE(S): </strong> Used to report conduct infractions within the unit.</p>
                                    <p><strong>ROUTINE USE(S): </strong> This form is used to report bad conduct that has broken our guidelines..</p>
                                    <p><strong>DISCLOSURE: </strong> Voluntary; information is internally used and will be sent up the chain of command</p>
                                    <p><strong>INFO: </strong> Upon submitting this form and investigation will be conducted regarding the infraction. You may be contacted for more information regarding this case, however your report or name will never be disclosed to the violating party. This form will not be attached to your file.</p>
                                    <fieldset>
                                        <legend>A. INFRACTION REPORT</legend>
                                        <div data-row-span="4">
                                            <div data-field-span="4">
                                                <label>VIOLATOR NAME:</label>
                                                <input type="text" name="violator_name" value="{{$form->getPaperwork()->violator_name or ''}}">
                                            </div>
                                        </div>
                                        <div data-row-span="1">
                                            <div data-field-span="1">
                                                <label>SUMMARY OF INTERACTION</label>
                                                <textarea name="violation_summary" rows="15">{{$form->getPaperwork()->violation_summary}}</textarea>
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