<?php

namespace Database\Factories;

use App\Models\Club;
use App\Models\Fixture;
use Illuminate\Database\Eloquent\Factories\Factory;

class FixtureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fixture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'home_club_id' => Club::factory()->create()->id,
            'away_club_id' => Club::factory()->create()->id,
            'week' => rand(1, 10),
        ];
    }
}
