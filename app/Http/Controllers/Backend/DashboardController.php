<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Unit\Member;
use App\Models\Unit\Perstat;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $members = Member::whereActive(1)->get()->count();
        $applications = Application::whereStatus(1)->get()->count();
        $perstat = Perstat::whereActive(1)->first();
        return view('backend.dashboard',['members' => $members,'applications' => $applications, 'perstat' => $perstat]);
    }
}