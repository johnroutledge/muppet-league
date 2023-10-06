<?php

namespace App\Models;

use App\Constants\Points;
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

        if ($this->minutes == 0) {
            $score += POINTS::DOES_NOT_PLAY;
        }
        if ($this->goals_scored) {
            $score += $this->goals_scored * POINTS::GOAL_SCORED;
        }
        if ($this->assists) {
            $score += $this->assists * POINTS::ASSIST;
        }
        if ($this->clean_sheets) {
            $score += $this->clean_sheets * POINTS::CLEAN_SHEET;
        }
        if ($this->goals_conceded) {
            $score += $this->goals_conceded * POINTS::GOAL_CONCEDED;
        }
        if ($this->own_goals) {
            $score += $this->own_goals * POINTS::OWN_GOAL;
        }
        if ($this->penalties_saved) {
            $score += $this->penalties_saved * POINTS::PENALTY_SAVED;
        }
        if ($this->penanties_missed) {
            $score += $this->penanties_missed * POINTS::PENALTY_MISSED;
        }
        if ($this->yellow_cards) {
            $score += $this->yellow_cards * POINTS::YELLOW_CARD;
        }
        if ($this->red_cards) {
            $score += $this->red_cards * POINTS::RED_CARD;
        }

        return $score;
    }
}
