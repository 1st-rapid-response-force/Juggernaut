<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Loadout extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $guarded = [];
    public function hasImage()
    {
        if($this->getMedia('image')->count() > 0)
            return true;
        return false;
    }
    public function getImage()
    {
        if($this->getMedia('image')->count() > 0)
        {
            return $this->getMedia('image')->first()->getUrl();
        }
        return '/img/ribbons/blank.jpg';
    }

    public function qualification()
    {
        return $this->belongsTo('App\Models\Unit\Qualification');
    }

}
