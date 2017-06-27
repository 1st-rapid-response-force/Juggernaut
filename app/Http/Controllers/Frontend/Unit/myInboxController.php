<?php

namespace App\Http\Controllers\Frontend\Unit;

use App\User;
use Carbon\Carbon;
use App\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class myInboxController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $currentUserId = \Auth::user()->id;
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(15);;

        return view('frontend.my-inbox.index', compact('threads', 'currentUserId'))
            ->with('user',$user);
    }

    public function search(Request $request)
    {
        $user = \Auth::user();
        $currentUserId = \Auth::user()->id;
        $threads = Thread::where('subject', 'LIKE', '%'.$request->search.'%')->latest('updated_at')->with->paginate(15);
        return view('frontend.my-inbox.index-search', compact('threads', 'cu
        rrentUserId'))
            ->with('user',$user);
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $user = \Auth::user();
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('/my-inbox');
        }
        if($thread->hasParticipant(\Auth::id())){
            $thread->markAsRead($user->id);
            $users = User::whereNotIn('id', $thread->participantsUserIds($user->id))->get();
            $thread->markAsRead($user->id);

            \Log::info('User viewed inbox message', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'thread_id' => $thread->id, 'thread' => $thread->subject]);

            return view('frontend.my-inbox.show')
                ->with('user',$user)
                ->with('thread',$thread)
                ->with('users',$users);
        }else{
            flash('Conversation not found','danger');
            return redirect('/my-inbox');
        }
    }

    public function create()
    {
        $user = \Auth::user();
        return view('frontend.my-inbox.create')->with('user',$user);
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        $user = \Auth::User();
        $recipients = $request->autocomplete;
        $thread = Thread::create(
            [
                'subject' => $request->subject,
            ]
        );
        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => \Auth::user()->id,
                'body'      => \Crypt::encrypt($request->message),
            ]
        );

        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $message->addMedia($file)->toCollection('attachments');
            }

        }

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => \Auth::user()->id,
                'last_read' => new Carbon
            ]
        );
        $data = [
            'title' => $request->subject,
            'content' => $request->message,
            'creator' => \Auth::user()->vpf,
            'id' => $thread->id
        ];
        // Recipients
        if (\Request::has('autocomplete')) {
            $thread->addParticipant($recipients);
            $this->emailUsersNewMessage($recipients,$data);
        }
        \Log::info('User created a new message thread', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'thread_id' => $thread->id, 'thread' => $thread->subject]);

        return redirect('/my-inbox/'.$thread->id);
    }

    /**
     * Edit Message
     *
     * @return mixed
     */
    public function editMessage($id)
    {
        $user = \Auth::user();
        try {
            $message = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            flash('danger', 'The message was not found.');
            return redirect('/my-inbox');
        }
        if(!($user->id == $message->user->id))
        {
            flash('You cannot edit a message that is not yours.','danger');
            return redirect('/my-inbox');
        }
        \Log::info('User edited inbox message', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'message_id' => $message->id]);
        return view('frontend.my-inbox.edit-message')
            ->with('user',$user)
            ->with('message',$message)
            ->with('thread',$message->thread);
    }
    /**
     * Adds a new message to a current thread / Add Participants
     *
     * @param $id
     * @return mixed
     */
    public function update(Request $request,$id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            flash('danger', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('my-inbox');
        }
        //Participant add or reply?
        if($request->action == 'addUsers')
        {
            $recipients = $request->autocomplete_add;
            $dataNewParticipant = [
                'title' => $thread->subject,
                'id' => $thread->id
            ];
            \Log::info('User added participants to thread', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'thread_id' => $thread->id, 'participants' => $recipients]);
            // Recipients
            if (\Request::has('autocomplete_add')) {
                $thread->addParticipant($recipients);
                $this->emailUsersNewParticipant($recipients,$dataNewParticipant);
            }
        } else {
            $thread->activateAllParticipants();
            // Message
            $message = Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => \Auth::id(),
                    'body'      => \Crypt::encrypt($request->message),
                ]
            );

            if($request->hasFile('file'))
            {
                foreach ($request->file as $file)
                {
                    $message->addMedia($file)->toCollection('attachments');
                }

            }
            \Log::info('User sent a new message in thread', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'thread_id' => $thread->id, 'message_id' => $message->id]);

            $data = [
                'title' => $thread->subject,
                'content' => $request->message,
                'creator' => \Auth::user()->member,
                'id' => $thread->id
            ];
            // Add replier as a participant
            $participant = Participant::firstOrCreate(
                [
                    'thread_id' => $thread->id,
                    'user_id'   => \Auth::user()->id
                ]
            );
            $participant->last_read = new Carbon;
            $participant->save();
            $this->emailUsersNewMessage($thread->participantsUserIds(),$data);
        }
        return redirect('my-inbox/' . $id);
    }

    /**
     * Edit Message
     *
     * @return mixed
     */
    public function editMessageSave(Request $request,$id)
    {
        $user = \Auth::user();
        try {
            $message = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('The message was not found.','danger');
            return redirect('/my-inbox');
        }
        $message->body = \Crypt::encrypt($request->body);
        $message->save();

        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $message->addMedia($file)->toCollection('attachments');
            }

        }

        \Log::info('User added participants to thread', ['user_id' => \Auth::User()->id,'member' => \Auth::User()->member->searchable_name, 'thread_id' => $message->thread->id, 'message_id' => $message->id]);
        return redirect('/my-inbox/'.$message->thread->id);
    }

    /**
     * Deals with deletion of threads
     *
     * @param $id
     * @return mixed
     */
    public function deleteInboxThreads(Request $request)
    {
        $user = \Auth::user();
        if(!isset($request->delete))
        {
           flash('No Conversations selected','warning');
        } else {
            $user->threads()->detach($request->delete);
            flash('You have left these conversations');
        }
        return redirect('/my-inbox');
    }

    /**
     * Sends emails to all recipients
     * @param $users
     * @param $data
     */
    private function emailUsersNewMessage($users,$data)
    {
        foreach($users as $userID)
        {
            $user = User::find($userID);
            \Mail::send('emails.newMessage', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
                $m->to($user->email, $user->member);
                $m->subject('1st RRF - New Message - '.$data['title']);
                $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
                $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
            });
        }
    }
    /**
     * Sends emails to all recipients
     * @param $users
     * @param $data
     */
    private function emailUsersNewParticipant($users,$data)
    {
        foreach($users as $userID)
        {
            $user = User::find($userID);
            \Mail::send('emails.newParticipant', ['user' => $user,'data' =>$data], function ($m) use ($user,$data) {
                $m->to($user->email, $user->member);
                $m->subject('1st RRF - You have been added to a Conversation');
                $m->from('no-reply@1st-rrf.com','1st Rapid Response Force');
                $m->sender('no-reply@1st-rrf.com','1st Rapid Response Force');
            });
        }
    }
}
