<?php

namespace App\Repositories;

use App\Models\League;
use App\Models\Team;

class LeagueRepository
{
    protected $league;
    protected $team;
    public $result = array();

    /**
     * LeagueRepository constructor.
     * @param League $league
     * @param Team $team
     */
    public function __construct(League $league, Team $team)
    {
        $this->league = $league;
        $this->team = $team;

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->team
            ->leftJoin('league', 'teams.id', '=', 'league.team_id')
            ->orderBy('league.points', 'DESC')->get();
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->team->pluck('id');
    }

    /**
     * @return void
     */
    public function createLeague()
    {
        $result = $this->league->get();

        if ($result->isEmpty()) {
            foreach ($this->getTeams() as $value) {
                $data = [
                    'team_id' => $value,
                    'points' => 0,
                    'played' => 0,
                    'won' => 0,
                    'draw' => 0,
                    'lose' => 0,
                ];

                $this->league->create($data);
            }
        }
    }

    /**
     * @param $team_id
     * @return mixed
     */
    public function getLeagueByTeamId($team_id)
    {
        return $this->league->where('team_id', $team_id)->first();
    }
}
