<?php

namespace App\Models\Unit;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Program extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','video', 'document'];

    public function goals()
    {
        return $this->hasMany('App\Models\Unit\ProgramGoal','program_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Unit\Program', 'member_program', 'program_id', 'member_id')->withPivot('note','paperwork_id','completed_at');
    }
}
