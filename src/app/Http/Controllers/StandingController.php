<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ClubRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class StandingController
 * @package App\Http\Controllers
 */
class StandingController extends Controller
{
    public ClubRepositoryInterface $clubRepository;

    /**
     * StandingController constructor.
     *
     * @param  ClubRepositoryInterface  $clubRepository
     */
    public function __construct(ClubRepositoryInterface $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->clubRepository->index();
    }
}
