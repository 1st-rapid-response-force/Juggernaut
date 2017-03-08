<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Unit\Team;
use App\Repositories\Frontend\Unit\CalendarRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
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

    public function home()
    {
        return view('frontend.pages.home');
    }

    public function team($team)
    {
        $team = Team::find($team);
        return view('frontend.team.team-page',['team' => $team,'events' => $team->timeline()->orderBy('id','desc')->get()]);

    }

    public function mission()
    {
        return view('frontend.pages.mission');
    }

    public function history()
    {
        return view('frontend.pages.history');
    }

    public function process()
    {
        return view('frontend.pages.process');
    }

    public function calendar()
    {
        $calendar = $this->calendar->getCalendar(\Auth::User());
        return view('frontend.pages.calendar',['calendar'=>$calendar]);
    }

    public function infil()
    {
        return view('frontend.pages.infil');
    }

    public function setCalendar(Request $request)
    {
        $user = \Auth::User();
        $user->update([
            'timezone' => $request->timezone
        ]);
        $request->session()->put('timezone', $request->timezone);
        flash('Timezone has been updated successfully.');
        return redirect()->route('frontend.calendar');
    }

}
