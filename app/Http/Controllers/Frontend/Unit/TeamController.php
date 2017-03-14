<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Team;
use App\Models\Unit\TeamTimeline;
use App\Models\Unit\TeamVideo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function members($id)
    {
        $team = Team::findOrFail($id);
        return view('frontend.team.team-members',['team' => $team]);
    }

    public function videos($id)
    {
        $team = Team::findOrFail($id);
        $videos = $team->videos()->paginate(15);
        return view('frontend.team.team-videos',['team' => $team, 'videos' => $videos]);
    }

    public function leader($id)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.team-leader',['team'=>$team]);
    }

    public function positions($id)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.positions',['team'=>$team]);
    }

    public function updatePositions($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        foreach ($request->userForm as $input)
        {
            $memberModel = Member::findOrFail($input['id']);
            $memberModel->position = $input['position'];
            $memberModel->save();
        }
        flash('Team positions successfully updated.','success');
        return redirect(route('frontend.team.leader',$id));
    }

    public function updateTeamHeader($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }


        $team->clearMediaCollection('header');
        $file = $team->addMedia($request->file('header_image'))->toCollection('header');
        $team->header_image  = $file->getUrl();
        $team->save();

        flash('Header file uploaded successfully.','success');
        return redirect(route('frontend.team.leader',$team->id));
    }

    public function newEvent($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        // Create Event
        $event = $team->timeline()->create($request->except(['_token','timeline_image']));
        $timeline = TeamTimeline::findOrFail($event->id);

        // Attach Image to Event if there is an image
        if($request->hasFile('timeline_image'))
        {
            $timeline->addMedia($request->file('timeline_image'))->toCollection('images');
        }



        flash('Timeline event added successfully.','success');
        return redirect(route('frontend.team.leader',$team->id));


    }

    public function viewVideo($id,$video_id)
    {
        $team = Team::findOrFail($id);
        $video = TeamVideo::findOrFail($video_id);

        return view('frontend.team.team-video',['team'=>$team,'video' => $video]);
    }

    public function addVideo($id)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.add-video',['team'=>$team]);
    }

    public function editVideo($id,$video_id)
    {
        $team = Team::findOrFail($id);
        $video = TeamVideo::findOrFail($video_id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.edit-video',['team'=>$team,'video'=>$video]);
    }

    public function addVideoPost($id, Request $request)
    {
        $team = Team::findOrFail($id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $youtube_id = explode("?v=", $request->youtube_url);
        $youtube_id = $youtube_id[1];

        $video = $team->videos()->create([
            'name' => $request->name,
            'user_id' => \Auth::User()->id,
            'description' => $request->description,
            'content' => $request->content_video,
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $youtube_id,
            'posted_at' => Carbon::now()

        ]);

        flash('Video created successfully.','success');
        return redirect(route('frontend.team.leader',$team->id));
    }

    public function editVideoPost($id, $video_id,Request $request)
    {
        $team = Team::findOrFail($id);
        $video = TeamVideo::findOrFail($video_id);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $youtube_id = explode("?v=", $request->youtube_url);
        $youtube_id = $youtube_id[1];

        $video->update($request->except(['_token','content_video','youtube_url']));
        $video->update(['content' => $request->content_video,'youtube_url' => $youtube_id]);


        flash('Video edited successfully.','success');
        return redirect()->back();
    }

    public function deleteTimelineEvent($team_id, $timeline_id)
    {
        $event = TeamTimeline::findOrFail($timeline_id);
        $event->delete();
        flash('Timeline deleted successfully.','success');
        return redirect()->back();
    }
}
