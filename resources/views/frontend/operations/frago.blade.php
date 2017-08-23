@extends('frontend.templates.master')

@section('title', $operation->name)

@section('content')
    <!-- wrapper -->
    <div id="wrapper">
        <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{route('frontend.operations')}}">Operations</a> </li>
                    <li><a href="{{route('frontend.operations.show', $operation->id)}}">{{$operation->name}}</a></li>
                    <li class="active">FRAGO - {{$operation->name}}</li>
                </ol>
            </div>
        </section>

        <section class="padding-top-50 padding-bottom-50 padding-top-sm-30">
            <div class="container">
                <div class="row sidebar">
                    <div class="col-md-9 leftside">
                        <div class="post post-single">
                            <div class="post-header">
                                <div class="post-title">
                                    <h2><a href="#">{{$operation->name}} - FRAGO </a></h2>
                                    <ul class="post-meta">
                                        <li><i class="fa fa-calendar-o"></i> {{$operation->start_time->toFormattedDateString()}}</li>
                                    </ul>
                                </div>
                            </div>
                            {!! $frago->message !!}
                        </div>
                    </div>


                    <div class="col-md-3 rightside">
                        <h3>Accountability</h3>
                        <hr>
                        <div class="widget widget-list">
                            <div class="title">Options</div>
                            <p>Your Status: {!! $operation->getOperationalStatus(\Auth::User()->member->id) !!}</p>

                            @if(\Carbon\Carbon::now() < $operation->start_time)
                                {!! Form::open(['route' => ['frontend.operations.store.status',$operation->id], 'method' => 'POST', 'role' => 'form']) !!}
                                <div class="form-group">
                                    {{ Form::label('status', 'Will You Be Able to Attend:', ['class' => 'control-label']) }}

                                        <select name="status" class="form-control">
                                            <option value="50" {{$operation->getOperationalStatusCode(\Auth::User()->member->id) == 50 ? 'selected' : ''}}>Pending Response</option>
                                            <option value="1" {{$operation->getOperationalStatusCode(\Auth::User()->member->id) == 1 ? 'selected' : ''}}>Will Attend</option>
                                            <option value="0" {{$operation->getOperationalStatusCode(\Auth::User()->member->id) == 0 ? 'selected' : ''}}>Cannot Attend</option>
                                        </select>
                                </div><!--form control-->
                                {{ Form::submit('Save', ['class' => 'btn btn-success btn-xs']) }}
                                {!! Form::close() !!}
                            @endif

                        </div>

                        <div class="widget widget-list">
                            <div class="title">Required Elements</div>
                            <ul>
                                @foreach($operation->getAccountability()['required'] as $group)
                                    <li><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="widget widget-list">
                            <div class="title">Optional Elements</div>
                            <ul>
                                @foreach($operation->getAccountability()['optional'] as $group)
                                    <li><strong><a href="{{route('frontend.team',$group->id)}}">{{$group->name}}</a></strong></li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </section>



@endsection