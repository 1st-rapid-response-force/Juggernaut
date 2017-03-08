<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit\PersonnelFiles;

use App\Models\Unit\PersonnelFile\Award;

/**
 * Interface AwardRepositoryContract
 * @package App\Repositories\Backend\Unit\PersonnelFiles
 */
interface AwardRepositoryContract {
    /**
     * @param int $published
     * @param bool $trashed
     * @return mixed
     */
    public function getForDataTable($published = 1, $trashed = false);

    /**
     * @param $input
     * @param $picture
     * @return mixed
     */
    public function create($input, $picture);

    /**
     * @param Award $award
     * @param $input
     * @param $picture
     * @return mixed
     */
    public function update(Award $award, $input, $picture = null);

    /**
     * @param Award $award
     * @return mixed
     */
    public function destroy(Award $award);

    /**
     * @param Award $award
     * @return mixed
     */
    public function delete(Award $user);

    /**
     * @param Award $award
     * @return mixed
     */
    public function restore(Award $award);

    /**
     * @param Award $award
     * @param $picture
     * @return mixed
     */
    public function uploadPicture(Award $award, $picture);

    /**
     * @param Award $award
     * @return mixed
     */
    public function removePicture(Award $award);

    /**
     * @param Award $award
     * @param $published
     * @return mixed
     */
    public function mark(Award $award, $published);

}
