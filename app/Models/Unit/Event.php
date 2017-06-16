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
 * @property-read string $delete_button
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Media[] $media
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereFullDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Unit\Event whereUrl($value)
 * @mixin \Eloquent
 */
class Event extends Model implements HasMedia, \MaddHatter\LaravelFullcalendar\Event
{
    use HasMediaTrait;

    /**
     * @var array
     */
    protected $dates = ['start_time', 'end_time'];

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
            'url' => route('admin.calendar.edit',$this->id)
        ];
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="' . route('admin.calendar.destroy', $this) . '"
             data-method="delete"
             data-trans-button-cancel="' . trans('buttons.general.cancel') . '"
             data-trans-button-confirm="' . trans('buttons.general.crud.delete') . '"
             data-trans-title="' . trans('strings.backend.general.are_you_sure') . '"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
    }

}
