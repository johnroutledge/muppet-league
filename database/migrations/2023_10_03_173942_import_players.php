<?php

use App\Models\Player;
use App\Services\FplApi;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $fplApi = new FplApi();

        $players = collect($fplApi->getPlayers())->map(function ($player) {


            return [
                'id' => $player['id'],
                //I don't think we want this as it's going to be a many to many on users teams I think and we have a player_team pivot table
                //'team_id' => null,
                'first_name' => $player['first_name'],
                'surname' => $player['second_name'],
                //note that these come back as integers where according to ChatGPT 1 for goalkeeper, 2 for defender, 3 for midfielder, and 4 for forward. We'll probably want a constants file for these
                'position' => $player['element_type'],
                //we should probbaly consider storing this in something other than pence as the numbers are going to get quite large.
                'price_pence' => $player['now_cost'] * 1000000,
                'premier_league_team_id' => $player['team'],
                'created_at' => now(),
            ];

        })->toArray();

        Player::insert($players);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Player::truncate();
    }
};
