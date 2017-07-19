<?php

namespace App\Http\Controllers\Backend\Unit;

use App\Models\Unit\Operation;
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
                'published' => 1,
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
                'published' => 1,
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

    public function delete($id)
    {

    }
}
