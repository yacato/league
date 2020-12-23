<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ClubRepositoryInterface;
use App\Models\Club;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class ClubRepository implements ClubRepositoryInterface
{
    public Club $club;

    /**
     * FixtureRepository constructor.
     *
     * @param  Club  $club
     */
    public function __construct(Club $club)
    {
        $this->club = $club;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->club->orderBy('points', 'DESC')->orderByRaw('goals_for - goals_against DESC')->get();
    }

    /**
     * @param  int  $count
     *
     * @return EloquentCollection
     */
    public function regenerateClubs(int $count = 4): EloquentCollection
    {
        $this->deleteAll();

        return $this->createWithFactory($count);
    }

    /**
     * @param  int  $count
     *
     * @return EloquentCollection
     */
    public function createWithFactory(int $count = 1): EloquentCollection
    {
        return $this->club->factory()->count($count)->create();
    }

    public function deleteAll(): void
    {
        $this->club->whereNotNull('id')->delete();
    }

    /**
     * @param  Club  $club
     * @param  array  $scoreAndPoint
     *
     * @return bool
     */
    public function updateGoalAndPoint(Club $club, array $scoreAndPoint): void
    {
        $club->update([
            'goals_for' => $club->goals_for + $scoreAndPoint['goals_for'],
            'goals_against' => $club->goals_against + $scoreAndPoint['goals_against'],
            'points' => $club->points + $scoreAndPoint['points'],
        ]);
    }
}
