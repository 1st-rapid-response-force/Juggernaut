<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class TeamTimeline
 * @package App\Models\Unit
 */
class TeamTimeline extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $dates = ['date','created_at','updated_at'];

    public function team()
    {
        return $this->belongsTo('App\Models\Unit\Team');
    }

    /**
     * @return string
     */
    public function EventType()
    {
        switch ($this->type){
            case 'new-member':
                return 'fa fa-user-plus';
            case 'member-left':
                return 'fa fa-user-times';
            case 'operation':
                return 'fa fa-flag';
            case 'star':
                return 'fa fa-star';
            case 'newspaper':
                return 'fa fa-newspaper-o';
        }
    }

    /**
     * @return bool
     */
    public function hasPhoto()
    {
        if($this->getMedia('images')->count())
        {
            return true;
        } else
        {
            return false;
        }
    }
}
