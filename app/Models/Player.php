<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Position;

class Player extends Model
{
    use HasFactory;

    protected $appends = [
        'position_short_name'
    ];

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

    public function getPositionShortNameAttribute()
    {
        switch ($this->position) {
            case Position::GOALKEEPER->value:
                return 'GK';
            case Position::DEFENDER->value:
                return 'DEF';
            case Position::MIDFIELDER->value:
                return 'MID';
            case Position::FORWARD->value:
                return 'FWD';
            default:
                return '';
        }
    }
    
}
