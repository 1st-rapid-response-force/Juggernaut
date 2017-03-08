<?php
/**
 * Copyright (c) 2016. Unit-Forge. All Rights Reserved
 */

namespace App\Repositories\Frontend\Unit\Documentation;

use App\Models\Unit\Documentation\Category;
use Carbon\Carbon;
use App\Models\Unit\Event;
use App\Models\Unit\PublicEvent;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class EloquentCalendarRepository
 * @package App\Repositories\Backend\Unit
 */
class EloquentDocumentationRepository implements DocumentationRepositoryContract {
    public function getMenu()
    {
        $tree = collect([
            [
                'text' => 'Documentation',
                'href' => route('frontend.documentation.index'),
                'state' => [
                    'selected' => true
                ]
            ],
            [
                'text' => 'About Phoenix',
                'href' => route('frontend.documentation.about-phoenix')
            ]
        ]);
        return $tree->toJson();
    }

    private function buildMenu()
    {
    }

}