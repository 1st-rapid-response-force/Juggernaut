<?php

namespace App\Http\Controllers\Backend\Unit\Calendar;

use App\Models\Unit\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\Backend\Unit\CalendarRepositoryContract;
use App\Http\Requests\Backend\Calendar\CreateEventRequest;
use App\Http\Requests\Backend\Calendar\ManageCalendarRequest;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Calendar;
use App\Http\Requests\Backend\Calendar\UpdateEventRequest;

class CalendarController extends Controller
{
    /**
     * @var CalendarRepositoryContract
     */
    protected $calendar;

    /**
     * @param CalendarRepositoryContract $calendar
     */
    public function __construct(CalendarRepositoryContract $calendar)
    {
        $this->calendar = $calendar;
    }

    public function index()
    {
        $events = Event::all();
        $calendar = \Calendar::addEvents($events);

        return view('backend.calendar.index', ['calendar' => $calendar]);
    }

    public function store(Request $request)
    {
        $this->calendar->create($request->all(),\Auth::User());
        return redirect()->route('admin.calendar.index')->withFlashSuccess(trans('alerts.backend.calendars.created'));
    }

    public function edit(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        return view('backend.calendar.edit-event', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $this->calendar->update($event,$request->except(['_method','_token']),\Auth::User());
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.calendars.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $this->calendar->delete($event);
        return redirect(route('admin.calendar.index'))->withFlashSuccess(trans('alerts.backend.calendars.deleted'));
    }

    public function createEvent(Request $request)
    {
        return view('backend.calendar.create-event');
    }
}
