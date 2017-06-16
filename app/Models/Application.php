<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Application
 *
 * @property int $id
 * @property int $user_id
 * @property string $application
 * @property bool $interview_required
 * @property int $interview_id
 * @property int $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $action_buttons
 * @property-read string $delete_button
 * @property-read string $edit_button
 * @property-read string $show_button
 * @property-read \App\User $interviewer
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereApplication($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereInterviewId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereInterviewRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Application whereUserId($value)
 * @mixin \Eloquent
 */
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
                return '<span class="label label-info">New Application</span>';
                break;
            case 2:
                return '<span class="label label-danger">Application Declined</span>';
                break;
            case 3:
                return '<span class="label label-success">Application Accepted</span>';
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
