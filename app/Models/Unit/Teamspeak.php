<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Teamspeak extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }
}
