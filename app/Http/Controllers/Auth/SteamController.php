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
        // If not found make them register or login
        if (is_null($user)) {
            \Log::info('New user', ['steam_id' => $steam_id]);
            return view('frontend.user.register', ['steam_id' => $steam_id]);
        } else {
            \Log::info('User logged in', ['user_id' => $user->id, 'steam_id' => $steam_id]);
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
        $user = \Auth::User();
        \Log::info('User logged out', ['user_id' => $user->id]);
        \Auth::logout();
        Alert::success('You have logged out successfully.');
        return redirect(route('frontend.index'));
    }

    public function registerUser(Request $request)
    {
        $user = User::create($request->all());
        \Auth::login($user,true);
        Alert::success('Your account has been created, please fill out the application.');
        return redirect(route('frontend.apply.application','infantry'));

    }
}
