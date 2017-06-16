<?php

namespace App\Models\Unit;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unit\Award
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award wherePublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Award whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
