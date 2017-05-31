@extends('frontend.templates.master')

@section('title','Our Structure')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-parallax height-450 parallax" style="background-image: url(img/pages/structure.png);"></section>
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">Our Structure</li>
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
                                    <h2><a href="#">Our Structure & Ranks</a></h2>
                                </div>
                            </div>

                            <h2>Structure</h2>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#command" aria-controls="assignments" role="tab" data-toggle="tab">Command</a></li>
                                <li role="presentation"><a href="#infantry" aria-controls="structure" role="tab" data-toggle="tab">Infantry</a></li>
                                <li role="presentation"><a href="#aviation" aria-controls="structure" role="tab" data-toggle="tab">Aviation</a></li>
                                <li role="presentation"><a href="#special" aria-controls="structure" role="tab" data-toggle="tab">Special Operations</a></li>
                                <li role="presentation"><a href="#reserve" aria-controls="structure" role="tab" data-toggle="tab">Reserve Pool</a></li>
                                <li role="presentation"><a href="#discharged" aria-controls="structure" role="tab" data-toggle="tab">Discharges</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="command">
                                    @if(($command->members->count() > 0))
                                        <h4><strong><a href="{{route('frontend.team',$command->id)}}">{{$command->name}}</a></strong></h4>
                                        @foreach($command->members as $member)
                                            <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$member->searchable_name}}  - {{$member->position}}</a></br>
                                        @endforeach
                                    @else
                                        <h4><strong><a href="{{route('frontend.team',$command->id)}}">{{$command->name}}</a></strong></h4>
                                        <p>There are currently no members in this group.</p>
                                    @endif
                                </div>

                                <div role="tabpanel" class="tab-pane" id="infantry">
                                    <h4><strong><a href="{{route('frontend.team',3)}}">1st Platoon - Command</a></strong></h4>
                                    <img src="{{$oges->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$oges->id)}}">{{$oges->searchable_name}} - Platoon Leader</a></br>

                                @foreach($infantryGroups as $group)
                                        @if(($group->members->count() > 0))
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                        @foreach($group->members as $member)
                                                <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$member->searchable_name}} - {{$member->position}}</a></br>
                                            @endforeach
                                        @else
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                            <p>There are currently no members in this group.</p>
                                        @endif
                                    @endforeach
                                </div>

                                <div role="tabpanel" class="tab-pane" id="aviation">
                                    @foreach($aviationGroups as $group)
                                        @if(($group->members->count() > 0))
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                            @foreach($group->members as $member)
                                                <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$member->searchable_name}} - {{$member->position}}</a></br>
                                            @endforeach
                                        @else
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                            <p>There are currently no members in this group.</p>
                                        @endif
                                    @endforeach
                                </div>

                                <div role="tabpanel" class="tab-pane" id="special">
                                    <h4><strong>Special Operations</strong></h4>
                                    <p>This group is currently closed.</p>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="reserve">
                                    @if(($reserve->members->count() > 0))
                                        <h4><strong><a href="{{route('frontend.team',$reserve->id)}}">{{$reserve->name}}</a></strong></h4>
                                        @foreach($reserve->members as $member)
                                            <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$member->id)}}"> {{$member->searchable_name}} - {{$member->position}}</a></br>
                                        @endforeach
                                    @else
                                        <h4><strong><a href="{{route('frontend.team',$reserve->id)}}">{{$reserve->name}}</a></strong></h4>
                                        <p>There are currently no members in this group.</p>
                                    @endif
                                </div>

                                <div role="tabpanel" class="tab-pane" id="discharged">
                                    @if(($discharged->count() > 0))
                                        <h4><strong>Discharged</strong></h4>
                                        @foreach($discharged as $member)
                                            <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$member->id)}}"> {{$member->searchable_name}} - {{$member->position}}</a></br>
                                        @endforeach
                                    @else
                                        <h4><strong>Discharged</strong></h4>
                                        <p>There are currently no members in this group.</p>
                                    @endif
                                </div>
                            </div>

                            <div style="padding-bottom: 50px"></div>
                            <hr>
                            <div style="padding-top: 50px"></div>
                            <h2>Ranks</h2>
                            <p>We use a rank structure based on the US Army to create a rich experience and atmosphere.</p>

                            <h3>Officer Ranks</h3>
                            <div class="text-center">
                                <table class="table table-hover" id="ranks">
                                    <thead>
                                    @foreach($officerRanks as $rank)
                                        <th ><img style="max-width: 100px; max-height: 100px; border: none;" class="center-block" src="{{$rank->image}}"></th>
                                    @endforeach
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($officerRanks as $rank)
                                            <td><strong>{{$rank->name}}</strong><br>{{$rank->abbreviation}}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3>Warrant Ranks</h3>
                            <div class="text-center">
                                <table class="table table-hover" id="ranks">
                                    <thead>
                                    @foreach($warrantRanks as $rank)
                                        <th><img style="max-width: 100px; max-height: 100px; border: none;" class="center-block" src="{{$rank->image}}"></th>
                                    @endforeach
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($warrantRanks as $rank)
                                            <td><strong>{{$rank->name}}</strong><br>{{$rank->abbreviation}}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3>Enlistment Ranks</h3>
                            <div class="text-center">
                                <table class="table table-hover" id="ranks">
                                    <thead>
                                    @foreach($enlistedRanks as $rank)
                                        <th><img style="max-width: 100px; max-height: 100px; border: none;" class="center-block" src="{{$rank->image}}"></th>
                                    @endforeach
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @foreach($enlistedRanks as $rank)
                                            <td><strong>{{$rank->name}}</strong><br>{{$rank->abbreviation}}</td>
                                        @endforeach
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection