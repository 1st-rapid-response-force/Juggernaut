<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Award;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    public function index()
    {
        $awards = Award::all();
        return view('backend.unit.awards.index',['awards'=> $awards]);
    }

    public function edit($id)
    {
        $awards = Award::findOrFail($id);
        return view('backend.unit.awards.edit',['award'=> $awards]);
    }

    public function update(Request $request,$id)
    {
        $awards = Award::findOrFail($id);
        $awards->update($request->all());
        if($request->hasFile('award_image'))
        {
            $awards->clearMediaCollection('image');
            $awards->addMedia($request->file('award_image'))->toCollection('image');
        }
        flash('You updated a award!', 'success');
        return redirect()->back();
    }


    public function store(Request $request)
    {
        $awards = Award::create($request->all());
        if($request->hasFile('award_image'))
        {
            $awards->clearMediaCollection('image');
            $awards->addMedia($request->file('award_image'))->toCollection('image');
        }
        flash('You created a award!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $awards = Award::findOrFail($id);
        $awards->delete();
        flash('You deleted a award!', 'success');
        return redirect()->back();
    }
}
