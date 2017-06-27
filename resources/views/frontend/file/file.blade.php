@extends('frontend.templates.master')

@section('title','My File')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">{{$member}}</li>
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
                                    <h2><a href="#">View File</a></h2>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">{{$member}}</div>

                                        <div class="panel-body well">

                                            <div class="row">

                                                <div class="col-md-4 col-md-push-8">

                                                    <ul class="media-list">
                                                        <li class="media">
                                                            <div class="media-left">
                                                                <img class="media-object" src="{{$member->avatar}}" alt="Profile picture">
                                                            </div><!--media-left-->

                                                            <div class="media-body">
                                                                <h4 class="media-heading">
                                                                    {{$member}}<br/>
                                                                    <small>
                                                                        {{$member->position}}<br/>
                                                                        <a href="{{route('frontend.team',$member->team->id)}}">{{$member->team->name}}</a> <br/>
                                                                        Military ID: {{$member->user->steam_id}} <br/>
                                                                        Time in Service: {{$member->time_in_service}} days<br/>
                                                                    </small>
                                                                    <br>
                                                                    @if($member->hasReportedIn())
                                                                        <span class="label label-success">Reported in</span>
                                                                    @else
                                                                        <span class="label label-danger">Pending Report in</span>
                                                                    @endif

                                                                    @if($member->onLOA())
                                                                        {!! $member->getLOAStatus() !!}
                                                                    @endif
                                                                </h4>


                                                            </div><!--media-body-->
                                                        </li><!--media-->
                                                    </ul><!--media-list-->
                                                    <br>
                                                    <div class="panel-body text-center">
                                                        <img src="{{$member->showCAC()}}">
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
                                                                    @if(count($member->ribbons) > 0)
                                                                    <div class="row">
                                                                        <?php $i = 3; ?>
                                                                        @foreach($member->ribbons as $ribbon)
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
                                                                    @if($member->serviceHistory->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($member->serviceHistory()->orderBy('date','desc')->get() as $serviceHistory)
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
                                                                    <h4>Awards</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if($member->awards->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Awarded</th>
                                                                            <th>Award</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($member->awards()->get() as $awards)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$awards->pivot->awarded_at)->toFormattedDateString()}}</td>
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
                                                                    <h4>Qualifications</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if($member->qualifications->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Awarded</th>
                                                                            <th>Qualification</th>
                                                                            <th>Note</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach($member->qualifications as $qualifications)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$qualifications->pivot->awarded_at)->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-8">{{$qualifications->name}}</td>
                                                                                    <td class="col-lg-2"><img src="{{$qualifications->getImage()}}"></td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        <small><a href="https://icons8.com">Icon pack by Icons8</a></small>
                                                                    @else
                                                                        <p>No Qualifications for this member.</p>
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
                                                                    <h4>Disciplinary History</h4>
                                                                </div><!--panel-heading-->

                                                                <div class="panel-body">
                                                                    @if(\App\Models\Unit\Paperwork::disciplinary()->where('disciplinary_member_id',$member->id)->get()->count() > 0)
                                                                        <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                                            <thead>
                                                                            <th>Date Filed</th>
                                                                            <th>Type</th>
                                                                            <th>Status</th>
                                                                            </thead>
                                                                            <tbody>
                                                                            @foreach(\App\Models\Unit\Paperwork::disciplinary()->where('disciplinary_member_id',$member->id)->orderBy('created_at','desc')->get() as $paperwork)
                                                                                <tr>
                                                                                    <td class="col-lg-2">{{$paperwork->created_at->toFormattedDateString()}}</td>
                                                                                    <td class="col-lg-5"><a href="{{route($paperwork->getDisciplinaryRoute(),$paperwork->id)}}">{{$paperwork->getType()}}</a></td>
                                                                                    <td class="col-lg-5">{!! $paperwork->getStatus() !!}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    @else
                                                                        <p>No Disciplinary Record.</p>
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


