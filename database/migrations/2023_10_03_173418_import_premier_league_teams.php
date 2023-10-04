<?php

use App\Models\PremierLeagueTeam;
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

        $teams = collect($fplApi->getTeams())->map(function ($team) {
            return [
                'id' => $team['id'],
                'name' => $team['name'],
                'short_name' => $team['short_name'],
                //these don't seem to be available in the API and cant be null so as a temp measure...
                'logo_url' => $team['id'],
                'created_at' => now(),
            ];
        })->toArray();

        PremierLeagueTeam::insert($teams);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        PremierLeagueTeam::truncate();
    }
};
