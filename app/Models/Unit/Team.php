<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Team
 * @package App\Models\Unit
 */
class Team extends Model implements HasMedia
{
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
    public function videos()
    {
        return $this->hasMany('App\Models\Unit\TeamVideo');
    }

    public function programs()
    {
        return $this->hasMany('App\Models\Unit\Program','responsible_team_id');
    }

    public function randomHeader()
    {
        return '/img/arma/'.rand(1,5).'.jpg';
    }

    public function childTeams()
    {
        return $this->hasMany('App\Models\Unit\Team','parent_id');
    }

    public function parentTeam()
    {
        return $this->belongsTo('App\Models\Unit\Team','parent_id');
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

        //Case 3 - Check parents
        if(isset($this->parent_id))
        {
            return $this->parentTeam->isLeader($user);
        }

        // If none are true then return false
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
}
