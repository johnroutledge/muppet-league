<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = [
            [
                'name' => 'Arsenal',
                'short_name' => 'ARS',
            ],
            [
                'name' => 'Aston Villa',
                'short_name' => 'AVL',
            ],
            [
                'name' => 'Bournemouth',
                'short_name' => 'BOU',
            ],
            [
                'name' => 'Brentford',
                'short_name' => 'BRE',
            ],
            [
                'name' => 'Brighton',
                'short_name' => 'BHA',
            ],
            [
                'name' => 'Burnley',
                'short_name' => 'BUR',
            ],
            [
                'name' => 'Chelsea',
                'short_name' => 'CHE',
            ],
            [
                'name' => 'Crystal Palace',
                'short_name' => 'CRY',
            ],
            [
                'name' => 'Everton',
                'short_name' => 'EVE',
            ],
            [
                'name' => 'Fullham',
                'short_name' => 'FUL',
            ],
            [
                'name' => 'Liverpool',
                'short_name' => 'LIV',
            ],
            [
                'name' => 'Luton Town',
                'short_name' => 'LUT',
            ],
            [
                'name' => 'Manchester City',
                'short_name' => 'MCI',
            ],
            [
                'name' => 'Manchester United',
                'short_name' => 'MUN',
            ],
            [
                'name' => 'Newcastle United',
                'short_name' => 'NEW',
            ],
            [
                'name' => 'Nottingham Forest',
                'short_name' => 'NOT',
            ],
            [
                'name' => 'Sheffield United',
                'short_name' => 'SHU',
            ],
            [
                'name' => 'Tottenham Hotspur',
                'short_name' => 'TOT',
            ],
            [
                'name' => 'West Ham United',
                'short_name' => 'WHU',
            ],
            [
                'name' => 'Wolverhampton Wanderers',
                'short_name' => 'WOL',
            ],
        ];

        DB::table('premier_league_teams')->insert($teams);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('premier_league_teams', function (Blueprint $table) {
            //
        });
    }
};
