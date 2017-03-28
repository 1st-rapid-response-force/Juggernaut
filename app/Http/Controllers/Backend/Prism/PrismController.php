<?php

namespace App\Http\Controllers\Backend\Prism;

use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrismController extends Controller
{
    public function index()
    {
        $threads = Thread::all();
        return view('backend.prism.index', ['threads' =>$threads]);
    }

    public function viewThread($id)
    {
        $thread = Thread::find($id);
        return view('backend.prism.show', ['thread' => $thread]);

    }
}
