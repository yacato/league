<?php

namespace App\Providers;

use App\Http\Interfaces\ClubRepositoryInterface;
use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Http\Repositories\ClubRepository;
use App\Http\Repositories\FixtureRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(FixtureRepositoryInterface::class, FixtureRepository::class);
        $this->app->bind(ClubRepositoryInterface::class, ClubRepository::class);
    }
}
