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

    public function getCalendar(User $user)
    {
        $this->timezone = $user->timezone;
        session(['timezone' => $this->timezone]);

        $events = Event::all();
        foreach ($events as $event)
        {
            $event->start_time = $event->start_time->setTimezone($this->timezone);
            $event->end_time = $event->end_time->setTimezone($this->timezone);
        }

        // Birthdays
        $birthdays = collect();
        foreach (Member::whereActive(1)->get() as $mem)
        {
            if(isset($mem->user->application))
            {
                $dob = Carbon::parse($mem->user->application->getApplication()->dob)->year(Carbon::now()->year);
                $birthdays->push(\Calendar::event(
                    $mem.' -  Birthday', //event title
                    true, //full day event?
                    $dob,
                    $dob,
                    rand(9000,10000),
                    [
                        'color' => '#4B870C'
                    ]
                ));
            }

        }

        // Team Scheduling
        $scheduling = collect();
        foreach (Team::all() as $team)
        {
            // Make sure the schedule is valid
            if(isset($team->schedule))
            {
                Carbon::setWeekStartsAt(Carbon::SUNDAY);
                $date = Carbon::now($team->getSchedule()->timezone)
                    ->startOfWeek()
                    ->addDay($team->getSchedule()->day)
                    ->addHour($team->getSchedule()->hour)
                    ->addMinute($team->getSchedule()->minute)
                    ->setTimezone($this->timezone);
                $endDate = Carbon::now($team->getSchedule()->timezone)
                    ->startOfWeek()
                    ->addDay($team->getSchedule()->day)
                    ->addHour($team->getSchedule()->hour)
                    ->addMinute($team->getSchedule()->minute)
                    ->addHour(1)
                    ->setTimezone($this->timezone);

                $scheduling->push(\Calendar::event(
                    $team->name.' -  Training', //event title
                    false, //full day event?
                    $date,
                    $endDate,
                    rand(5000,6000),
                    [
                        'color' => '#8B0000'
                    ]
                ));
            }
        }

        // Add Operations
        $operations = collect();

        foreach (Operation::wherePublished(1)->get() as $op)
        {
            $scheduling->push(\Calendar::event(
                $op->name, //event title
                false, //full day event?
                $op->start_time->setTimezone($this->timezone),
                $op->end_time->setTimezone($this->timezone),
                rand(5000,6000),
                [
                    'color' => '#000000',
                    'url' => route('admin.operations.edit',$op->id)
                ]
            ));
        }

        $calendar = \Calendar::addEvents($birthdays);
        $calendar = \Calendar::addEvents($scheduling);
        $calendar = \Calendar::addEvents($operations);
        return $calendar->setOptions([
            'timeFormat' => 'H(:mm)'
        ]);
    }

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
        $event->url               = $input['url'];
        $event->color             = $input['color'];

        return $event;
    }

}
