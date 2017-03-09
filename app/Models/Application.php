<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['application'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function interviewer()
    {
        return $this->belongsTo('App\User','interview_id','id');
    }
}
