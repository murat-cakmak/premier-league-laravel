<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PremierLeagueTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function it_should_return_league_table_view()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     * */
    public function it_should_play_all_matches()
    {
        $response = $this->get('/play-all');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     * */
    public function it_should_get_return_weekly_matches()
    {
        $response = $this->get('/play-week/1');

        $response->assertStatus(200);
    }
}
