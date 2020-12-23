<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ClubRepositoryInterface;
use Illuminate\Support\Collection;

class StandingController extends Controller
{
    public ClubRepositoryInterface $clubRepository;

    public function __construct(ClubRepositoryInterface $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    public function index(): Collection
    {
        return $this->clubRepository->index();
    }
}
