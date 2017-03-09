<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    protected $fillable = ['text','date'];

    protected $date = ['date'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }
}
