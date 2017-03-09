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
     * Array of guarded columns
     * @var array
     */
    protected $guarded = ['id'];

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

    public function rank()
    {
        return $this->belongsTo('App\Models\Unit\Rank');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    public function qualifications()
    {
        return $this->belongsToMany('App\Models\Unit\Qualification')->withPivot('awarded_at','note');
    }

    public function serviceHistory()
    {
        return $this->hasMany('App\Models\Unit\ServiceHistory');
    }

    public function ribbons()
    {
        return $this->belongsToMany('App\Models\Unit\Ribbon')->withPivot('awarded_at','note');
    }

    public function awards()
    {
        return $this->belongsToMany('App\Models\Unit\Award')->withPivot('awarded_at','note');
    }

    public function teamspeak()
    {
        return $this->hasMany('App\Models\Unit\Teamspeak');
    }

    public function showCAC()
    {
        return '/img/faces/members/'.$this->user->steam_id.'.png';
    }
}
