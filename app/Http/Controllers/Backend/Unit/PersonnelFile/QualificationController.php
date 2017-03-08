<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Http\Controllers\Backend\Unit\PersonnelFile;

use App\Models\Unit\PersonnelFile\Qualification;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Unit\PersonnelFiles\QualificationRepositoryContract;
use App\Http\Requests\Backend\PersonnelFile\ManageQualificationRequest;
use App\Http\Requests\Backend\PersonnelFile\CreateQualificationRequest;
use App\Http\Requests\Backend\PersonnelFile\UpdateQualificationRequest;
use Yajra\Datatables\Datatables;

/**
 * Class QualificationController
 * @package App\Http\Controllers\Backend\Unit\PersonnelFile
 */
class QualificationController extends Controller
{
    /**
     * @var QualificationRepositoryContract
     */
    protected $qualifications;

    /**
     * @param QualificationRepositoryContract $qualifications
     */
    public function __construct(QualificationRepositoryContract $qualifications)
    {
        $this->qualifications = $qualifications;
    }

    /**
     * @param ManageQualificationRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageQualificationRequest $request)
    {
        return view('backend.personnel-files.qualifications.index');
    }

    /**
     * @param ManageQualificationRequest $request
     * @return mixed
     */
    public function get(ManageQualificationRequest $request) {

        return Datatables::of($this->qualifications->getForDataTable($request->get('published'), $request->get('trashed')))
            ->editColumn('published', function($qualification) {
                return $qualification->published_label;
            })
            ->addColumn('actions', function($qualification) {
                return $qualification->action_buttons;
            })
            ->make(true);
    }

    /**
     * @param ManageQualificationRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ManageQualificationRequest $request)
    {
        return view('backend.personnel-files.qualifications.create');
    }

    /**
     * @param CreateQualificationRequest $request
     * @return mixed
     */
    public function store(CreateQualificationRequest $request)
    {
        $this->qualifications->create($request->all(),$request->file('picture'));

        return redirect()->route('admin.personnel-file.qualification.index')->withFlashSuccess(trans('alerts.backend.qualifications.created'));
    }

    /**
     * @param $id
     * @param ManageQualificationRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, ManageQualificationRequest $request)
    {
        $qualification = Qualification::findOrFail($id);
        return view('backend.personnel-files.qualifications.edit', [
            'qualification' => $qualification,
            'media' => $qualification->getMedia()
        ]);
    }

    /**
     * @param $id
     * @param ManageQualificationRequest $request
     * @return mixed
     */
    public function restore($id, ManageQualificationRequest $request)
    {
        $qualification = Qualification::withTrashed()->findOrFail($id);
        $this->qualifications->restore($qualification);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.qualifications.restored'));
    }

    /**
     * @param $qualification
     * @param UpdateQualificationRequest $request
     * @return mixed
     */
    public function update($qualification, UpdateQualificationRequest $request)
    {
        $qualification = Qualification::findOrFail($qualification);
        if($request->hasFile('picture'))
        {
            $this->qualifications->update($qualification, $request->except('picture'),$request->file('picture'));
        } else {
            $this->qualifications->update($qualification, $request->except('picture'));
        }
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.qualifications.updated'));
    }

    /**
     * @param $id
     * @param ManageQualificationRequest $request
     * @return mixed
     */
    public function destroy($id, ManageQualificationRequest $request)
    {
        $qualification = Qualification::findOrFail($id);
        $this->qualifications->destroy($qualification);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.deleted'));
    }

    /**
     * @param $id
     * @param ManageQualificationRequest $request
     * @return mixed
     */
    public function delete($id, ManageQualificationRequest $request)
    {
        $qualification = Qualification::withTrashed()->findOrFail($id);
        $this->qualifications->delete($qualification);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.deleted_permanently'));
    }

    /**
     * @param ManageQualificationRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(ManageQualificationRequest $request)
    {
        return view('backend.personnel-files.qualifications.deleted');
    }

    /**
     * @param $qualification
     * @param $published
     * @param ManageQualificationRequest $request
     * @return mixed
     */
    public function mark($qualification, $published, ManageQualificationRequest $request)
    {
        $qualification = Qualification::findOrFail($qualification);
        $this->qualifications->mark($qualification, $published);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.qualifications.updated'));
    }
}
