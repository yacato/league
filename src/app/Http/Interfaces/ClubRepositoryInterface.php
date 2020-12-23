<?php

namespace App\Http\Interfaces;

use App\Models\Club;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface ClubRepositoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param  int  $count
     *
     * @return EloquentCollection
     */
    public function regenerateClubs(int $count = 4): EloquentCollection;

    /**
     * @param  int  $count
     *
     * @return EloquentCollection
     */
    public function createWithFactory(int $count = 1): EloquentCollection;

    /**
     * @return void
     */
    public function deleteAll(): void;

    /**
     * @param  Club  $club
     * @param  array  $scoreAndPoint
     *
     * @return void
     */
    public function updateGoalAndPoint(Club $club, array $scoreAndPoint): void;
}
