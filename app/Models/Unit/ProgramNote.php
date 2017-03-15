<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class ProgramNote extends Model
{
    protected $fillable = ['note'];

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    public function program()
    {
        return $this->belongsTo('App\Models\Unit\Program');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\Unit\Member','author_id');
    }
}
