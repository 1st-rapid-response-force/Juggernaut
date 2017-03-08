<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind Application Repositories
        // Backend Awards
        $this->app->bind(
            \App\Repositories\Backend\Unit\PersonnelFiles\AwardRepositoryContract::class,
            \App\Repositories\Backend\Unit\PersonnelFiles\EloquentAwardRepository::class
        );

        // Backend Qualification
        $this->app->bind(
            \App\Repositories\Backend\Unit\PersonnelFiles\QualificationRepositoryContract::class,
            \App\Repositories\Backend\Unit\PersonnelFiles\EloquentQualificationRepository::class
        );

        // Backend Calendar
        $this->app->bind(
            \App\Repositories\Backend\Unit\CalendarRepositoryContract::class,
            \App\Repositories\Backend\Unit\EloquentCalendarRepository::class
        );

        // Frontend Calendar
        $this->app->bind(
            \App\Repositories\Frontend\Unit\CalendarRepositoryContract::class,
            \App\Repositories\Frontend\Unit\EloquentCalendarRepository::class
        );

        // Frontend Teamspeak
        $this->app->bind(
            \App\Repositories\Frontend\Unit\Teamspeak\TeamspeakContract::class,
            \App\Repositories\Frontend\Unit\Teamspeak\Teamspeak::class
        );
    }
}
