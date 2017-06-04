@extends('frontend.templates.master')

@section('title','Disciplinary Management')

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
                    <li class="active"><a href="{{route('frontend.team.leader.training',$team->id)}}">Disciplinary Management</a></li>
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
                                    <h2>Disciplinary Management</h2>
                                </div>
                            </div>
                            <h4>Members:</h4>
                            @if (count($team->members) != 0)
                                @if (count($team->members) != 0)
                                    <table id="table" class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team->members as $member)
                                                <input type="hidden" name="userForm[{{$member->id}}][id]" value="{{$member->id}}">
                                                <tr>
                                                    <td>{{$member->searchable_name}}</td>
                                                    <td>
                                                        <a href="{{route('frontend.paperwork.disciplinary.ncs',$member->id)}}" class="btn btn-xs btn-warning">NCS</a>
                                                        <a href="{{route('frontend.paperwork.disciplinary.article',$member->id)}}" class="btn btn-xs btn-danger">Article 15</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>There is no members in this group.</p>
                                @endif
                            @endif

                            <hr>
                            <h4>Bad Conduct Reports:</h4>
                                @if (count(\App\Models\Unit\Paperwork::where('type','bad-conduct')->where('disciplinary_team_id',$team->id)->whereStatus(1)->get()) != 0)
                                    <table id="table" class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Report</th>
                                            <th>Against</th>
                                            <th>Filed By</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Models\Unit\Paperwork::where('type','bad-conduct')->where('disciplinary_team_id',$team->id)->whereStatus(1)->get() as $badconduct)
                                            <tr>
                                                <td>{{$badconduct->created_at->toDateString()}}</td>
                                                <td>{{$badconduct->getType()}}</td>
                                                <td>{{$badconduct->getPaperwork()->violator_name}}</td>
                                                <td>{{$badconduct->member->searchable_name}}</td>
                                                <td>
                                                    <a href="{{route('frontend.paperwork.show',$badconduct->id)}}" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View Bad Conduct Report"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>There is no bad conduct reports.</p>
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