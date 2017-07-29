<?php

namespace App\Http\Controllers\Backend;

use App\Models\Overlord\Heartbeat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Alert;

class OverlordController extends Controller
{
    public function index()
    {
        $heartbeatAOR1 = Heartbeat::whereServer('aor1')->orderBy('created_at', 'desc')->first();
        $heartbeatAOR2 = Heartbeat::whereServer('aor2')->orderBy('created_at', 'desc')->first();
        $heartbeatTraining = Heartbeat::whereServer('training')->orderBy('created_at', 'desc')->first();
        return view('backend.overlord.index',['aor1' => $heartbeatAOR1,'aor2' => $heartbeatAOR2,'training'=> $heartbeatTraining]);
    }
    public function postUpdateMaps()
    {
        $process = new Process('python3 '.base_path('Capri/csmclient.py RRF_UPDATEMAPS'));
        $process->run();
        flash('Servers maps have been updated!', 'success');
        return redirect()->back();
    }

    public function postKillServers()
    {
        $process = new Process('python3 '.base_path('Capri/csmclient.py RRF_KILLSERVERS'));
        $process->run();
        flash('Servers have been killed!', 'success');
        $heartbeat = Heartbeat::create(['server'=> 'aor1','status'=>'stopped', 'port' => 2302]);
        $heartbeat = Heartbeat::create(['server'=> 'aor2','status'=>'stopped', 'port' => 2312]);
        $heartbeat = Heartbeat::create(['server'=> 'training','status'=>'stopped', 'port' => 2322]);
        return redirect()->back();
    }
    public function postStartServers()
    {
        $process = new Process('python3 '.base_path('Capri/csmclient.py RRF_STARTSERVERS'));
        $process->run();
        flash('Servers have been started!', 'success');
        return redirect()->back();
    }
    public function postHeartbeat(Request $request)
    {
        if($request->RRF_DEPLOYMENT_KEY == env('RRF_DEPLOYMENT_KEY',''))
        {
            $heartbeat = Heartbeat::create($request->all());
            return response()->json(["status" => 1, "message" => 'HEARTBEAT CREATED']);
        } else {
            return response()->json(["status" => 0, "message" => "RRF_DEPLOYMENT_KEY INVALID"]);
        }


    }
}
