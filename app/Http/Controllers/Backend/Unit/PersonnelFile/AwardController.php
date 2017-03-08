<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Http\Controllers\Backend\Unit\PersonnelFile;

use App\Models\Unit\PersonnelFile\Award;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Unit\PersonnelFiles\AwardRepositoryContract;
use App\Http\Requests\Backend\PersonnelFile\ManageAwardRequest;
use App\Http\Requests\Backend\PersonnelFile\CreateAwardRequest;
use App\Http\Requests\Backend\PersonnelFile\UpdateAwardRequest;
use Yajra\Datatables\Datatables;

/**
 * Class AwardController
 * @package App\Http\Controllers\Backend\Unit\PersonnelFile
 */
class AwardController extends Controller
{
    /**
     * @var AwardRepositoryContract
     */
    protected $awards;

    /**
     * @param AwardRepositoryContract $awards
     */
    public function __construct(AwardRepositoryContract $awards)
    {
        $this->awards = $awards;
    }

    /**
     * @param ManageAwardRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageAwardRequest $request)
    {
        return view('backend.personnel-files.awards.index');
    }

    /**
     * @param ManageAwardRequest $request
     * @return mixed
     */
    public function get(ManageAwardRequest $request) {

        return Datatables::of($this->awards->getForDataTable($request->get('published'), $request->get('trashed')))
            ->editColumn('published', function($award) {
                return $award->published_label;
            })
            ->addColumn('actions', function($award) {
                return $award->action_buttons;
            })
            ->make(true);
    }

    /**
     * @param ManageAwardRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(ManageAwardRequest $request)
    {
        return view('backend.personnel-files.awards.create');
    }

    /**
     * @param CreateAwardRequest $request
     * @return mixed
     */
    public function store(CreateAwardRequest $request)
    {
        $this->awards->create($request->all(),$request->file('picture'));

        return redirect()->route('admin.personnel-file.award.index')->withFlashSuccess(trans('alerts.backend.awards.created'));
    }

    /**
     * @param $id
     * @param ManageAwardRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, ManageAwardRequest $request)
    {
        $award = Award::findOrFail($id);
        return view('backend.personnel-files.awards.edit', [
            'award' => $award,
            'media' => $award->getMedia()
        ]);
    }

    /**
     * @param $id
     * @param UpdateAwardRequest $request
     * @return mixed
     */
    public function update($id, UpdateAwardRequest $request)
    {
        $award = Award::findOrFail($id);
        if($request->hasFile('picture'))
        {
            $this->awards->update($award, $request->except('picture'),$request->file('picture'));
        } else {
            $this->awards->update($award, $request->except('picture'));
        }
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.updated'));
    }

    /**
     * @param $id
     * @param ManageAwardRequest $request
     * @return mixed
     */
    public function destroy($id, ManageAwardRequest $request)
    {
        $award = Award::findOrFail($id);
        $this->awards->destroy($award);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.deleted'));
    }

    /**
     * @param $id
     * @param ManageAwardRequest $request
     * @return mixed
     */
    public function delete($id, ManageAwardRequest $request)
    {
        $award = Award::withTrashed()->findOrFail($id);
        $this->awards->delete($award);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.deleted_permanently'));
    }

    /**
     * @param ManageAwardRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleted(ManageAwardRequest $request)
    {
        return view('backend.personnel-files.awards.deleted');
    }

    /**
     * @param $id
     * @param ManageAwardRequest $request
     * @return mixed
     */
    public function restore($id, ManageAwardRequest $request)
    {
        $award = Award::withTrashed()->findOrFail($id);
        $this->awards->restore($award);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.restored'));
    }

    /**
     * @param $award
     * @param $published
     * @param ManageAwardRequest $request
     * @return mixed
     */
    public function mark($award, $published, ManageAwardRequest $request)
    {
        $award = Award::findOrFail($award);
        $this->awards->mark($award, $published);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.awards.updated'));
    }
}
