<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\ProgramGoal
 *
 * @property int $id
 * @property int $program_id
 * @property string $goal
 * @property string $category
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Member[] $members
 * @property-read \App\Models\Unit\Program $program
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereGoal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\ProgramGoal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
