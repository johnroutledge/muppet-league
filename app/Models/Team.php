<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }   

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_team')
            ->using(PlayerTeam::class)
            ->withPivot('captain');
    }
}
