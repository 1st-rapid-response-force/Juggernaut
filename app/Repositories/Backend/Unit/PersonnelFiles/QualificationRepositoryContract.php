<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit\PersonnelFiles;

use App\Models\Unit\PersonnelFile\Qualification;

/**
 * Interface QualificationRepositoryContract
 * @package App\Repositories\Backend\Unit\PersonnelFiles
 */
interface QualificationRepositoryContract {
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
     * @param Qualification $qualification
     * @param $input
     * @param $picture
     * @return mixed
     */
    public function update(Qualification $qualification, $input, $picture = null);

    /**
     * @param Qualification $qualification
     * @return mixed
     */
    public function destroy(Qualification $qualification);

    /**
     * @param Qualification $user
     * @return mixed
     */
    public function delete(Qualification $user);

    /**
     * @param Qualification $qualification
     * @return mixed
     */
    public function restore(Qualification $qualification);

    /**
     * @param Qualification $qualification
     * @param $picture
     * @return mixed
     */
    public function uploadPicture(Qualification $qualification, $picture);

    /**
     * @param Qualification $qualification
     * @return mixed
     */
    public function removePicture(Qualification $qualification);

    /**
     * @param Qualification $qualification
     * @param $published
     * @return mixed
     */
    public function mark(Qualification $qualification, $published);

}
