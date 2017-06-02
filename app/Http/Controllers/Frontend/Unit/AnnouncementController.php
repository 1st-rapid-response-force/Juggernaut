<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::paginate(4);
        return view('frontend.announcements.index',['announcements' => $announcements]);
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('frontend.announcements.show',['announcement' => $announcement]);
    }
}
