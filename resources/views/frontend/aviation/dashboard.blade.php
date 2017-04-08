@extends('frontend.templates.master')

@section('title','Aviation Dashboard')

@section('content')
    <div id="wrapper">
        <section class="padding-top-50 padding-bottom-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">Aviation Dashboard</a></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Flight Plans
                                        </div><!--panel-body-->
                                        <div class="panel-body">
                                            @if(App\Models\Unit\Paperwork::where('type','flight-plan')->get()->count() > 0)
                                                <table class="table table-bordered table-condensed table-hover" id="serviceHistoryTable">
                                                    <thead>
                                                    <th>ID</th>
                                                    <th>Filed by</th>
                                                    <th>Status</th>
                                                    <th>Filed on</th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach(App\Models\Unit\Paperwork::where('type','flight-plan')->orderBy('created_at','desc')->get() as $paperwork)
                                                        <tr>
                                                            <td class="col-lg-2"><a href="{{route('frontend.paperwork.show', $paperwork->id)}}">#RRF-FL-{{$paperwork->id}}</a></td>
                                                            <td class="col-lg-4">{{$paperwork->member->searchable_name}}</td>
                                                            <td class="col-lg-4">{!! $paperwork->getStatus() !!}</td>
                                                            <td class="col-lg-2">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$paperwork->created_at)->toFormattedDateString()}}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>No Flight Plans filed.</p>
                                            @endif
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div>
                                <div class="col-lg-4">
                                    <div class="panel panel-default">

                                        <div class="panel-body">
                                            <a href="{{route('frontend.paperwork.aviation.flight-plan')}}" class="btn btn-info btn-block">File Flight Plan</a>


                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


@section('after-scripts-end')

@endsection