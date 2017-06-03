<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class PaperworkMessage extends Model
{
    protected $fillable = ['message'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    public function paperwork()
    {
        return $this->belongsTo('App\Models\Unit\Paperwork');
    }
}
