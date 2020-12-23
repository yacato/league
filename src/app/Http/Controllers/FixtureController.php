<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Http\Requests\FixtureStoreRequest;
use App\Http\Services\FixtureService;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index()
    {
        return $this->fixtureRepository->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FixtureStoreRequest $request
     * @return Response
     */
    public function store(FixtureStoreRequest $request)
    {
        return $this->fixtureService->generateFixture($request);
    }
}
