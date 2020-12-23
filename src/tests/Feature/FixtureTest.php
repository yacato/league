<?php

namespace Tests\Feature;

use App\Models\Fixture;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FixtureTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_list_all_fixture()
    {
        $fixtures = Fixture::factory()->count(4)->create();
        $response = $this->get('/api/fixtures');

        $response->assertOk();

        $fixtures->each(function ($fixture) use ($response) {
            $response->assertJsonFragment(['home_club_id' => $fixture->home_club_id]);
        });
    }

    /** @test */
    public function it_should_create_fixture()
    {
        $response = $this->post('/api/fixtures', ['clubCount' => 4]);

        $response->assertStatus(201);
        $this->assertDatabaseCount('clubs', 4);
        $this->assertDatabaseCount('fixtures', 12);
    }

    /** @test */
    public function it_should_not_create_fixture_when_team_count_not_send()
    {
        $response = $this->post('/api/fixtures', []);

        $response->assertSessionHasErrors(['clubCount']);
    }
}
