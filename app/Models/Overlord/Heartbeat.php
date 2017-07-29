<?php

namespace App\Models\Overlord;

use Illuminate\Database\Eloquent\Model;

class Heartbeat extends Model
{
    protected $fillable = ['server','port','status','data'];

    public function getData()
    {
        if (isset($this->data))
        {
            return json_decode($this->data);
        } else {
            $data = collect(['cpu'=>0, 'memory => 0']);
            return $data->toJson();
        }

    }

    public function getStatus()
    {
        switch ($this->status){
            case "running":
                return '<span class="label label-success">RUNNING</span>';
                break;
            case "paused":
                return '<span class="label label-warning">PAUSED</span>';
                break;
            case "start_pending":
                return '<span class="label label-warning">START PENDING</span>';
                break;
            case "continue_pending":
                return '<span class="label label-warning">CONTINUE PENDING</span>';
                break;
            case "paused_pending":
                return '<span class="label label-daner">STOP PENDING</span>';
                break;
            case "stopped":
                return '<span class="label label-danger">STOPPED</span>';
                break;
        }
    }
}
