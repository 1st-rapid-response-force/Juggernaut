<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class ProgramGoal extends Model
{

    protected $table = "programs_goals";

    protected $fillable = ['goal','category'];

    public function members()
    {
        return $this->belongsToMany('App\Models\Unit\Member', 'goal_member', 'goal_id', 'member_id')->withPivot('processor_id','note','completed_at');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Unit\Program');
    }

    public function getMemberStatusButton($member)
    {
        if($this->members->contains($member))
        {
            return '<span class="label label-success">Completed</span>';
        } else {
            return '<span class="label label-danger">Not Completed</span>';
        }
    }

    public function getMemberStatus($member)
    {
        if($this->members->contains($member))
        {
            return 1;
        } else {
            return 0;
        }
    }
}
