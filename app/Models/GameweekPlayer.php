<?php

namespace App\Models;

use App\Enums\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameweekPlayer extends Model
{
    use HasFactory;

    public $guarded = [];
    public $appends = ['score'];

    public function getScoreAttribute()
    {
        //scoring. Fairly dirty for now. Note that we're score high for Bad Things!:
        $score = 0;

        //doesn't play.
        if ($this->minutes == 0) {
            $score += 5;
        }
        if ($this->goals_scored) {
            $score -= $this->goals_scored * 5;
        }
        if ($this->assists) {
            $score -= $this->assists * 3;
        }
        if ($this->clean_sheets) {
            $score -= $this->clean_sheets * 3;
        }
        if ($this->goals_conceded) {
            $score += $this->goals_conceded * 5;
        }
        if ($this->own_goals) {
            $score += $this->own_goals * 5;
        }
        if ($this->penalties_saved) {
            $score -= $this->penalties_saved * 5;
        }
        if ($this->penanties_missed) {
            $score += $this->penanties_missed * 5;
        }
        if ($this->yellow_cards) {
            $score += $this->yellow_cards * 3;
        }
        if ($this->red_cards) {
            $score += $this->red_cards * 5;
        }

        return $score;
    }
}
