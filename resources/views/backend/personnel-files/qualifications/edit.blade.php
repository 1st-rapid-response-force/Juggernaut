@extends ('backend.layouts.master')

@section ('title', trans('labels.backend.personnel-files.qualifications.management') . ' | ' . trans('labels.backend.personnel-files.qualifications.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.personnel-files.qualifications.management') }}
        <small>{{ trans('labels.backend.personnel-files.qualifications.edit') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => ['admin.personnel-file.qualification.update',$qualification->id], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'files' => true]) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.personnel-files.qualifications.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.personnel-files.includes.partials.qualification-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.unit.qualifications.name'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::text('name', $qualification->name, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.qualifications.name'),'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('description', trans('validation.attributes.backend.unit.qualifications.description'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('description', $qualification->description, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.unit.qualifications.description')]) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('published', trans('validation.attributes.backend.unit.qualifications.published'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-1">
                        {{ Form::hidden('published',0) }}
                        {{ Form::checkbox('published', '1', $qualification->published) }}
                    </div><!--col-lg-1-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('picture', trans('validation.attributes.backend.unit.qualifications.picture'), ['class' => 'col-lg-2 control-label']) }}

                    <div class="col-lg-1">
                        {{ Form::file('picture') }}
                        <br>
                        @if($media->count() > 0)
                        <img src="{{$media[0]->getUrl()}}" class="img img-thumbnail">
                        @endif
                    </div><!--col-lg-1-->
                </div><!--form control-->


            </div><!-- /.box-body -->
        </div><!--box-->

        <div class="box box-info">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.personnel-file.qualification.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@stop

@section('after-scripts-end')

@stop
