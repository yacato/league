<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface FixtureRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param  array  $fixtures
     *
     * @return void
     */
    public function insert(array $fixtures): void;

    /**
     * @param  int  $weekNumber
     * @param  EloquentCollection  $clubs
     * @param  Collection  $fixture
     *
     * @return Collection
     */
    public function generateWeekFixture(int $weekNumber, EloquentCollection $clubs, Collection $fixture): Collection;
}
