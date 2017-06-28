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
                                <li role="presentation"><a href="#special" aria-controls="structure" role="tab" data-toggle="tab">Pending Assignment</a></li>
                                <li role="presentation"><a href="#reserve" aria-controls="structure" role="tab" data-toggle="tab">Reserve Pool</a></li>
                                <li role="presentation"><a href="#discharged" aria-controls="structure" role="tab" data-toggle="tab">Discharges</a></li>
                                <li role="presentation"><a href="#board" aria-controls="structure" role="tab" data-toggle="tab">Board Of Operations & Support</a></li>
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
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                            @foreach($group->assignments()->orderBy('order')->get() as $assignment)
                                                @if($assignment->members->count() >0)
                                                    @foreach($assignment->members as $member)
                                                    <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$assignment->name}} - {{$member->searchable_name}}</a></br>
                                                    @endforeach
                                                    @else
                                                    <img src="/img/avatars/background.png" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="#">{{$assignment->name}} - Unassigned</a></br>
                                                @endif
                                            @endforeach
                                    @endforeach
                                </div>

                                <div role="tabpanel" class="tab-pane" id="aviation">
                                    @foreach($aviationGroups as $group)
                                            <h4><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></h4>
                                            @foreach($group->assignments()->orderBy('order')->get() as $assignment)
                                                @if($assignment->members->count() >0)
                                                    @foreach($assignment->members as $member)
                                                        <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="{{route('frontend.files.file',$member->id)}}">{{$assignment->name}} - {{$member->searchable_name}}</a></br>
                                                    @endforeach
                                                @else
                                                    <img src="/img/avatars/background.png" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="#">{{$assignment->name}} - Unassigned</a></br>
                                                @endif
                                            @endforeach
                                    @endforeach
                                </div>

                                <div role="tabpanel" class="tab-pane" id="special">
                                    @if((\App\Models\Unit\Team::whereName('Pending Assignment')->first()->count() > 0))
                                        <h4><strong>Pending Assignment</strong></h4>
                                        @foreach(\App\Models\Unit\Team::whereName('Pending Assignment')->first()->members as $member)
                                            <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$member->id)}}"> {{$member->searchable_name}} - {{$member->position}}</a></br>
                                        @endforeach
                                    @else
                                        <h4><strong>Pending Assignment</strong></h4>
                                        <p>There are currently no members in this group.</p>
                                    @endif
                                </div>

                                <div role="tabpanel" class="tab-pane" id="reserve">
                                    @if((\App\Models\Unit\Member::active()->where('reserve',1)->get()->count() > 0))
                                        <h4><strong><a href="{{route('frontend.team',$reserve->id)}}">{{$reserve->name}}</a></strong></h4>
                                        @foreach(\App\Models\Unit\Member::active()->where('reserve',1)->get() as $member)
                                            <img src="{{$member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$member->id)}}"> {{$member->searchable_name}} - Reserve</a></br>
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

                                <div role="tabpanel" class="tab-pane" id="board">
                                    <p>The Board of Operations is in charge of providing oversight, electing the unit commander, and dealing with unit wide issues.</p>
                                    <?php

                                        $oges = \App\Models\Unit\Member::find(1);
                                        $rod = \App\Models\Unit\Member::find(2);
                                        $striker = \App\Models\Unit\Member::find(3);

                                    ?>
                                    <h4><strong><a href="#">Board of Operations</a></strong></h4>
                                    @foreach(\App\User::where('board_member',1)->get() as $user)
                                        <img src="{{$user->member->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$user->member->id)}}"> {{$user->member->searchable_name}} - Board Member</a></br>
                                    @endforeach

                                    <br><br>
                                    <h4><strong><a href="#">Support Department Leadership</a></strong></h4>
                                    <img src="{{$rod->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$rod->id)}}"> {{$rod->searchable_name}} - (S1) Web Design and Administration</a></br>
                                    <img src="/img/avatars/background.png" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="#">Unassigned - (S2) Unit Infrastructure Security</a></br>
                                    <img src="{{$oges->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$oges->id)}}"> {{$oges->searchable_name}} - (S3) Official Operations Mission Development and Management</a></br>
                                    <img src="{{$striker->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$striker->id)}}"> {{$striker->searchable_name}} - (S4) MODPACK/Capabilities Procurement and Testing</a></br>
                                    <img src="/img/avatars/background.png" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="#">Unassigned - (S5) Recruitment and Entry Management</a></br>
                                    <img src="/img/avatars/background.png" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"> <a href="#">Unassigned - (S6) Server and Infrastructure Management</a></br>
                                    <img src="{{$oges->avatar}}" class="img-circle" style="padding: 2px; height: 32px; width: 32px;"><a href="{{route('frontend.files.file',$oges->id)}}"> {{$oges->searchable_name}} - (S7) Doctrine Development</a></br>
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