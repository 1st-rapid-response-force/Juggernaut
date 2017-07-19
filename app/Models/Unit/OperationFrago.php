<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class OperationFrago extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $table = "operations_frago";

    protected $fillable = ['message','member_id'];

    public function operation()
    {
        return $this->belongsTo('App\Models\Unit\Operation');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Unit\Member');
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.operations.frago.edit', [$this->operation->id,$this]).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.operations.frago.destroy', [$this->operation->id,$this]).'"
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
            // $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getDeleteButtonAttribute();
    }
}
