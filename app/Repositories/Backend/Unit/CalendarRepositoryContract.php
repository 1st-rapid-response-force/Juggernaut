<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Backend\Unit;

use App\Models\Unit\Event;
use App\User;

/**
 * Interface CalendarRepositoryContract
 * @package App\Repositories\Backend\Unit
 */
interface CalendarRepositoryContract {

    /**
     * @param User $user
     * @return mixed
     */
    public function getCalendar(User $user);
    /**
     * @param $input
     * @param User $user
     * @return mixed
     */
    public function create($input, User $user);

    /**
     * @param Event $event
     * @param $input
     * @param User $user
     * @return mixed
     */
    public function update(Event $event, $input, User $user);

    /**
     * @param Event $event
     * @return mixed
     */
    public function delete(Event $event);

}