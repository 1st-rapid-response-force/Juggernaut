<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;


/**
 * App\Models\Unit\Ribbon
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property bool $published
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Member[] $member
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Ribbon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ribbon extends Model implements HasMedia
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
