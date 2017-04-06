<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 * @package App\Models\Unit
 */
class Member extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'searchable_name','position','rank_id', 'team_id', 'face_id', 'current_program_id', 'bio','avatar','active'
    ];


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->rank->abbreviation.'. '.$this->user->last_name.'.'.$this->user->first_name[0];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rank()
    {
        return $this->belongsTo('App\Models\Unit\Rank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo('App\Models\Unit\Program','current_program_id');
    }

    /**
     * @return $this
     */
    public function qualifications()
    {
        return $this->belongsToMany('App\Models\Unit\Qualification')->withPivot('awarded_at','note');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serviceHistory()
    {
        return $this->hasMany('App\Models\Unit\ServiceHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programNotes()
    {
        return $this->hasMany('App\Models\Unit\ProgramNote');
    }


    /**
     * @return $this
     */
    public function ribbons()
    {
        return $this->belongsToMany('App\Models\Unit\Ribbon')->withPivot('awarded_at','note');
    }

    /**
     * @return $this
     */
    public function awards()
    {
        return $this->belongsToMany('App\Models\Unit\Award')->withPivot('awarded_at','note');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamspeak()
    {
        return $this->hasMany('App\Models\Unit\Teamspeak');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paperwork()
    {
        return $this->hasMany('App\Models\Unit\Paperwork');
    }

    /**
     * Returns all PERSTATS
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function perstat()
    {
        return $this->belongsToMany('App\Models\Unit\Perstat', 'member_perstat', 'member_id', 'perstat_id');
    }

    /**
     * @return $this
     */
    public function programGoals()
    {
        return $this->belongsToMany('App\Models\Unit\ProgramGoal', 'goal_member', 'member_id', 'goal_id')->withPivot('processor_id','note','completed_at');
    }

    public function programs()
    {
        return $this->belongsToMany('App\Models\Unit\Program', 'member_program', 'member_id', 'program_id')->withPivot('note','paperwork_id','completed_at');
    }


    /**
     * @return string
     */
    public function showCAC()
    {
        return '/img/faces/members/'.$this->user->steam_id.'.png';
    }

    /**
     * @return string
     */
    public function getActive()
    {
        switch ($this->active){
            case 2:
                return '<span class="label label-info">Leave of Absence</span>';
                break;
            case 1:
                return '<span class="label label-success">Active</span>';
                break;
            case 0:
                return '<span class="label label-danger">Not Active</span>';
                break;
        }
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.members.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.members.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.members.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="Cancel"
             data-trans-button-confirm="Delete"
             data-trans-title="Are you sure?"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> ';

    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute().
            $this->getDeleteButtonAttribute();
    }

    // Query Scopes
    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    /**
     * @return bool
     */
    public function hasReportedIn()
    {
        $perstat = Perstat::where('active','=','1')->first();
        if($perstat->members->contains($this->id))
            return true;
        return false;
    }

    public function currentProgramCompletion()
    {
        if($this->current_program_id == 0)
            return 'No Program Selected';

        // Get current program goals count for current program
        $completed = $this->programGoals()->where('program_id',$this->current_program_id)->get()->count();
        $programGoalCount = Program::find($this->current_program_id)->goals->count();

        //Quick division check
        if($programGoalCount == 0)
            return 'No Goal Completion';
        return round(($completed/$programGoalCount)*100,2)."%";
    }

    public function completedCurrentCourse()
    {
        if($this->current_program_id == 0)
            return 'No Program Selected';

        // Get current program goals count for current program
        $completed = $this->programGoals()->where('program_id',$this->current_program_id)->get()->count();
        $programGoalCount = Program::find($this->current_program_id)->goals->count();

        if($programGoalCount == 0)
            return 0;

        if($completed == $programGoalCount)
            return 1;

        return 0;
    }
}
