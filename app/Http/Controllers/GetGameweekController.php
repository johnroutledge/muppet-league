<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetGameweekController extends Controller
{
    public function __invoke(int $gameweekId)
    {
        $team = auth()->user()
            ->team->with(['players.gameweeks' => function ($query) {
                $query->where('gameweek_id', 1);
            }])
            ->first();

        if (! $team) {
           abort(404, 'You have not created a team yet');
        }

      return $team->players->map(function ($player) {
          $gameweek = $player->gameweeks->first();

           return [
              'player_id' => $player->id,
              'first_name' => $player->first_name,
              'surname' => $player->surname,
              'score' => $gameweek->score,
              'minutes' => $gameweek->minutes,
              'goals_scored' => $gameweek->goals_scored,
              'assists' => $gameweek->assists,
              'clean_sheets' => $gameweek->clean_sheets,
              'goals_conceded' => $gameweek->goals_conceded,
              'own_goals' => $gameweek->own_goals,
              'penalties_saved' => $gameweek->penalties_saved,
              'penalties_missed' => $gameweek->penalties_missed,
              'yellow_cards' => $gameweek->yellow_cards,
              'red_cards' => $gameweek->red_cards,
            ];
       });
    }
}
