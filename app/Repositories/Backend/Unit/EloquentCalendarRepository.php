<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit;

use Carbon\Carbon;
use App\Models\Unit\Event;
use App\Models\Unit\PersonnelFile\Award;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Events\Backend\Unit\Calendar\CalendarEventCreated;
use App\Events\Backend\Unit\Calendar\CalendarEventDeleted;
use App\Events\Backend\Unit\Calendar\CalendarEventModified;

/**
 * Class EloquentCalendarRepository
 * @package App\Repositories\Backend\Unit
 */
class EloquentCalendarRepository implements CalendarRepositoryContract {

    /**
     * @param $input
     * @param User $user
     * @return bool
     */
    public function create($input, User $user)
    {
        $event = $this->createEventStub($input,$user->timezone);

        DB::transaction(function() use ($event) {
            if($event->save())
            {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.calendar.create_error'));
        });

    }

    /**
     * @param Event $event
     * @param $input
     * @param User $user
     * @return bool
     */
    public function update(Event $event, $input, User $user)
    {

        //Convert Timezone from User to Server time
        $start_time = new Carbon($input['start_time'], $user->timezone);
        $end_time = new Carbon($input['end_time'], $user->timezone);
        $input['start_time'] = $start_time->setTimezone(config('app.timezone'));
        $input['end_time'] = $end_time->setTimezone(config('app.timezone'));

        DB::transaction(function() use ($event,$input) {
            if($event->update($input))
            {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.calendar.update_error'));
        });
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function delete(Event $event)
    {
        DB::transaction(function() use ($event) {
            if($event->forceDelete())
            {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.calendar.delete_error'));
        });
    }

    /**
     * @param $input
     * @param $timezone
     * @return Event
     */
    private function createEventStub($input, $timezone)
    {
        //Convert Timezone from User to Server
        $start_time = new Carbon($input['start_time'], $timezone);
        $end_time = new Carbon($input['end_time'], $timezone);

        $start_time->setTimezone(config('app.timezone'));
        $end_time->setTimezone(config('app.timezone'));

        $event                    = new Event;
        $event->title             = $input['title'];
        $event->start_time        = $start_time;
        $event->end_time          = $end_time;
        $event->full_day          = $input['full_day'];
        $event->url               = $input['url'];
        $event->color             = $input['color'];

        return $event;
    }

}