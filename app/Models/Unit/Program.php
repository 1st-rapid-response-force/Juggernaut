<?php

namespace App\Models\Unit;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Program extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','video', 'document','responsible_team_id','status','qualification_id'];

    public function goals()
    {
        return $this->hasMany('App\Models\Unit\ProgramGoal','program_id');
    }

    public function members()
    {
        return $this->hasMany('App\Models\Unit\Member','current_program_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team', 'responsible_team_id');
    }

    public function getStatus()
    {
        switch ($this->status){
            case 1:
                return '<span class="label label-info">Open to Applicants</span>';
                break;
            case 2:
                return '<span class="label label-danger">Closed to Applicants</span>';
                break;
            case 3:
                return '<span class="label label-warning">Inactive</span>';
                break;
        }
    }


}