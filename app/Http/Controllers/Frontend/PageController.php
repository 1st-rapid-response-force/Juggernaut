<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Unit\Member;
use App\Models\Unit\Rank;
use App\Models\Unit\Team;
use App\Models\Unit\TeamTimeline;
use App\Models\Unit\TeamVideo;
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

    public function videos()
    {
        $videos = TeamVideo::orderBy('id','asd')->paginate(15);
        return view('frontend.pages.videos',['videos' => $videos]);
    }

    public function structure()
    {
        $command = Team::find(1);
        $oges = Member::find(1);
        $infantry = Team::whereBetween('id', [4, 8])->get();
        $aviation = Team::whereBetween('id', [9, 15])->get();
        $reserve = Team::find(2);
        $discharged = Member::where('team_id',17)->get();

        $officerRanks = Rank::whereBetween('id', [19, 24])->get();
        $warrantRanks = Rank::whereBetween('id', [14, 18])->get();
        $enlistedRanks = Rank::whereBetween('id', [2, 13])->get();

        return view('frontend.pages.structure',
            ['command'=> $command,
            'infantryGroups' => $infantry,
            'aviationGroups' => $aviation,
            'reserve' => $reserve,
            'discharged' => $discharged,
            'officerRanks' => $officerRanks,
            'warrantRanks' => $warrantRanks,
            'enlistedRanks' => $enlistedRanks,
            'oges' => $oges
            ]);
    }

    public function unitFeed()
    {
        $events = TeamTimeline::orderBy('date','desc')->paginate(15);
        return view('frontend.pages.activity-feed',['events' => $events]);
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

    public function banned()
    {
        return view('frontend.pages.banned');
    }



}
