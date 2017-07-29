@extends ('backend.layouts.master')

@section ('title', 'Overlord')

@section('after-styles-end')
    {{ Html::style("plugins/footable/css/footable.bootstrap.css") }}
@stop

@section('page-header')
    <h1>
        Overlord
    </h1>
@endsection

@section('content')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Overlord</h3>

            <div class="box-tools pull-right">
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="well">
                        <h4>AOR 1 <small>dedicated.1st-rrf.com:2302</small></h4>
                        <p>{!! $aor1->getStatus() !!}</p>
                        @if(isset($aor1->data))
                        <ul>
                            <li>CPU Usage: {{round($aor1->getData()->cpu,2)}}%</li>
                            <li>Memory Usage: {{round($aor1->getData()->memory,2)}}%</li>
                        </ul>
                        @endif

                        <br><br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="well">
                        <h4>AOR 2 <small>dedicated.1st-rrf.com:2312</small></h4>
                        <p>{!! $aor2->getStatus() !!}</p>
                        @if(isset($aor2->data))
                        <ul>
                            <li>CPU Usage: {{round($aor2->getData()->cpu,2)}}%</li>
                            <li>Memory Usage: {{round($aor2->getData()->memory,2)}}%</li>
                        </ul>
                        @endif

                        <br><br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="well">
                        <h4>Training Map <small>dedicated.1st-rrf.com:2322</small></h4>
                        <p>{!! $training->getStatus() !!}</p>
                        @if(isset($training->data))
                        <ul>
                            <li>CPU Usage: {{round($training->getData()->cpu,2)}}%</li>
                            <li>Memory Usage: {{round($training->getData()->memory,2)}}%</li>
                        </ul>
                        @endif

                        <br><br>
                    </div>
                </div>
            </div>

            <h3>Server Tools</h3>
            <div class="row">
                <div class="col-lg-4">
                    {!! Form::open(['route' => ['admin.overlord.updatemaps'],'class' => 'form-horizontal', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}
                    <button type="submit" class="btn btn-primary btn-block">Update Maps</button><br>
                    <small>Updating maps will restart all ARMA 3 server!</small>
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-4">
                    {!! Form::open(['route' => ['admin.overlord.startservers'],'class' => 'form-horizontal', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}
                    <button type="submit" class="btn btn-success btn-block">Start All Servers</button>
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-4">
                    {!! Form::open(['route' => ['admin.overlord.killservers'],'class' => 'form-horizontal', 'method' => 'POST', 'role' => 'form', 'files' => true]) !!}
                    <button type="submit" class="btn btn-danger btn-block">Kill All Servers</button>
                    {!! Form::close() !!}
                </div>
            </div>

        </div><!-- /.box-body -->
    </div><!--box-->

@stop

@section('after-scripts-end')
    {{ HTML::script('plugins/footable/js/footable.js') }}

    <script>
        jQuery(function($){
            $('.table').footable({
                "paging": {
                    "enabled": true,
                    "size": 100
                },
                "filtering": {
                    "enabled": true
                },
                "sorting": {
                    "enabled": true
                }
            });
        });
    </script>
@stop