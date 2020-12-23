<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Http\Requests\FixtureStoreRequest;
use App\Http\Services\FixtureService;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;

class FixtureController extends Controller
{
    public FixtureService $fixtureService;
    public FixtureRepositoryInterface $fixtureRepository;

    /**
     * FixtureController constructor.
     *
     * @param  FixtureService  $fixtureService
     * @param  FixtureRepositoryInterface  $fixtureRepository
     */
    public function __construct(FixtureService $fixtureService, FixtureRepositoryInterface $fixtureRepository)
    {
        $this->fixtureService = $fixtureService;
        $this->fixtureRepository = $fixtureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->fixtureRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FixtureStoreRequest  $request
     *
     * @return JsonResponse
     */
    public function store(FixtureStoreRequest $request): JsonResponse
    {
        $this->fixtureService->generateFixture($request);

        return response()->json([], 201);
    }
}
