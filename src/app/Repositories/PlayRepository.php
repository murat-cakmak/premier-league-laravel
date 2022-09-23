<?php

namespace App\Repositories;

use App\Models\Team;
use App\Models\Matches;
use App\Models\Strengths;
use App\Models\Week;

class PlayRepository
{
    protected $team;
    protected $matches;
    protected $week;
    protected $strengths;
    public $result;

    /**
     * PlayRepository constructor.
     * @param Team $team
     * @param Matches $matches
     * @param Week $week
     * @param Strengths $strengths
     */
    public function __construct(Team $team, Matches $matches, Week $week, Strengths $strength)
    {
        $this->team = $team;
        $this->matches = $matches;
        $this->week = $week;
        $this->strengths = $strength;
    }

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->team->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getWeeksId()
    {
        return $this->week->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getWeeks()
    {
        return $this->week->get();
    }


    /**
     * @return void
     */
    public function createFixture()
    {
        foreach ($this->getWeeksId() as $week) {
            foreach ($this->iterateTeams($this->getTeamId()) as $value) {
                if (0 == $this->checkMatch($week, $value)) {
                    $this->matches->create(['home' => $value[0], 'away' => $value[1], 'week_id' => $week]);
                }
            }
        }
    }

    /**
     * @param $teams
     * @return array
     */
    private function iterateTeams($teams)
    {
        $collection = collect($teams);
        $matrix = $collection->crossJoin($teams);
        $data = $matrix->reject(function($items){
            if($items[0] == $items[1]){
                return $items;
            }
        })->shuffle();

        return $data->all();
    }

    /**
     * @param $week_id
     * @param $teams
     * @return mixed
     */
    public function checkMatch($week_id, $teams)
    {
        return $this->matches->where('week_id', '=', $week_id)
            ->whereRaw('(home IN(' . implode(',', $teams) . ') OR away IN(' . implode(',', $teams) . '))')
            ->count();
    }

    /**
     * @return mixed
     */
    public function getFixture()
    {
        return $this->matches->select(
            'matches.id',
            'matches.played',
            'matches.week_id',
            'matches.home_goal',
            'matches.away_goal',
            'week_id',
            'home.name as home_team',
            'home.logo as home_logo',
            'away.logo as away_logo',
            'away.name as away_team')
            ->join('weeks', 'weeks.id', '=','matches.week_id')
            ->join('teams as home', 'home.id', '=','matches.home')
            ->join('teams as away', 'away.id', '=','matches.away')
            ->orderBy('week_id','ASC')
            ->get();
    }

    /**
     * @param $week_id
     * @return mixed
     */
    public function getFixtureByWeekId($week_id)
    {
        return $this->matches->select(
            'matches.id',
            'matches.played',
            'matches.week_id',
            'matches.home_goal',
            'matches.away_goal',
            'week_id',
            'weeks.name',
            'home.logo as home_logo',
            'away.logo as away_logo',
            'home.name as home_team',
            'away.name as away_team')
            ->join('weeks', 'weeks.id', '=','matches.week_id')
            ->join('teams as home', 'home.id', '=','matches.home')
            ->join('teams as away', 'away.id', '=','matches.away')
            ->where('matches.week_id','=',$week_id)
            ->orderBy('matches.id','ASC')
            ->get();
    }

    /**
     * @param $team_id
     * @param $is_home
     * @return mixed
     */
    public function getTeamStrenght($team_id, $is_home)
    {
        return $this->strengths->where([['team_id','=',$team_id],['is_home','=',$is_home]])->get();
    }

    /**
     * @param $team_id
     * @param $is_home
     * @return int
     */
    public function createStrenght($team_id, $is_home)
    {
        foreach ($this->getTeamStrenght($team_id,$is_home) as $value){
            switch ($value->strengths){
                case 'strong':
                    $this->result = rand(4,5);
                    break;
                case 'average':
                    $this->result = rand(2,3);
                    break;
                case 'weak' :
                    $this->result = rand(0,2);
                    break;
            }

            return $this->result;
        }
    }

    /**
     * @param $week
     * @return mixed
     */
    public function getMatchesFromWeek($week){
        return $this->matches->where([['week_id','=',$week],['played','=',0]])->get();
    }

    /**
     * @param int $played
     * @return mixed
     */
    public function getAllMatches($played = 0)
    {
        return $this->matches->where('played', '=', $played)->get();
    }

    /**
     * @param $homeScore
     * @param $awayScore
     * @param $home
     * @param $away
     */
    public function calculateScore($homeScore, $awayScore, $home, $away)
    {
        if($homeScore > $awayScore){
            $home->won += 1;
            $home->points += 3;
            $home->draw += ($homeScore - $awayScore);
            $away->lose += 1;
            $away->draw  += ($awayScore - $homeScore);
        } elseif ($awayScore > $homeScore){
            $away->won += 1;
            $away->points += 3;
            $away->draw += ($awayScore - $homeScore);
            $home->lose += 1;
            $home->draw += ($homeScore - $awayScore);
        } else {
            $home->draw += 1;
            $away->draw += 1;
            $home->points += 1;
            $away->points += 1;
        }

        $home->played  += 1;
        $away->played += 1;

        $home->save();
        $away->save();
    }
}
