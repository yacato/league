<?php

namespace App\Http\Interfaces;

use App\Models\Fixture;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

/**
 * Interface FixtureRepositoryInterface
 * @package App\Http\Interfaces
 */
interface FixtureRepositoryInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param  int  $week
     *
     * @return EloquentCollection
     */
    public function weeklyFixture(int $week): EloquentCollection;

    /**
     * @param  array  $fixture
     * @param  int  $weekCount
     *
     * @return array
     */
    public function generateSecondHalf(array $fixture, int $weekCount): array;

    /**
     * @param  array  $fixtures
     *
     * @return void
     */
    public function insert(array $fixtures): void;

    /**
     * @param  Fixture  $fixture
     * @param $result
     *
     * @return bool
     */
    public function updateFixture(Fixture $fixture, $result): bool;

    /**
     * @param  int  $weekNumber
     * @param  EloquentCollection  $clubs
     * @param  Collection  $fixture
     *
     * @return Collection
     */
    public function generateWeekFixture(int $weekNumber, EloquentCollection $clubs, Collection $fixture): Collection;

    /**
     * @param  int  $week
     *
     * @return bool
     */
    public function isWeekValidForPlay(int $week): bool;

    /**
     * @return array
     */
    public function unPlayedWeeks(): array;

}
