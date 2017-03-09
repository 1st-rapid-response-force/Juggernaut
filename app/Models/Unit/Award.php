<?php

namespace App\Models\Unit;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

use Illuminate\Database\Eloquent\Model;

class Award extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','published'];


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
    public function member()
    {
        return $this->belongsToMany('App\Models\Unit\Member')->withPivot('awarded_at','note');
    }
}
