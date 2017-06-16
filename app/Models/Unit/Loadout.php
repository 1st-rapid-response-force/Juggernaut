<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * App\Models\Unit\Loadout
 *
 * @property int $id
 * @property int $qualification_id
 * @property string $category
 * @property string $name
 * @property string $class_name
 * @property bool $empty
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Unit\Loadout[] $member
 * @property-read \App\Models\Unit\Qualification $qualification
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereCategory($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereClassName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereEmpty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereQualificationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Loadout whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        return '/img/blank.JPG';
    }


    public function member()
    {
        return $this->belongsToMany('App\Models\Unit\Loadout', 'loadouts_members', 'loadout_id', 'member_id');
    }


    public function qualification()
    {
        return $this->belongsTo('App\Models\Unit\Qualification');
    }

}
