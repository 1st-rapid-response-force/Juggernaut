<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Frontend\Unit;

use App\Models\Unit\Event;
use App\User;


/**
 * Interface CalendarRepositoryContract
 * @package App\Repositories\Frontend\Unit
 */
interface CalendarRepositoryContract {

    /**
     * @param User $user
     * @return mixed
     */
    public function getCalendar(User $user);
}