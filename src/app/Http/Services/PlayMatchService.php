<?php

namespace App\Http\Services;

use App\Http\Interfaces\ClubRepositoryInterface;
use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Models\Fixture;

/**
 * Class PlayMatchService
 * @package App\Http\Services
 */
class PlayMatchService
{
    public FixtureRepositoryInterface $fixtureRepository;
    public ClubRepositoryInterface $clubRepository;

    /**
     * PlayMatchService constructor.
     *
     * @param  FixtureRepositoryInterface  $fixtureRepository
     * @param  ClubRepositoryInterface  $clubRepository
     */
    public function __construct(
        FixtureRepositoryInterface $fixtureRepository,
        ClubRepositoryInterface $clubRepository
    ) {
        $this->fixtureRepository = $fixtureRepository;
        $this->clubRepository = $clubRepository;
    }

    /**
     * @return void
     */
    public function playAll(): void
    {
        foreach ($this->fixtureRepository->unPlayedWeeks() as $weekNumber) {
            $this->weekly($weekNumber);
        }
    }

    /**
     * @param  int  $weekNumber
     *
     * @return void
     */
    public function weekly(int $weekNumber): void
    {
        $weeklyMatches = $this->fixtureRepository->weeklyFixture($weekNumber);

        foreach ($weeklyMatches as $match) {
            $result = $this->foundResult($match);
            $scoreAndPoint = $this->generateScoreAndPoints($result);

            $this->fixtureRepository->updateFixture($match, [
                'home_club_goal' => $scoreAndPoint['home']['goals_for'],
                'away_club_goal' => $scoreAndPoint['away']['goals_for'],
                'result' => $result,
            ]);

            $this->clubRepository->updateGoalAndPoint($match->homeClub, $scoreAndPoint['home']);
            $this->clubRepository->updateGoalAndPoint($match->awayClub, $scoreAndPoint['away']);
        }
    }

    /**
     * @param  Fixture  $match
     *
     * @return string
     */
    public function foundResult(Fixture $match): string
    {
        $drawPoint = $this->calculateDrawPoint([
            $match->homeClub->power_rank,
            $match->awayClub->power_rank,
        ]);

        $totalPoint = $drawPoint + $match->homeClub->power_rank + $match->awayClub->power_rank;
        $randomNumber = rand(1, $totalPoint);

        if ($randomNumber < $match->homeClub->power_rank) {
            return 'home';
        } else if ($randomNumber < $match->homeClub->power_rank + $drawPoint) {
            return 'draw';
        }

        return 'away';
    }

    /**
     * @param  array  $powerRanks
     *
     * @return float
     */
    public function calculateDrawPoint(array $powerRanks): float
    {
        sort($powerRanks);

        return $powerRanks[0] * 100 / $powerRanks[1];
    }

    /**
     * @param  string  $result
     *
     * @return array
     */
    public function generateScoreAndPoints(string $result): array
    {
        switch ($result) {
            case 'home':
                $homeClubGoal = rand(1, 5);
                $awayClubGoal = rand(0, ($homeClubGoal - 1));
                return [
                    'home' => ['goals_for' => $homeClubGoal, 'goals_against' => $awayClubGoal, 'points' => 3],
                    'away' => ['goals_for' => $awayClubGoal, 'goals_against' => $homeClubGoal, 'points' => 0],
                ];
            case 'draw':
                $drawGoal = rand(0, 5);
                return [
                    'home' => ['goals_for' => $drawGoal, 'goals_against'=> $drawGoal, 'points' => 1],
                    'away' => ['goals_for' => $drawGoal, 'goals_against'=> $drawGoal, 'points' => 1],
                ];
            case 'away':
                $awayClubGoal = rand(1, 5);
                $homeClubGoal = rand(0, ($awayClubGoal - 1));
                return [
                    'home' => ['goals_for' => $homeClubGoal, 'goals_against'=> $awayClubGoal, 'points' => 0],
                    'away' => ['goals_for' => $awayClubGoal, 'goals_against'=> $homeClubGoal, 'points' => 3],
                ];
        }
    }
}
