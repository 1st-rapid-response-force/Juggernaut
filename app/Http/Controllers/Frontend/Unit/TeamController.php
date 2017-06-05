<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\Models\Unit\Member;
use App\Models\Unit\Program;
use App\Models\Unit\ProgramGoal;
use App\Models\Unit\ProgramNote;
use App\Models\Unit\Qualification;
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
        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
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

    public function training($id)
    {
        $team = Team::findOrFail($id);
        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.training',['team'=>$team]);
    }

    public function trainingReport($id, $member)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.training-report',['team'=>$team,'member'=> $member]);
    }

    public function storeNewNote($id,$member, Request $request)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $note = new ProgramNote;
        $note->author_id = \Auth::User()->id;
        $note->member_id = $member->id;
        $note->program_id = $member->current_program_id;
        $note->note = $request->note;
        $note->save();

        \Log::info('User created new training note', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'note_id' => $note->id,'member_note' => $note->member->searchable_name]);
        flash('Note added to file.','success');
        return redirect()->back();
    }

    public function deleteNote($id,$member, $note_id, Request $request)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);
        $note = ProgramNote::find($note_id);

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }
        \Log::info('User deleted  training note', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'note_id' => $note->id,'member_note' => $note->member->searchable_name]);
        $note->delete();
        flash('Note was deleted successfully.','success');
        return redirect()->back();
    }

    public function markReport($id,$member, $goal)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);
        $goal = ProgramGoal::find($goal);
        $user = \Auth::User();

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.training-mark',['team'=>$team,'member'=> $member,'goal'=>$goal]);
    }

    public function storeMarkGoal($id,$member, $goal, Request $request)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);
        $goal = ProgramGoal::find($goal);
        $user = \Auth::User();

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $goal->members()->attach([$member->id => ['processor_id'=> $user->id, 'note' => $request->note, 'completed_at' => new Carbon]]);
        \Log::info('User marked goal as completed', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'goal_id' => $goal->id,'member_goal' => $member->searchable_name]);
        flash('Goal marked as completed','success');
        return redirect(route('frontend.team.leader.training.report',[$id,$member]));

    }

    public function storeMarkBulkGoal($id, $member, Request $request)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);

        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $goals = collect($request->goal);
        foreach ($goals as $goal)
        {
            $goalModel =  ProgramGoal::find($goal);
            $goalModel->members()->attach([$member->id => ['processor_id'=> \Auth::User()->id, 'note' => 'Filled out via BULK Functionality', 'completed_at' => new Carbon]]);
            \Log::info('User marked goal as completed', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'goal_id' => $goalModel->id,'member_goal' => $member->searchable_name]);
        }

        // Adding class check here
        foreach (Program::all() as $program)
        {
            // If they have completed the course lets credit them
            if(($member->completedCourse($program->id) && !$member->qualifications->contains($program->qualification_id->id)) )
            {
                $now = Carbon::now();
                $qualification = Qualification::find($program->qualification_id);

                // Create Paperwork
                $form = collect([
                    'name' => $member->searchable_name,
                    'grade' => $member->rank->name,
                    'military_id' => $member->user->steam_id,
                    'date' => Carbon::now(),
                    'organization' => '1st Rapid Response Force',
                    'program' => $member->program,
                    'instructor' => \Auth::User()->member,
                    'instructor_rank' => \Auth::User()->member->rank->name,
                    'program_remarks' => 'Completed Course'
                ]);

                // Create Paperwork
                $paperwork = $member->paperwork()->create(['type'=>'program-completion','paperwork'=> $form->toJson(),'status'=>2]);
                $now = Carbon::now();

                // Add Qualification
                $member->qualifications()->attach([$program->qualification_id => ['awarded_at' => $now]]);

                //Create Service History
                $serviceHistory = $member->serviceHistory()->create(['text'=> 'Awarded Qualification - '.$qualification->name,'date'=> $now]);

                \Log::info('CATALYST - Credited User with Qualification.', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork->id,'program' => $program->name]);

                flash('Member has been credited with a qualification.', 'success');

            }

        }

        return redirect(route('frontend.team.leader.training.report',[$id,$member]));

    }

    public function classCompletionForm($id,$member)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);
        $user = \Auth::User();

        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }
        if(!$member->completedCurrentCourse())
        {
            flash('This member has not completed this course.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.paperwork.program-completion.new',['team'=>$team,'member'=> $member]);
    }

    public function storeClassCompletionForm($id,$member, Request $request)
    {
        $team = Team::findOrFail($id);
        $member = Member::findOrFail($member);
        $user = \Auth::User();

        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        if(!$member->completedCurrentCourse())
        {
            flash('This member has not completed this course.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        // Create Paperwork
        $form = collect($request->except('_token'));
        $paperwork = $member->paperwork()->create(['type'=>'program-completion','paperwork'=> $form->toJson(),'status'=>2]);
        $now = Carbon::now();

        // Create Program Completion
        $member->programs()->attach([$member->current_program_id => ['paperwork_id'=> $paperwork->id, 'note' => $request->note, 'completed_at' => $now]]);
        $oldProgram = $member->program;
        $member->current_program_id = 0;
        $member->save();


        //Create Service History
        $serviceHistory = $member->serviceHistory()->create(['text'=> 'Completed Training Program - '.$oldProgram->name,'date'=> $now]);

        \Log::info('User filled out program completion form.', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'paperwork_id' => $paperwork->id,'program' => $oldProgram->name]);

        flash('Class Completion Form filed, credit has been granted for this program.', 'success');
        return redirect(route('frontend.files.my-file'));

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
            $memberModel->team_leader = $input['team_leader'];
            $memberModel->save();
        }
        \Log::info('User updated team positions', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'team_id' => $team->id]);
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
        $team = Team::findOrFail($team_id);

        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        $event = TeamTimeline::findOrFail($timeline_id);
        $event->delete();
        flash('Timeline deleted successfully.','success');
        return redirect()->back();
    }

    public function showAllAfterActionReports($team_id)
    {
        $team = Team::findOrFail($team_id);
        if(!($team->isLeader(\Auth::User()) || $team->isTeamLeader(\Auth::User())))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }
        return view('frontend.team.leader.after-action-reports',['team'=>$team]);

    }

    public function aviationDashboard()
    {
        return view('frontend.aviation.dashboard');
    }

    public function disciplinary($team)
    {
        $team = Team::findOrFail($team);
        if(!$team->isLeader(\Auth::User()))
        {
            flash('You do not have permission to access this.','danger');
            return redirect(route('frontend.team',$team->id));
        }

        return view('frontend.team.leader.disciplinary',['team'=>$team]);
    }
}
