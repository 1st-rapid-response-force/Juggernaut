@extends('frontend.templates.master')

@section('title','Home')

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="hero hero-games height-600" style="background-image: url({{$team->header_image or $team->randomHeader()}});">
            <div class="hero-bg"></div>
            <div class="container">
                <div class="page-header">
                    <div class="page-title bold"><a href="#">{{$team->name}}</a></div>
                    <p>{{$team->motto}}</p>
                    <p><img src="{{$team->team_image}}" class="center-block"></p>
                    <br>
                </div>
            </div>
        </section>

        @include('frontend.team.include.nav')
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.team',$team->id)}}">{{$team->name}}</a></li>
                    <li><a href="{{route('frontend.team.leader',$team->id)}}">Leader Panel</a></li>
                    <li class="active"><a href="{{route('frontend.team.leader.positions',$team->id)}}">Position Management</a></li>
                </ol>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="post post-fl">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2>Team Positions</h2>
                                </div>
                            </div>
                            {{ Form::open(['route' => ['frontend.team.leader.positions.post',$team->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                            @if (count($team->members) != 0)
                                @if (count($team->members) != 0)
                                    <table id="table" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Leader</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($team->members as $member)
                                            <input type="hidden" name="userForm[{{$member->id}}][id]" value="{{$member->id}}">
                                            <tr>
                                                <td>{{$member->searchable_name}}</td>
                                                <td>@include('frontend.team.leader.include.positions')</td>
                                                <td class="col-lg-1">
                                                    <input type="hidden" name="userForm[{{$member->id}}][team_leader]" value="0">
                                                    <input type="checkbox" name="userForm[{{$member->id}}][team_leader]" value="1" {{$member->team_leader ? 'checked' : ''}} {{($team->leader_id == $member->user->id) ? 'disabled' : ''}}>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>There is no members in this group.</p>
                                @endif
                            @endif

                                <div class="form-group pull-right">
                                    <input type="submit" class="btn btn-primary">
                                </div>
                            {{ Form::close() }}

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /#wrapper -->

@endsection

@section('after-scripts-end')
    <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'content', {
                height: 400
            });
        });
    </script>
@endsection