<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Mission extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['name','checksum','user_id'];
    protected $appends = ['download','filename'];
    protected $hidden = ['media'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDownloadAttribute()
    {
        return 'https://1st-rrf.com'.$this->getMedia('mission')->first()->getUrl();
    }

    public function getFilenameAttribute()
    {
        return $this->getMedia('mission')->first()->file_name;
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.missions.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.missions.destroy', $this).'"
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
            $this->getEditButtonAttribute().
            $this->getDeleteButtonAttribute();
    }
}
