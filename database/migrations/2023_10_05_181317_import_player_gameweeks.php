<?php

use App\Models\GameweekPlayer;
use App\Services\FplApi;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $fplApi = new FplApi();

        for ($i=1; $i<39;$i++) {
            $week = $fplApi->getGameweek($i)->map(function($element) use ($i) {
                return [
                  'gameweek_id' => $i,
                  'player_id' => $element['id'],
                  'minutes' => $element['stats']['minutes'],
                  'goals_scored' => $element['stats']['goals_scored'],
                  'assists' => $element['stats']['assists'],
                  'clean_sheets' => $element['stats']['clean_sheets'],
                  'goals_conceded' => $element['stats']['goals_conceded'],
                  'own_goals' => $element['stats']['own_goals'],
                  'penalties_saved' => $element['stats']['penalties_saved'],
                  'penalties_missed' => $element['stats']['penalties_missed'],
                  'yellow_cards' => $element['stats']['yellow_cards'],
                  'red_cards' => $element['stats']['red_cards'],
                  'created_at' => now(),
                ];
            })->toArray();
            GameweekPlayer::insert($week);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        GameweekPlayer::truncate();
    }
};
