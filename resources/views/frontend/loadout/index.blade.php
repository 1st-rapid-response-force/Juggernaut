@extends('frontend.templates.master')

@section('title','Loadout')

@section('content')
    <!-- wrapper -->
    <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="{{route('frontend.files.my-file')}}">{{\Auth::User()->member}}</a></li>
                <li class="active">Loadout</li>
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
                                    <h2>Loadout</h2>
                                </div>
                            </div>
                            {{ Form::open(['class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => false]) }}
                            <p>You will be able to outfit your solider here. You can unlock more weapons and equipment by earning qualifications.</p>

                            <hr>
                            <div class="row">
                                <div class="col-lg-4 well">
                                    <h3>Weapons</h3>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#primaryCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Primary Weapons
                                    </a><br><br>
                                    <div class="collapse" id="primaryCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($primary as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="primaryWeapon" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#primaryAttachCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Primary Weapon Attachment
                                    </a><br><br>
                                    <div class="collapse" id="primaryAttachCollapse">
                                        <div class="well scrolldivMulti">
                                            <p>Make sure the attachment you have selected is compatible</p>
                                            @foreach($primary_attachments as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this attachment? - <input type="checkbox" name="primary_attachment[]" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#secondaryCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Sidearm Weapons
                                    </a><br><br>
                                    <div class="collapse" id="secondaryCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($secondary as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this attachment? - <input type="radio" name="secondary" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#secondaryAttachCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Sidearm Weapon Attachment
                                    </a><br><br>
                                    <div class="collapse" id="secondaryAttachCollapse">
                                        <div class="well scrolldivMulti">
                                            <p>Make sure the attachment you have selected is compatible</p>
                                            @foreach($secondary_attachments as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this attachment? - <input type="checkbox" name="secondary_attachment[]" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#launcherCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Launcher Weapons
                                    </a><br><br>
                                    <div class="collapse" id="launcherCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($launcher as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="launcherWeapons" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <img class="center-block" src="/img/loadouts/infantry.png">
                                    <div class="text-center"><h4>{{\Auth::User()->member->position}}</h4></div>
                                </div>
                                <div class="col-lg-4 well">
                                    <h3>Uniform & Aesthetics</h3>

                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#helmetCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Helmet
                                    </a><br><br>
                                    <div class="collapse" id="helmetCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($helmet as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="helmet" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#uniformCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Uniform
                                    </a><br><br>
                                    <div class="collapse" id="uniformCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($uniform as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="uniform" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#vestCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Vest
                                    </a><br><br>
                                    <div class="collapse" id="vestCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($vest as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="vest" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#backpackCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Backpack
                                    </a><br><br>
                                    <div class="collapse" id="backpackCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($backpack as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="backpack" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#nightVisionCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Nightvision
                                    </a><br><br>
                                    <div class="collapse" id="nightVisionCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($nightvision as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="nightvision" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#gogglesCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Goggles
                                    </a><br><br>
                                    <div class="collapse" id="gogglesCollapse">
                                        <div class="well scrolldiv">
                                            @foreach($goggles as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="radio" name="goggles" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <a class="btn btn-primary btn-block btn-sm" role="button" data-toggle="collapse" href="#itemsCollapse" aria-expanded="false" aria-controls="collapseExample">
                                        Items
                                    </a><br><br>
                                    <div class="collapse" id="itemsCollapse">
                                        <div class="well scrolldivMulti">
                                            @foreach($items as $loadout)
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" style="max-height: 75px; max-width: 75px;" class="img-thumbnail" src="{{$loadout['imageSrc']}}">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">{{$loadout['text']}}</h5>
                                                        <p><small>Select this weapon? - <input type="checkbox" name="items[]" {{($loadout['selected'] == true) ? 'checked' : ''}} value="{{$loadout['value']}}"></small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="launcher_attachment" value="15">
                            <button type="submit" class="btn btn-success pull-right">Save Loadout</button>
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
            CKEDITOR.replace( 'signature', {
                height: 300
            });
        });
    </script>
@endsection