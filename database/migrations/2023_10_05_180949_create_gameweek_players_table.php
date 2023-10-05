<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gameweek_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gameweek_id');
            $table->unsignedBigInteger('player_id');
            $table->unsignedTinyInteger('minutes')->default(0);
            $table->unsignedTinyInteger('goals_scored')->default(0);
            $table->unsignedTinyInteger('assists')->default(0);
            $table->unsignedTinyInteger('clean_sheets')->default(0);
            $table->unsignedTinyInteger('goals_conceded')->default(0);
            $table->unsignedTinyInteger('own_goals')->default(0);
            $table->unsignedTinyInteger('penalties_saved')->default(0);
            $table->unsignedTinyInteger('penalties_missed')->default(0);
            $table->unsignedTinyInteger('yellow_cards')->default(0);
            $table->unsignedTinyInteger('red_cards')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gameweek_players');
    }
};
