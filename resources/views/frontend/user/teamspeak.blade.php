@extends('frontend.templates.master')

@section('title','Teamspeak')

@section('content')
    <!-- wrapper -->
    <section class="bg-grey-50 border-bottom-1 border-grey-300 padding-10">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Teamspeak</li>
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
                                    <h2>Settings - Teamspeak</h2>
                                </div>
                            </div>
                            <p>All of your teamspeak accounts must be tied to the central database in order to ensure all ranks, permissions, and groups are synced to all of your teamspeak clients. </p>
                            <p>You can find your Unique ID in Teamspeak Application by opening the Setting->Identities (CTRL+I), it will be the "Unique ID" value in your active profile.</p>

                            <table class="table table-condensed">
                                <thead>
                                <th>Device Description</th>
                                <th>UUID</th>
                                <th></th>
                                </thead>
                                <tbody>
                                @if(\Auth::User()->member->teamspeak->count() > 0)
                                    @foreach(\Auth::User()->member->teamspeak as $teamspeak)
                                        <tr>
                                            <td>{{$teamspeak->description}}</td>
                                            <td>{{$teamspeak->uuid}}</td>
                                            <td><a href="{{ route('frontend.settings.teamspeak.delete',$teamspeak->id) }}" data-method="delete" rel="nofollow" data-confirm="Are you sure you want to delete this?" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>No Teamspeak UUID on File, add one</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            <br>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#teamspeak">
                                Add Teamspeak UUID
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="teamspeak" tabindex="-1" role="dialog" aria-labelledby="teamspeak">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="teamspeak">Add Teamspeak UUID</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST">
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <input type="text" name="description" class="form-control" placeholder="Device Description - Main Computer, Cellphone, Laptop" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="uuid" class="form-control" placeholder="Unique ID" required>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Teamspeak ID</button>
                                            </form>
                                        </div>
                                    </div>
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