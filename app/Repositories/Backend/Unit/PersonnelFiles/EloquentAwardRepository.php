<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit\PersonnelFiles;

use App\Models\Unit\PersonnelFile\Award;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardCreated;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardUpdated;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardRestored;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardDeleted;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardPermanentlyDeleted;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardPublished;
use App\Events\Backend\Unit\PersonnelFile\Award\AwardUnpublished;

/**
 * Class EloquentHistoryRepository
 * @package App\Repositories\Backend\Unit\PersonnelFiles
 */
class EloquentAwardRepository implements AwardRepositoryContract {
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
            return Award::onlyTrashed()
                ->select(['id', 'name', 'promotion_points', 'published', 'created_at', 'updated_at', 'deleted_at'])
                ->get();
        }

        return Award::select(['id', 'name', 'promotion_points', 'published', 'created_at', 'updated_at', 'deleted_at'])
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
        $award = $this->createAwardStub($input);

        DB::transaction(function() use ($award, $picture) {
            if($award->save())
            {
                $this->uploadPicture($award, $picture);
                event(new AwardCreated($award));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.awards.create_error'));
        });
    }

    /**
     * @param Award $award
     * @param $picture
     * @return bool
     * @param $input
     */
    public function update(Award $award, $input, $picture = null)
    {
        if(isset($picture))
        {
            $this->removePicture($award);
            $this->uploadPicture($award, $picture);
        }

        DB::transaction(function() use ($award,$input) {
            if($award->update($input))
            {
                event(new AwardUpdated($award));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.awards.update_error'));
        });
    }

    /**
     * @param Award $award
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Award $award)
    {
        if($award->delete())
        {
            event(new AwardDeleted($award));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.awards.delete_error'));
    }

    /**
     * @param Award $award
     * @return bool
     * @throws GeneralException
     */
    public function delete(Award $award)
    {
        //Failsafe
        if (is_null($award->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.awards.failsafe_delete'));
        }

        DB::transaction(function() use ($award) {

            if ($award->forceDelete()) {
                event(new AwardPermanentlyDeleted($award));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.awards.delete_error'));
        });
    }

    /**
     * @param Award $award
     * @return bool
     * @throws GeneralException
     */
    public function restore(Award $award)
    {
        //Failsafe
        if (is_null($award->deleted_at)) {
            throw new GeneralException(trans('exceptions.backend.awards.failsafe_restore'));
        }

        DB::transaction(function() use ($award) {

            if ($award->restore()) {
                event(new AwardRestored($award));
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.awards.restore_error'));
        });
    }

    /**
     * @param Award $award
     * @param $picture
     * @return bool
     * @throws GeneralException
     */
    public function uploadPicture(Award $award, $picture)
    {
        if($award->addMedia($picture)->toMediaLibrary())
        {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.awards.picture_error'));
    }

    /**
     * @param Award $award
     * @return bool
     * @throws GeneralException
     */
    public function removePicture(Award $award)
    {
        if($award->clearMediaCollection())
        {
            return true;
        }
        throw new GeneralException(trans('exceptions.backend.awards.picture_clear_error'));
    }

    public function mark(Award $award, $published)
    {
        $award->published = $published;

        //Log history dependent on status
        switch ($published) {
            case 0:
                event(new AwardUnpublished($award));
                break;

            case 1:
                event(new AwardPublished($award));
                break;
        }

        if ($award->save()) {
            return true;
        }


        throw new GeneralException(trans('exceptions.backend.awards.mark_error'));
    }


    /**
     * @param $input
     * @return Award
     */
    private function createAwardStub($input)
    {
        $award                    = new Award;
        $award->name              = $input['name'];
        $award->description       = $input['description'];
        $award->promotion_points  = isset($input['promotion_points']) ? $input['promotion_points'] : null;
        $award->published         = $input['published'];
        return $award;
    }
}
