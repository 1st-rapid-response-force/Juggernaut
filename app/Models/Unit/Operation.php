<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * App\Models\Unit\Operation
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Operation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Operation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Operation extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['name','published','required_elements','optional_elements','description','training','admin','credit','start_time','end_time'];

    protected $dates = ['start_time','end_time'];

    public function fragos()
    {
        return $this->hasMany('App\Models\Unit\OperationFrago');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Unit\Member', 'member_operation', 'operation_id', 'member_id')->withPivot('status');
    }

    public function requiredElement($id)
    {
        $elements = collect(explode(',',$this->required_elements));

        if($elements->contains($id))
        {
            return true;
        }
        return false;
    }

    public function optionalElement($id)
    {
        $elements = collect(explode(',',$this->optional_elements));
        if($elements->contains($id))
        {
            return true;
        }
        return false;

    }

    public function hasReportedForOperation($member)
    {
        if($this->members->contains($member))
            return true;
        return false;
    }

    public function getOperationalStatus($member)
    {
        if($this->hasReportedForOperation($member))
        {
            switch ($this->members()->find($member)->pivot->status){
                case 1:
                    return '<span class="label label-success">Will Attend</span>';
                    break;
                case 0:
                    return '<span class="label label-warning">Not able to attend</span>';
                    break;
            }

        } else {
            return '<span class="label label-danger">Pending Response</span>';
        }
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.operations.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.operations.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="Cancel"
             data-trans-button-confirm="Delete"
             data-trans-title="Are you sure?"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> ';

    }

    public function getDeleteAttachment($operation_id,$attachment_id)
    {
        return '<a href="'.route('admin.operations.attachment.destroy', [$operation_id,$attachment_id]).'"
             data-method="delete"
             data-trans-button-cancel="Cancel"
             data-trans-button-confirm="Delete"
             data-trans-title="Are you sure?"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> ';

    }

    public function getAccountability()
    {
        //Grab Required
        $required = explode(',',$this->required_elements);
        $requiredTeams = Team::whereIn('id', $required)
            ->get();
        $optional = explode(',',$this->optional_elements);
        $optionalTeams = Team::whereIn('id', $optional)
            ->get();
        $accountability = collect(['required' => $requiredTeams, 'optional' => $optionalTeams]);
        return $accountability;
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return
            // $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getDeleteButtonAttribute();
    }

}
