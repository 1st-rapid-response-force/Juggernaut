<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class TeamVideo extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['posted_at','created_at','updated_at'];

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
