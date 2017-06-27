<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Team
 *
 * @package App\Models\Unit
 * @property int $id
 * @property int $leader_id
 * @property string $name
 * @property string $motto
 * @property string $header_image
 * @property string $team_image
 * @property int $parent_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Team[] $childTeams
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Member[] $members
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Paperwork[] $paperwork
 * @property-read \App\Models\Unit\Team $parentTeam
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Program[] $programs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\TeamTimeline[] $timeline
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\TeamVideo[] $videos
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereHeaderImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereLeaderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereMotto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereTeamImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $schedule
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Team whereSchedule($value)
 */
class Team extends Model implements HasMedia
{
    protected $fillable = ['name'];

    use HasMediaTrait;

    /**
     *
     */
    public function leader()
    {
        $this->belongsTo('App\User','leader_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Models\Unit\Member')->orderBy('rank_id', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paperwork()
    {
        return $this->hasMany('App\Models\Unit\Paperwork','team_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeline()
    {
        return $this->hasMany('App\Models\Unit\TeamTimeline');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Models\Unit\Assignment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany('App\Models\Unit\TeamVideo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programs()
    {
        return $this->hasMany('App\Models\Unit\Program','responsible_team_id');
    }

    /**
     * @return string
     */
    public function randomHeader()
    {
        return '/img/arma/'.rand(1,5).'.jpg';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childTeams()
    {
        return $this->hasMany('App\Models\Unit\Team','parent_id');
    }

    public function parentTeam()
    {
        return $this->belongsTo('App\Models\Unit\Team','parent_id');
    }

    public function getSchedule()
    {
        return json_decode($this->schedule);
    }

    public function isLeader($user)
    {
        // So we want to check a couple of things
        // Case 1 - admin
        if($user->admin)
            return true;

        // Case 2 - Leader ID matches
        if($this->leader_id == $user->id)
            return true;


        //Case 4 - Check parents
        if(isset($this->parent_id))
        {
            return $this->parentTeam->isLeader($user);
        }

        // If none are true then return false
        return false;
    }

    public function isTeamLeader($user)
    {

        if(($user->member->team_leader) && ($this->id == $user->member->team_id))
        {
            return true;
        }

        return false;
    }

    public function isAviation()
    {
        if($this->id >= 9 && $this->id <= 15)
        {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.teams.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.teams.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.teams.destroy', $this).'"
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
            //$this->getShowButtonAttribute().
            $this->getEditButtonAttribute();
    }

}
