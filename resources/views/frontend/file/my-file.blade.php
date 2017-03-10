@extends('frontend.templates.master')

@section('title','My File')

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
                                    <h2><a href="#">My File</a></h2>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">{{\Auth::User()->member}}</div>

                                        <div class="panel-body well">

                                            <div class="row">

                                                <div class="col-md-4 col-md-push-8">

                                                    <ul class="media-list">
                                                        <li class="media">
                                                            <div class="media-left">
                                                                <img class="media-object" src="{{\Auth::User()->member->avatar}}" alt="Profile picture">
                                                            </div><!--media-left-->

                                                            <div class="media-body">
                                                                <h4 class="media-heading">
                                                                    {{\Auth::User()->member}}<br/>
                                                                    <small>
                                                                        {{\Auth::User()->member->position}}<br/>
                                                                        <a href="{{route('frontend.team',\Auth::User()->member->team->id)}}">{{\Auth::User()->member->team->name}}</a> <br/>
                                                                        Military ID: {{\Auth::User()->steam_id}} <br/>
                                                                    </small>
                                                                </h4>


                                                            </div><!--media-body-->
                                                        </li><!--media-->
                                                    </ul><!--media-list-->
                                                    <br>
                                                    <div class="panel panel-default">

                                                        <div class="panel-body">
                                                            <a href="{{route('frontend.files.faces')}}" class="btn btn-info btn-block">Change Face</a>
                                                            <hr>
                                                            <a href="{{route('frontend.paperwork.leave')}}" class="btn btn-primary btn-block">Leave of Absence Request</a>
                                                            <a href="{{route('frontend.paperwork.file-correction')}}" class="btn btn-info btn-block">Request File Correction</a>
                                                            <a href="{{route('frontend.paperwork.bad-conduct')}}" class="btn btn-danger btn-block">Bad Conduct Report</a>
                                                            <a href="{{route('frontend.paperwork.discharge')}}" class="btn btn-danger btn-block">Discharge Request</a>

                                                        </div><!--panel-body-->
                                                    </div><!--panel-->
                                                    <br>
                                                    <div class="panel-body text-center">
                                                        <img src="{{\Auth::User()->member->showCAC()}}">
                                                    </div><!--panel-body-->
                                                    <br>

                                                </div><!--col-md-4-->

                                                <div class="col-md-8 col-md-pull-4">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Ribbons</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body text-center">
                                                                    @if(count(\Auth::User()->member->ribbons) > 0)
                                                                    <div class="row">
                                                                        <?php $i = 3; ?>
                                                                        @foreach(\Auth::User()->member->ribbons as $ribbon)
                                                                            <div class="col-lg-4">
                                                                                <img style="width: 125px; height:35px;" src="{{$ribbon->getImage()}}"><br>
                                                                                <small>{{$ribbon->name}}</small>
                                                                            </div>
                                                                            <?php if (($i != 0) && (($i % 1) == 1)) echo '</div><div class="row">'; ?>
                                                                            <?php $i--; ?>
                                                                        @endforeach
                                                                    </div>
                                                                    @else
                                                                    <p>This member does not have any ribbons</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Service History</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\Auth::User()->member->serviceHistory->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\Auth::User()->member->serviceHistory()->orderBy('date','desc')->get() as $serviceHistory)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d',$serviceHistory->date)->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-10">{{$serviceHistory->text}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Service History for this member.</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Qualifications</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\Auth::User()->member->serviceHistory->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Awarded</th>
                                                                            <th>Qualification</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\Auth::User()->member->qualifications()->get() as $qualifications)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$qualifications->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-4">{{$qualifications->name}}</td>
                                                                                    <td class="col-lg-6">{{$qualifications->pivot->note}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Service History for this member.</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Awards</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\Auth::User()->member->awards->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Awarded</th>
                                                                            <th>Award</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\Auth::User()->member->awards()->orderBy('date','desc')->get() as $awards)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d',$awards->date)->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-4">{{$awards->name}}</td>
                                                                                    <td class="col-lg-6">{{$awards->pivot->note}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Awards for this member.</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Training Programs</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\Auth::User()->member->serviceHistory->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Awarded</th>
                                                                            <th>Qualification</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\Auth::User()->member->qualifications()->get() as $qualifications)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$qualifications->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-4">{{$qualifications->name}}</td>
                                                                                    <td class="col-lg-6">{{$qualifications->pivot->note}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Training Programs for this member.</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4>Paperwork</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\Auth::User()->member->paperwork->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Filed</th>
                                                                            <th>Type</th>
                                                                            <th>Status</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\Auth::User()->member->paperwork()->where('type','!=', 'bad-conduct')->get() as $paperwork)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{$paperwork->created_at->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-5">{{$paperwork->getType()}}</td>
                                                                                    <td class="col-lg-5">{!! $paperwork->getStatus() !!}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Paperwork for this member.</p>
                                                                    @endif
                                                                </div><!--panel-body-->
                                                            </div><!--panel-->
                                                        </div><!--col-xs-12-->
                                                    </div><!--row-->

                                                </div><!--col-md-8-->

                                            </div><!--row-->

                                        </div><!--panel body-->

                                    </div><!-- panel -->

                                </div><!-- col-md-10 -->

                            </div><!-- row -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


