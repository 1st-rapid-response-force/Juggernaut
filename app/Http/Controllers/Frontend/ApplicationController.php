<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    public function showApply()
    {
        return view('frontend.apply.apply');
    }

    public function showApplication($type)
    {
        if(($type == 'officer')||$type == 'nco' || $type == 'enlisted')
        {
            return view('frontend.apply.application', ['type' => $type]);
        } else {
            flash('There is no application for this type.','danger');
            return redirect()->back();
        }

    }

}
