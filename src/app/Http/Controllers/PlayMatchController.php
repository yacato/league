<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Http\Requests\PlayMatchWeeklyRequest;
use App\Http\Services\PlayMatchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * Class PlayMatchController
 * @package App\Http\Controllers
 */
class PlayMatchController extends Controller
{

    public PlayMatchService $playMatchService;
    public FixtureRepositoryInterface $fixtureRepository;

    /**
     * PlayMatchController constructor.
     *
     * @param  PlayMatchService  $playMatchService
     * @param  FixtureRepositoryInterface  $fixtureRepository
     */
    public function __construct(
        PlayMatchService $playMatchService,
        FixtureRepositoryInterface $fixtureRepository
    ) {
        $this->playMatchService = $playMatchService;
        $this->fixtureRepository = $fixtureRepository;
    }

    /**
     * @param  PlayMatchWeeklyRequest  $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function weekly(PlayMatchWeeklyRequest $request): JsonResponse
    {
        if (! $this->fixtureRepository->isWeekValidForPlay($request->week)) {
            throw ValidationException::withMessages(['week' => 'Week is not valid.']);
        }

        $this->playMatchService->weekly($request->week);

        return response()->json([], 201);
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $this->playMatchService->playAll();

        return response()->json([], 201);
    }
}
