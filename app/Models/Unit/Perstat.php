<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Perstat extends Model
{
    protected $guarded = [];


    public function members()
    {
        return $this->belongsToMany('App\Models\Unit\Member', 'member_perstat', 'perstat_id', 'member_id');
    }

    public function report_percentage()
    {
        $reportin = $this->members->count();
        $percentage = ($reportin/$this->assigned)*100;
        return round($percentage,2);
    }
    public function pendingReportIn()
    {
        $reportedIn = $this->members;
        $members = Member::where('active','=','1')->get();
        $members = $members->diff($reportedIn);
        return $members;
    }
}
