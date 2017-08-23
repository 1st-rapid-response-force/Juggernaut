<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Operation;
use App\Models\Unit\OperationFrago;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Spatie\MediaLibrary\Media;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::all();
        return view('backend.unit.operations.index', ['operations' => $operations]);
    }

    public function create()
    {
        return view('backend.unit.operations.create');
    }

    public function store(Request $request)
    {
        //Convert Timezone from User to Server
        $start_time = new Carbon($request->start_time, \Auth::User()->timezone);
        $end_time = new Carbon($request->end_time, \Auth::User()->timezone);

        $start_time->setTimezone(config('app.timezone'));
        $end_time->setTimezone(config('app.timezone'));

        $required = implode(',',$request->required_elements);
        $optional = implode(',',$request->optional_elements);

        $operation = Operation::create(
            [
                'name' => $request->name,
                'published' => 0,
                'required_elements' => $required,
                'optional_elements' => $optional,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'description' => $request->description,
                'training' => $request->training,
                'admin' => $request->admin,
                'credit' => $request->credit
            ]
        );

        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $operation->addMedia($file)->toCollection('attachments');
            }

        }

        if($request->hasFile('banner')) {
            $operation->clearMediaCollection('banner');
            $operation->addMedia($request->file('banner'))->toCollection('banner');
        }

        flash('You created a Operation!', 'success');
        return redirect(route('admin.operations.index'));
    }

    public function edit($id)
    {
        $operation = Operation::findOrFail($id);
        return view('backend.unit.operations.edit')->with('operation',$operation);
    }

    public function update($id, Request $request)
    {
        //Convert Timezone from User to Server
        $start_time = new Carbon($request->start_time, \Auth::User()->timezone);
        $end_time = new Carbon($request->end_time, \Auth::User()->timezone);

        $start_time->setTimezone(config('app.timezone'));
        $end_time->setTimezone(config('app.timezone'));

        $required = implode(',',$request->required_elements);
        $optional = implode(',',$request->optional_elements);

        $operation = Operation::findOrFail($id);
        $operation->update(
            [
                'name' => $request->name,
                'published' => $request->published,
                'required_elements' => $required,
                'optional_elements' => $optional,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'description' => $request->description,
                'training' => $request->training,
                'admin' => $request->admin,
                'credit' => $request->credit
            ]
        );



        if($request->hasFile('file'))
        {
            foreach ($request->file as $file)
            {
                $operation->addMedia($file)->toCollection('attachments');
            }

        }
        if($request->hasFile('mission')) {
            $operation->clearMediaCollection('mission');
            $operation->addMedia($request->file('mission'))->toCollection('mission');
        }

        if($request->hasFile('banner')) {
            $operation->clearMediaCollection('banner');
            $operation->addMedia($request->file('banner'))->toCollection('banner');
        }
        flash('You have updated the Operation!', 'success');
        return redirect()->back();
    }

    public function deleteAttachment($id, $attachment)
    {
        $operation = Operation::findOrFail($id);
        $media = Media::findOrFail($attachment);
        $media->delete();
        flash('You have deleted that attachment!', 'success');
        return redirect()->back();
    }

    public function editFrago($id, $frago, Request $request)
    {
        $operation = Operation::findOrFail($id);
        $frago = OperationFrago::findOrFail($frago);
        return view('backend.unit.operations.edit-frago',['operation' => $operation, 'frago' => $frago]);
    }

    public function storeFrago($id, Request $request)
    {
        $operation = Operation::findOrFail($id);
        $operation->fragos()->create(['message' => $request->message,'member_id'=>\Auth::User()->member->id]);
        flash('You have created a Frago for this Operation!', 'success');
        return redirect()->back();
    }

    public function updateFrago($id, $frago, Request $request)
    {
        $operation = Operation::findOrFail($id);
        $frago = OperationFrago::findOrFail($frago);

        $frago->update(['message'=> $request->message]);
        flash('You have updated a Frago for this Operation!', 'success');
        return redirect(route('admin.operations.edit',$id));
    }

    public function deleteFrago($id, $frago, Request $request)
    {
        $operation = Operation::findOrFail($id);
        $frago = OperationFrago::findOrFail($frago);
        $frago->delete();
        flash('You have deleted that FRAGO!', 'success');
        return redirect()->back();
    }

    public function delete($id)
    {
        $operation = Operation::findOrFail($id);
        $operation->delete();
        flash('You have deleted the Operation!', 'success');
        return redirect()->back();
    }


}
