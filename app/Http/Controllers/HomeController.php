<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $team = Team::where('user_id', auth()->user()->id)->first();
        return view('home', compact('team'));
    }

    public function scoring()
    {
        return view('scoring');
    }

    public function scores($gameweekId = null)
    {
        $team = auth()->user()
            ->team->with(['players.gameweeks' => function ($query) use ($gameweekId) {
                if ($gameweekId) {
                    $query->where('gameweek_id', $gameweekId);
                }
            }])
            ->first();

        if (! $team) {
            abort(404, 'You have not created a team yet');
        }

        $gameweekData =  $team->players->map(function ($player) {
            $gameweeks = $player->gameweeks;

            return [
                'player_id' => $player->id,
                'first_name' => $player->first_name,
                'surname' => $player->surname,
                'score' => $gameweeks->sum('score'),
                'minutes' => $gameweeks->sum('minutes'),
                'goals_scored' => $gameweeks->sum('goals_scored'),
                'assists' => $gameweeks->sum('assists'),
                'clean_sheets' => $gameweeks->sum('clean_sheets'),
                'goals_conceded' => $gameweeks->sum('goals_conceded'),
                'own_goals' => $gameweeks->sum('own_goals'),
                'penalties_saved' => $gameweeks->sum('penalties_saved'),
                'penalties_missed' => $gameweeks->sum('penalties_missed'),
                'yellow_cards' => $gameweeks->sum('yellow_cards'),
                'red_cards' => $gameweeks->sum('red_cards'),
            ];
        });
        return view('scores', compact('team', 'gameweekData', 'gameweekId'));
    }
}
