<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

//https://www.game-change.co.uk/2023/02/10/a-complete-guide-to-the-fantasy-premier-league-fpl-api/
//quick and (very) dirty api wrapper

class FplApi
{
    private const BASE_URL = 'https://fantasy.premierleague.com/api/';

    /*
    * A summary of all 38 gameweeks
    * The game’s settings
    * Basic information on all 20 PL teams
    * Total number of FPL Users and overall chip usage
    * Basic information on all Premier League players
    * List of stats that FPL keeps track of
    * The different FPL positions
     */
    public function getBootstrapStatic()
    {
        return $this->jsonRequest('GET', 'bootstrap-static/');
    }

    /*
     * Per match, it shows:

    Goals
    Assists
    Cards
    Saves
    Pens missed
    Bonus points
    Own goals
    Pens saved
     */
    public function getFixtures()
    {
        return $this->jsonRequest('GET', 'fixtures/');
    }

    /*
     * Data included:

    Remaining fixtures for the player, including:
        Kickoff time
        Gameweek number
        Home or Away
        Difficulty

    Previous fixtures and performance, including:
        Minutes played
        Goals
        Assists
        Conceded
        Cards
        Bonus
        Influence
        Creativity
        xG
        xA
        Value
        Transfer delta for that gameweek
     */
    public function getPlayerById(int $playerId)
    {
        return $this->jsonRequest('GET', sprintf('element-summary/%d/', $playerId));
    }

    /*
     * As above but gets every player for a given gameweek (rather then every gameweek for a given player)
     */
    public function getGameweek(int $gameweekId)
    {
        return collect($this->jsonRequest('GET', sprintf('event/%d/live/', $gameweekId))->json()['elements']);
    }

    public function getTeams()
    {
        return $this->getBootstrapStatic()->json()['teams'];
    }

    public function getPlayers()
    {
        return $this->getBootstrapStatic()->json()['elements'];
    }

    public function getTeamId(string $teamName)
    {
        $teams =  $this->getBootstrapStatic()->json()['teams'];

        foreach ($teams as $team) {
            if (strtolower($team['name']) === strtolower($teamName)) {
                return $team['id'];
            }
        }
        return null;
    }

    public function getPlayerId(string $firstName,  string $lastName)
    {
        $players = $this->getBootstrapStatic()->json()['elements'];

        foreach ($players as $player) {
            if (strtolower($player['first_name']) === strtolower($firstName) && strtolower($player['second_name']) === strtolower($lastName)) {
                return $player['id'];
            }
        }
        return null;
    }

    public function getPlayersOnTeam(int $teamId)
    {
        $players = $this->getBootstrapStatic()->json()['elements'];

        return collect($players)->filter(function ($player) use ($teamId) {
            return $player['team'] === $teamId;
        });
    }

    private function jsonRequest(string $requestMethod, string $apiEndpoint, ?string $json = null)
    {
        return Http::withHeaders(['Content-Type' => 'application/json; charset=UTF8'])
            //->withToken(config('app.api_key'))
            ->withOptions(['verify' => false])
            ->send($requestMethod, sprintf('%s/%s', self::BASE_URL, $apiEndpoint), ['body' => $json]);
    }
}
