<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public $guarded = [];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'player_team')
            ->using(PlayerTeam::class)
            ->withPivot('captain');
    }

    public function premierLeagueTeam()
    {
        return $this->belongsTo(PremierLeagueTeam::class);
    }

}
