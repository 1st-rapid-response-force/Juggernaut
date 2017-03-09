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

                            <p>Your Common Access Card is your identification in this unit. You can select a default face for you account here. Make sure to set up the same face in game.</p>
                            <form method="post">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-success" value="Save Face Preference"> <a href="{{route('frontend.files.my-file')}}" class="btn btn-danger">Cancel</a>
                                        <br><br>
                                    </div>
                                </div>

                                <div class="row text-center">
                                    <?php $i = 1; ?>
                                    @foreach($faces as $face)
                                        <div class="col-md-3">
                                            <div class="panel-body">
                                                <img class="img-thumbnail" style="width: 146px; height:179px;" src="{{$face['file']}}"><br>
                                                <small><strong>ARMA Name:</strong> {{$face['name']}}</small>
                                                <input class="form-control" type="radio" name="face_id" value="{{$face['id']}}" {{($user->member->face_id == $face['id']) ? 'checked' : ''}}>
                                            </div>
                                        </div>

                                <?php if (($i != 0) && (($i % 4) == 0)) echo '</div><div class="row text-center">'; ?>
                                <?php $i++; ?>
                                @endforeach
                            </form>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /#wrapper -->
@endsection


