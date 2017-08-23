<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Operation;
use App\Models\Unit\OperationFrago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::all();
        return view('frontend.operations.index');
    }

    public function show($id)
    {
        $operation = Operation::findOrFail($id);
        return view('frontend.operations.show',['operation' => $operation]);

    }

    public function storeStatusMember($id, Request $request)
    {
        $operation = Operation::findOrFail($id);
        // Make sure there is no duplicate entries
        if(!$operation->members->contains(\Auth::User()->member->id))
        {
            if($request->status != 50)
            {
                $operation->members()->attach(\Auth::User()->member->id, ['status' => $request->status]);
                flash('Your Operational Status has been recorded!', 'success');
                return redirect()->back();
            } else {
                flash('You have selected an invalid status code. Please try again', 'warning');
                return redirect()->back();
            }
        } else {
            $operation->members()->detach(\Auth::User()->member->id);
            $operation->members()->attach(\Auth::User()->member->id, ['status' => $request->status]);
            flash('You have updated your operational status!', 'success');
            return redirect()->back();
        }
    }

    public function showFrago($id, $frago)
    {
        $operation = Operation::findOrFail($id);
        $frago = OperationFrago::findOrFail($frago);
        return view('frontend.operations.frago',['operation' => $operation,'frago' => $frago]);
    }
}