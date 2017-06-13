<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Loadout;
use App\Models\Unit\Qualification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoadoutController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loadouts = Loadout::where('empty','=','0')->get();
        $qualifications = Qualification::all();
        return view('backend.unit.loadout.index')
            ->with('loadouts',$loadouts)
            ->with('qualifications',$qualifications);
    }
    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        return redirect(route('admin.loadouts.index'));
    }
    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        // Validate Form
        $this->validate($request, [
            'name' => 'required|string',
            'category'=>'required',
            'class_name' => 'required|string',
            'qualification_id'=>'required',
            'img' => 'required|image',
        ]);
        // Create and Process Model
        $loadout = new Loadout();
        $loadout->name = $request->name;
        $loadout->category = $request->category;
        $loadout->class_name = $request->class_name;
        $loadout->empty = $request->empty;
        $loadout->qualification_id = $request->qualification_id;
        $loadout->save();



        if($request->hasFile('img'))
        {
            $loadout->addMedia($request->img)->toCollection('image');
        }

        flash('Loadout item was added successfully','success');
        return redirect(route('admin.loadouts.index'));
    }


    public function show($id)
    {
        return redirect(route('admin.loadouts.index'));
    }


    public function edit($id)
    {
        $loadout = Loadout::find($id);
        $qualifications = Qualification::all();
        return view('backend.loadout.edit')
            ->with('loadout',$loadout)
            ->with('qualifications',$qualifications);
    }
    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $loadout = Loadout::find($id);
        // Validate Form
        $this->validate($request, [
            'name' => 'required|string',
            'category'=>'required',
            'class_name' => 'required|string',
            'qualification_id'=>'required',
            'img' => 'image',
        ]);

        // Update Model
        $loadout->name = $request->name;
        $loadout->category = $request->category;
        $loadout->class_name = $request->class_name;
        $loadout->empty = $request->empty;
        $loadout->qualification_id = $request->qualification_id;
        $loadout->save();

        //If the update has a file deal with files first
        if($request->hasFile('img'))
        {
            $loadout->clearMediaCollection('image');
            $loadout->addMedia($request->file('img'))->toCollection('image');
        }


        flash('Loadout item was updated successfully','success');
        return redirect(route('admin.loadouts.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $loadout = Loadout::find($id);
        $loadout->delete();

        flash('Loadout item was deleted successfully','success');
        return redirect(route('admin.loadouts.index'));
    }
}
