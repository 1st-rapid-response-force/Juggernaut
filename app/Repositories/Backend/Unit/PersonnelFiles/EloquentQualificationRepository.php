<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit\PersonnelFiles;

use App\Models\Unit\PersonnelFile\Qualification;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationCreated;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationUpdated;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationRestored;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationDeleted;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationPermanentlyDeleted;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationPublished;
use App\Events\Backend\Unit\PersonnelFile\Qualification\QualificationUnpublished;

/**
 * Class EloquentHistoryRepository
 * @package App\Repositories\Backend\Unit\PersonnelFiles
 */
class EloquentQualificationRepository implements QualificationRepositoryContract {
    /**
     * @param int $published
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable($published = 1, $trashed = false)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        if ($trashed == "true") {
            return Qualification::onlyTrashed()
                ->select(['id', 'name', 'promotion_points', 'published', 'created_at', 'updated_at', 'deleted_at'])
                ->get();
        }

        return Qualification::select(['id', 'name', 'promotion_points', 'published', 'created_at', 'updated_at', 'deleted_at'])
            ->get();
    }

    /**
     * @param $input
     * @param $picture
     * @return bool
     * @throws GeneralException
     */
    public function create($input, $picture)
    {
        $qualification = $this->createQualificationStub($input);

        DB::transaction(function() use ($qualification, $picture) {
            if($qualification->save())
            {
                $this->uploadPicture($qualification, $picture);
                event(new QualificationCreated($qualification));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.qualifications.create_error'));
        });
    }

    /**
     * @param Qualification $qualification
     * @param $picture
     * @return bool
     * @param $input
     */
    public function update(Qualification $qualification, $input, $picture = null)
    {
        if(isset($picture))
        {
            $this->removePicture($qualification);
            $this->uploadPicture($qualification, $picture);
        }

        DB::transaction(function() use ($qualification,$input) {
            if($qualification->update($input))
            {
                event(new QualificationUpdated($qualification));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.qualifications.update_error'));
        });
    }

    /**
     * @param Qualification $qualification
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Qualification $qualification)
    {
        if($qualification->delete())
        {
            event(new QualificationDeleted($qualification));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.qualifications.delete_error'));
    }

    /**
     * @param Qualification $qualification
     * @return bool
     * @throws GeneralException
     */
    public function delete(Qualification $qualification)
    {
        //Failsafe
        if (is_null($qualification->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.qualifications.failsafe_delete'));
        }

        DB::transaction(function() use ($qualification) {

            if ($qualification->forceDelete()) {
                event(new QualificationPermanentlyDeleted($qualification));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.qualifications.delete_error'));
        });
    }

    /**
     * @param Qualification $qualification
     * @return bool
     * @throws GeneralException
     */
    public function restore(Qualification $qualification)
    {
        //Failsafe
        if (is_null($qualification->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.qualifications.failsafe_restore'));
        }

        DB::transaction(function() use ($qualification) {

            if ($qualification->restore()) {
                event(new QualificationRestored($qualification));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.qualifications.restore_error'));
        });
    }

    /**
     * @param Qualification $qualification
     * @param $picture
     * @return bool
     * @throws GeneralException
     */
    public function uploadPicture(Qualification $qualification, $picture)
    {
        if($qualification->addMedia($picture)->toMediaLibrary())
        {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.qualifications.picture_error'));
    }

    /**
     * @param Qualification $qualification
     * @return bool
     * @throws GeneralException
     */
    public function removePicture(Qualification $qualification)
    {
        if($qualification->clearMediaCollection())
        {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.qualifications.picture_clear_error'));
    }

    public function mark(Qualification $qualification, $published)
    {
        $qualification->published = $published;

        //Log history dependent on status
        switch ($published) {
            case 0:
                event(new QualificationUnpublished($qualification));
                break;

            case 1:
                event(new QualificationPublished($qualification));
                break;
        }

        if ($qualification->save()) {
            return true;
        }


        throw new GeneralException(trans('exceptions.backend.qualifications.mark_error'));
    }


    /**
     * @param $input
     * @return Qualification
     */
    private function createQualificationStub($input)
    {
        $qualification                    = new Qualification;
        $qualification->name              = $input['name'];
        $qualification->description       = $input['description'];
        $qualification->promotion_points  = isset($input['promotion_points']) ? $input['promotion_points'] : null;
        $qualification->published         = $input['published'];
        return $qualification;
    }
}
