<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Frontend\Unit;

use App\Models\Application;
use App\Models\Unit\Member;
use App\Models\Unit\Team;
use Carbon\Carbon;
use App\Models\Unit\Event;
use App\Models\Unit\PublicEvent;
use App\User;

use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class EloquentCalendarRepository
 * @package App\Repositories\Backend\Unit
 */
class EloquentCalendarRepository implements CalendarRepositoryContract {

    protected $timezone;
    /**
     * @return mixed
     */
    public function getCalendar(User $user)
    {
        $this->timezone = $user->timezone;
        session(['timezone' => $this->timezone]);

        // Public Events
        $events = PublicEvent::all();
        foreach ($events as $event)
        {
            $event->start_time = $event->start_time->setTimezone($this->timezone);
            $event->end_time = $event->end_time->setTimezone($this->timezone);
        }

        $calendar = \Calendar::addEvents($events);

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

        $calendar = \Calendar::addEvents($birthdays);
        $calendar = \Calendar::addEvents($scheduling);

        return $calendar->setOptions([
            'timeFormat' => 'H(:mm)'
        ]);



    }

}