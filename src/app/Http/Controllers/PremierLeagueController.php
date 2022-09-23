<?php

namespace App\Http\Controllers;

use App\Repositories\LeagueRepository;
use App\Repositories\PlayRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class PremierLeagueController extends Controller
{
    public $league;
    public $weeks;
    public $leagueRepository;
    public $playRepository;
    public $fixture;
    public $result = array();

    /**
     * PremierLeagueController constructor.
     * @param LeagueRepository $leagueRepository
     * @param PlayRepository $playRepository
     */
    public function __construct(LeagueRepository $leagueRepository, PlayRepository $playRepository)
    {
        $this->leagueRepository = $leagueRepository;
        $this->playRepository = $playRepository;
        $this->leagueRepository->createLeague();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLeague()
    {
        $this->weeks = $this->playRepository->getWeeks();
        $this->league = $this->leagueRepository->getAll();

        $this->playRepository->createFixture();

        $this->fixture = $this->playRepository->getFixture();
        $collection = collect($this->fixture);
        $grouped = $collection->groupBy('week_id');

        return view(
            'league', [
                'league' => $this->league,
                'matches' => $grouped->toArray(),
                'fixture' => $grouped->toArray(),
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function play()
    {
        $matches = $this->playRepository->getAllMatches();

        $this->playGame($matches);

        return $this->getLeague();
    }

    /**
     * @param $matches
     * @return void
     */
    private function playGame($matches)
    {
        foreach ($matches as $match) {
            $homeScore = $this->playRepository->createStrenght($match->home, 1);
            $awayScore = $this->playRepository->createStrenght($match->away, 0);
            $home = $this->leagueRepository->getLeagueByTeamId($match->home);
            $away = $this->leagueRepository->getLeagueByTeamId($match->away);

            $this->playRepository->calculateScore($homeScore, $awayScore, $home, $away);

            $match->home_goal = $homeScore;
            $match->away_goal = $awayScore;
            $match->played = 1;
            $match->save();
        }
    }

    /**
     * @param $week
     * @return JsonResource
     */
    public function playWeek($week)
    {
        $matches = $this->playRepository->getMatchesFromWeek($week);

        $this->playGame($matches);

        $result = $this->playRepository->getFixtureByWeekId($week);

        return response()->json(array('matches' => $result));
    }
}
