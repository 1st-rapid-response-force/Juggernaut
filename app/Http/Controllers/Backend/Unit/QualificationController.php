<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Qualification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::all();
        return view('backend.unit.qualifications.index',['qualifications'=> $qualifications]);
    }

    public function edit($id)
    {
        $qualifications = Qualification::findOrFail($id);
        return view('backend.unit.qualifications.edit',['qualification'=> $qualifications]);
    }

    public function update(Request $request,$id)
    {
        $qualifications = Qualification::findOrFail($id);
        $qualifications->update($request->all());
        if($request->hasFile('qualification_image'))
        {
            $qualifications->clearMediaCollection('image');
            $qualifications->addMedia($request->file('qualification_image'))->toCollection('image');
        }
        flash('You updated a Qualification!', 'success');
        return redirect()->back();
    }


    public function store(Request $request)
    {
        $qualifications = Qualification::create($request->all());
        if($request->hasFile('qualification_image'))
        {
            $qualifications->clearMediaCollection('image');
            $qualifications->addMedia($request->file('qualification_image'))->toCollection('image');
        }
        flash('You created a qualification!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $qualifications = Qualification::findOrFail($id);
        $qualifications->delete();
        flash('You deleted a qualification!', 'success');
        return redirect()->back();
    }
}
