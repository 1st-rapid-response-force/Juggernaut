<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 * @package App\Models\Unit
 */
class Member extends Model
{

    protected $fillable = [
        'searchable_name','position','rank_id', 'team_id', 'face_id', 'bio','avatar','active'
    ];


    public function __toString()
    {
        return $this->rank->abbreviation.'. '.$this->user->last_name.'.'.$this->user->first_name[0];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rank()
    {
        return $this->belongsTo('App\Models\Unit\Rank');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    public function qualifications()
    {
        return $this->belongsToMany('App\Models\Unit\Qualification')->withPivot('awarded_at','note');
    }

    public function serviceHistory()
    {
        return $this->hasMany('App\Models\Unit\ServiceHistory');
    }

    public function ribbons()
    {
        return $this->belongsToMany('App\Models\Unit\Ribbon')->withPivot('awarded_at','note');
    }

    public function awards()
    {
        return $this->belongsToMany('App\Models\Unit\Award')->withPivot('awarded_at','note');
    }

    public function teamspeak()
    {
        return $this->hasMany('App\Models\Unit\Teamspeak');
    }

    public function paperwork()
    {
        return $this->hasMany('App\Models\Unit\Paperwork');
    }

    /**
     * Returns all PERSTATS
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function perstat()
    {
        return $this->belongsToMany('App\Models\Unit\Perstat', 'member_perstat', 'member_id', 'perstat_id');
    }


    public function showCAC()
    {
        return '/img/faces/members/'.$this->user->steam_id.'.png';
    }

    public function getActive()
    {
        switch ($this->active){
            case 1:
                return '<span class="label label-success">Active</span>';
                break;
            case 0:
                return '<span class="label label-danger">Not Active</span>';
                break;
        }
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.members.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.members.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.members.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="Cancel"
             data-trans-button-confirm="Delete"
             data-trans-title="Are you sure?"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> ';

    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            $this->getShowButtonAttribute().
            $this->getDeleteButtonAttribute();
    }

    // Query Scopes
    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }
    public function hasReportedIn()
    {
        $perstat = Perstat::where('active','=','1')->first();
        if($perstat->members->contains($this->id))
            return true;
        return false;
    }
}
