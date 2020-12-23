<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ClubRepositoryInterface;
use App\Models\Club;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

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
}
