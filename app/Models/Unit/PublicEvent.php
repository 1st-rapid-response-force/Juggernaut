<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Event
 *
 * @package App\Models\Unit
 * @property int $id
 * @property string $title
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 * @property bool $full_day
 * @property string $url
 * @property string $color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereFullDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\PublicEvent whereUrl($value)
 * @mixin \Eloquent
 */
class PublicEvent extends Model implements HasMedia, \MaddHatter\LaravelFullcalendar\Event
{
    use HasMediaTrait;

    /**
     * @var array
     */
    protected $dates = ['start_time', 'end_time'];

    protected $table = 'events';

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start_time;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end_time;
    }

    /**
     * Optional FullCalendar.io settings for this event
     *
     * @return array
     */
    public function getEventOptions()
    {
        return [
            'color' => $this->color,
            'url' => $this->url
        ];
    }

}
