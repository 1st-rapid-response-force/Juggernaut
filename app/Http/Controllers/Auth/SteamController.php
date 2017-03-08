<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Alert;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SteamController extends Controller
{
    public function validateSteam()
    {
        $steam_id = \SteamLogin::validate();
        $user = User::where('steam_id',$steam_id)->first();
        if (is_null($user)) {
            Alert::error('No user found with that steam id.');
            return redirect(route('frontend.index'));
        } else {
            \Auth::login($user,true);
            Alert::success('You have logged in successfully.');
            return redirect()->intended();
        }
    }

    public function loginPage()
    {
        return view('frontend.pages.login');
    }

    public function logout()
    {
        \Auth::logout();
        Alert::success('You have logged out successfully.');
        return redirect(route('frontend.index'));
    }
}
