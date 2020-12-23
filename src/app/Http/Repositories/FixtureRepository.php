<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\FixtureRepositoryInterface;
use App\Models\Club;
use App\Models\Fixture;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class FixtureRepository
 * @package App\Http\Repositories
 */
class FixtureRepository implements FixtureRepositoryInterface
{
    public Fixture $fixture;
    public EloquentCollection $clubs;
    public Collection $leagueFixture;

    /**
     * FixtureRepository constructor.
     *
     * @param  Fixture  $fixture
     */
    public function __construct(Fixture $fixture)
    {
        $this->fixture = $fixture;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->fixture->with(['homeClub', 'awayClub'])->get();
    }

    /**
     * @param  int  $week
     *
     * @return EloquentCollection
     */
    public function weeklyFixture(int $week): EloquentCollection
    {
        return $this->fixture->whereWeek($week)->with(['homeClub', 'awayClub'])->get();
    }

    /**
     * @param  array  $fixture
     * @param  int  $weekCount
     *
     * @return array
     */
    public function generateSecondHalf(array $fixture, int $weekCount): array
    {
        $secondHalf = [];
        foreach ($fixture as $match)
        {
            $secondHalf[] = [
                'home_club_id' => $match['away_club_id'],
                'away_club_id' => $match['home_club_id'],
                'week' => $match['week'] + $weekCount
            ];
        }

        return array_merge($fixture, $secondHalf);
    }

    /**
     * @param  array  $fixtures
     *
     * @return void
     */
    public function insert(array $fixtures): void
    {
        $this->fixture->insert($fixtures);
    }

    /**
     * @param  Fixture  $fixture
     * @param $result
     *
     * @return bool
     */
    public function updateFixture(Fixture $fixture, $result): bool
    {
        return $fixture->update($result);
    }

    /**
     * @param  int  $weekNumber
     * @param  EloquentCollection  $clubs
     * @param  Collection  $fixture
     *
     * @return Collection
     */
    public function generateWeekFixture(int $weekNumber, EloquentCollection $clubs, Collection $fixture): Collection
    {
        $this->clubs = $clubs;
        $this->leagueFixture = $fixture;
        $weeklyMatchCount = $clubs->count() / 2;
        $weekFixture = collect();

        for ($i = 1; $i <= $weeklyMatchCount; $i++) {
            $homeClub = $this->selectHomeClub($weekFixture);

            $weekFixture->push([
                'home_club_id' => $homeClub->id,
                'away_club_id' => $this->selectAwayClub($weekFixture, $homeClub)->id,
                'week' => $weekNumber,
            ]);
        }

        return $weekFixture;
    }

    /**
     * @param  int  $week
     *
     * @return bool
     */
    public function isWeekValidForPlay(int $week): bool
    {
        $result = $this->fixture->where(function($query) use ($week) {
            $query->where('week', $week)->whereNotNull('result');
        })
        ->orWhere(function($query) use ($week) {
            $query->where('week', '<', $week)->whereNull('result');
        })->get();

        return $result->count() === 0;
    }

    /**
     * @return array
     */
    public function unPlayedWeeks(): array
    {
        return array_unique($this->fixture->whereNull('result')->pluck('week')->all());
    }

    /**
     * @param  Collection  $weekFixture
     *
     * @return Club
     */
    private function selectHomeClub(Collection $weekFixture): Club
    {
        return $this->clubs->whereNotIn('id', $this->activeWeekMatchClubIds($weekFixture))->random();
    }

    /**
     * @param  Collection  $weekFixture
     * @param  Club  $club
     *
     * @return Club
     */
    private function selectAwayClub(Collection $weekFixture, Club $club): Club
    {
        return $this->clubs->whereNotIn('id', $this->unsuitableAwayClubIds($weekFixture, $club))->random();
    }

    /**
     * @param  Collection  $weekFixture
     * @param  Club  $club
     *
     * @return array
     */
    private function unsuitableAwayClubIds(Collection $weekFixture, Club $club): array
    {
        return array_merge(
            [$club->id],
            $this->oldOpponentsClubIds($club),
            $this->activeWeekMatchClubIds($weekFixture)
        );
    }

    /**
     * @param  Club  $club
     *
     * @return array
     */
    private function oldOpponentsClubIds(Club $club): array
    {
        return array_merge(
            $this->leagueFixture->where('home_club_id', $club->id)->pluck('away_club_id')->all(),
            $this->leagueFixture->where('away_club_id', $club->id)->pluck('home_club_id')->all()
        );
    }

    /**
     * @param  Collection  $weekFixture
     *
     * @return array
     */
    private function activeWeekMatchClubIds(Collection $weekFixture): array
    {
        return array_merge(
            $weekFixture->pluck('away_club_id')->all(),
            $weekFixture->pluck('home_club_id')->all()
        );
    }
}
