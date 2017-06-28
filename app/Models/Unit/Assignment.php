<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['name','team_id','order','enabled'];

    protected $appends = ['members_list'];

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Models\Unit\Member');
    }

    public function getMembersListAttribute()
    {
        return $this->members()->pluck('searchable_name')->toArray();
    }

}
