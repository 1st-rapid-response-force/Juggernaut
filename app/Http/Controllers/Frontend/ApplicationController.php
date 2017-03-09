<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Apply\CreateApplicationRequest;

class ApplicationController extends Controller
{
    public function showApply()
    {
        return view('frontend.apply.apply');
    }

    public function showApplication($type)
    {
        $user = \Auth::User();
        if (!count($user->application)) {

            if (($type == 'officer') || $type == 'nco' || $type == 'enlisted') {
                return view('frontend.apply.application', ['type' => $type]);
            } else {
                flash('There is no application for this type.', 'danger');
                return redirect()->back();
            }
        } else {
            flash('You have already submitted an application.', 'danger');
            return redirect()->back();
        }
    }

    public function postApplication(CreateApplicationRequest $request)
    {
        $user = \Auth::User();
        $appInput = collect($request->all());
        $appModel = $user->application()->create(['application' => $appInput->toJson()]);

        // Change name from app
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        // We need to check the type in order to redirect them accordingly (also assign interview)
        if(($request->type == 'officer') || ($request->type == 'nco'))
        {
            // TODO: I need to unfuck this later
            $appModel->interview_required = true;
            $appModel->interview_id = mt_rand(1,3);
            $appModel->save();
        }

        return redirect(route('frontend.apply.application.success'));
    }

    public function successApplication()
    {
        $user = \Auth::User();
        if (count($user->application))
        {
            return view('frontend.apply.completed');
        } else {
            flash('You need to complete an application before accessing this page.','danger');
            return redirect(route('frontend.apply'));
        }

    }

}
