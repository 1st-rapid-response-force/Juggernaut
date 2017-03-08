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

    public function teamspeak()
    {
        return $this->hasMany('App\Models\Unit\Teamspeak');
    }
}
