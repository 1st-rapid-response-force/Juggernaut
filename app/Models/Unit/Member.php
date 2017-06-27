<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 *
 * @package App\Models\Unit
 * @property int $id
 * @property int $user_id
 * @property string $searchable_name
 * @property string $position
 * @property int $rank_id
 * @property int $team_id
 * @property int $face_id
 * @property int $current_program_id
 * @property int $time_in_service
 * @property int $team_leader
 * @property string $bio
 * @property string $avatar
 * @property int $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Award[] $awards
 * @property-read string $action_buttons
 * @property-read string $delete_button
 * @property-read string $edit_button
 * @property-read string $show_button
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Loadout[] $loadout
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Paperwork[] $paperwork
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Perstat[] $perstat
 * @property-read \App\Models\Unit\Program $program
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\ProgramGoal[] $programGoals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\ProgramNote[] $programNotes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Program[] $programs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Qualification[] $qualifications
 * @property-read \App\Models\Unit\Rank $rank
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Ribbon[] $ribbons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\ServiceHistory[] $serviceHistory
 * @property-read \App\Models\Unit\Team $team
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Teamspeak[] $teamspeak
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member active()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereBio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereCurrentProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereFaceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereRankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereSearchableName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereTeamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereTeamLeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereTimeInService($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Member whereUserId($value)
 * @mixin \Eloquent
 */
class Member extends Model
{

    /**
     * @var array
     */
    protected $fillable = [
        'searchable_name','position','rank_id', 'team_id', 'face_id', 'current_program_id', 'bio','avatar','active','team_leader','loa','loa_return','reserve'
    ];


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->rank->abbreviation.' '.$this->user->last_name.', '.$this->user->first_name[0].'.';
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
    public function assignment()
    {
        return $this->belongsTo('App\Models\Unit\Assignment');
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

    public function loadout()
    {
        return $this->belongsToMany('App\Models\Unit\Loadout', 'loadouts_members', 'member_id', 'loadout_id');
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

    public function onLOA()
    {
        if($this->loa)
        {
            return true;
        } else {
            return false;
        }
    }

    public function getLOAStatus()
    {
        if($this->loa)
        {
            return '<span class="label label-warning">Currently on LOA</span>';
        } else {
            return '';
        }

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

    public function completedCourse($id)
    {
        $course = Program::find($id);

        // Get current program goals count for current program
        $completed = $this->programGoals()->where('program_id',$course->id)->get()->count();
        $programGoalCount = $course->goals->count();

        if($programGoalCount == 0)
            return 0;

        if($completed == $programGoalCount)
            return 1;

        return 0;
    }
}
