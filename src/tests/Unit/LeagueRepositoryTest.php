<?php

namespace Tests\Unit;

use App\Models\Team;
use App\Repositories\LeagueRepository;
use PHPUnit\Framework\TestCase;

class LeagueRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @test
     * @return void
     */
    public function it_should_return_get_teams()
    {
        $team = $this->getMockBuilder(Team::class)->addMethods(['pluck'])->getMock();
        $expect = new Team();

        $leagueRepository = $this->getMockBuilder(LeagueRepository::class)
            ->setConstructorArgs([$team])
            ->onlyMethods([])
            ->getMock();

        $team->expects($this->once())->method('pluck')->willReturn($expect);

        $this->assertEquals($expect, $leagueRepository->getTeams());
    }
}
