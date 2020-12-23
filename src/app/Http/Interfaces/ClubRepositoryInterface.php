<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface ClubRepositoryInterface
{
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

    public function deleteAll(): void;
}
