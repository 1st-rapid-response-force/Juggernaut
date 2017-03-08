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
        return $this->hasMany('App\Models\Unit\Member');
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
}
