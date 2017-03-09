<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Ribbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RibbonController extends Controller
{
    public function index()
    {
        $ribbons = Ribbon::all();
        return view('backend.unit.ribbons.index',['ribbons'=> $ribbons]);
    }

    public function edit($id)
    {
        $ribbon = Ribbon::findOrFail($id);
        return view('backend.unit.ribbons.edit',['ribbon'=> $ribbon]);
    }

    public function update(Request $request,$id)
    {
        $ribbon = Ribbon::findOrFail($id);
        $ribbon->update($request->all());
        if($request->hasFile('ribbon_image'))
        {
            $ribbon->clearMediaCollection('image');
            $ribbon->addMedia($request->file('ribbon_image'))->toCollection('image');
        }
        flash('You updated a ribbon!', 'success');
        return redirect()->back();
    }


    public function store(Request $request)
    {
        $ribbon = Ribbon::create($request->all());
        if($request->hasFile('ribbon_image'))
        {
            $ribbon->clearMediaCollection('image');
            $ribbon->addMedia($request->file('ribbon_image'))->toCollection('image');
        }
        flash('You created a ribbon!', 'success');
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $ribbon = Ribbon::findOrFail($id);
        $ribbon->delete();
        flash('You deleted a ribbon!', 'success');
        return redirect()->back();
    }
}
