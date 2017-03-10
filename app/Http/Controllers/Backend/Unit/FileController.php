<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Rank;
use App\Models\Unit\Team;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FileController extends Controller
{
    public function index()
    {
        $files = Member::all();
        return view('backend.unit.files.index',['files'=> $files]);
    }

    public function show($id)
    {
        $file = Member::findOrFail($id);
        $teams = Team::all();
        $ranks = Rank::all();
        return view('backend.unit.files.edit',['file'=> $file,'teams' => $teams,'ranks' => $ranks]);
    }

    public function update($id, Request $request)
    {
        $file = Member::findOrFail($id);
        $user = User::findOrFail($file->user->id);

        $file->update($request->member);
        $user->update($request->user);

        // Call Jobs
        \Artisan::call('member:avatar');
        \Artisan::call('member:searchable');
        \Artisan::call('member:squadxml');
        \Artisan::call('member:cac');

        flash('You updated a members file!', 'success');
        return redirect()->back();

    }
}
