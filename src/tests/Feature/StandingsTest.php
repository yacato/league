<?php

namespace Tests\Feature;

use App\Models\Club;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StandingsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_list_all_fixture()
    {
        $clubs = Club::factory()->count(4)->create();
        $response = $this->get('/api/standings');

        $response->assertOk();

        $clubs->each(function ($club) use ($response) {
            $response->assertJsonFragment(['name' => $club->name]);
        });
    }
}
