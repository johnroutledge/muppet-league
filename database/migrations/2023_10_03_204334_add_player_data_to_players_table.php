<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Position;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teamId = DB::table('premier_league_teams')
            ->where('short_name', 'LIV')
            ->value('id');

        $players = [
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Alisson Becker',
                'position' => Position::GOALKEEPER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Adrian',
                'position' => Position::GOALKEEPER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Joe Gomez',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Virgil van Dijk',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Ibrahima Konate',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Kostas Tsimikas',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Trent Alexander-Arnold',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Andy Robertson',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Joel Matip',
                'position' => Position::DEFENDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Curtis Jones',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Alexis Mac Allister',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Harvey Elliott',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Thiago Alcantara',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Dominik Szoboszlai',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Wataru Endo',
                'position' => Position::MIDFIELDER->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Mohamed Salah',
                'position' => Position::FORWARD->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Cody Gakpo',
                'position' => Position::FORWARD->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Diogo Jota',
                'position' => Position::FORWARD->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Luis Diaz',
                'position' => Position::FORWARD->value,
                'price_pence' => 100000000,
            ],
            [
                'premier_league_team_id' => $teamId,
                'name' => 'Darwin Nunez',
                'position' => Position::FORWARD->value,
                'price_pence' => 100000000,
            ],
        ];

        DB::table('players')->insert($players);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            //
        });
    }
};
