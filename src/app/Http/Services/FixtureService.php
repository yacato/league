<?php

namespace App\Http\Services;

use App\Http\Interfaces\ClubRepositoryInterface;
use App\Http\Interfaces\FixtureRepositoryInterface;
use Illuminate\Http\JsonResponse;

class FixtureService
{
    public FixtureRepositoryInterface $fixtureRepository;
    public ClubRepositoryInterface $clubRepository;

    /**
     * FixtureService constructor.
     *
     * @param  FixtureRepositoryInterface  $fixtureRepository
     * @param  ClubRepositoryInterface  $clubRepository
     */
    public function __construct(FixtureRepositoryInterface $fixtureRepository, ClubRepositoryInterface $clubRepository)
    {
        $this->fixtureRepository = $fixtureRepository;
        $this->clubRepository = $clubRepository;
    }

    /**
     * @param $request
     *
     * @return JsonResponse
     */
    public function generateFixture($request): JsonResponse
    {
        $clubs = $this->clubRepository->regenerateClubs($request->clubCount);
        $fixture = collect();
        $weekCount = $clubs->count() - 1;

        foreach (range(1, $weekCount) as $weekNumber) {
            $fixture = $fixture->merge($this->fixtureRepository->generateWeekFixture($weekNumber, $clubs, $fixture));
        }

        $this->fixtureRepository->insert($fixture->toArray());

        return response()->json([], 201);
    }
}
