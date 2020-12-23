<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PlayMatchTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_should_play_week()
    {
        $this->post('/api/fixtures', ['clubCount' => 4]);

        $response = $this->post('/api/play-matches/weekly', ['week' => 1]);

        $response->assertStatus(201);
        $this->assertDatabaseMissing('fixtures', [
            'week' => 1,
            'result' => null,
        ]);
    }

    /** @test */
    public function it_should_not_play_old_played_week()
    {
        $this->post('/api/fixtures', ['clubCount' => 4]);

        $this->post('/api/play-matches/weekly', ['week' => 1]);
        $response = $this->post('/api/play-matches/weekly', ['week' => 1]);

        $response->assertSessionHasErrors(['week']);
    }

    /** @test */
    public function it_should_not_be_skipped()
    {
        $this->post('/api/fixtures', ['clubCount' => 4]);

        $response = $this->post('/api/play-matches/weekly', ['week' => 2]);

        $response->assertSessionHasErrors(['week']);
    }

    /** @test */
    public function it_should_play_all()
    {
        $this->post('/api/fixtures', ['clubCount' => 4]);

        $response = $this->post('/api/play-matches/all');

        $response->assertStatus(201);
        $this->assertDatabaseMissing('fixtures', [
            'result' => null,
        ]);
    }
}
