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

    public function getApplication()
    {
        return json_decode($this->application);
    }

    public function getStatus()
    {
        switch ($this->status){
            case 1:
                return 'New Application';
                break;
            case 2:
                return 'Application Declined';
                break;
            case 3:
                return 'Application Accepted';
                break;
        }
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.applications.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i></a> ';
    }
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.applications.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.applications.destroy', $this).'"
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

}
