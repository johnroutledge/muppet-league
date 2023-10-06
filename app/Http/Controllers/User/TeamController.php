<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\PlayerTeam;
use App\Models\PremierLeagueTeam;
use App\Models\Team;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $players = Player::join('premier_league_teams', 'players.premier_league_team_id', '=', 'premier_league_teams.id')
            ->orderBy('premier_league_teams.name')
            ->orderBy('players.position')
            ->select('players.*')
            ->get();

        $premierLeagueTeams = PremierLeagueTeam::orderBy('name')->get();

        return view('user.team.create', compact('players', 'premierLeagueTeams'));
    }

    public function store(Request $request)
    {
        // Validate the request data (e.g., team name and selected players)

        $team = new Team();
        $team->name = $request->input('teamName');
        $team->user_id = auth()->id();

        // Save the team record
        $team->save();
        Log::info('Team saved successfully');

        // Attach selected players to the team in the player_team pivot table
        $selectedPlayers = $request->input('selectedPlayers');

        $playerIds = array_map(function ($playerData) {
            return $playerData['id']; // Extract the player IDs from the data
        }, $selectedPlayers);

        foreach ($playerIds as $playerId) {
            $playerTeam = new PlayerTeam();
            $playerTeam->player_id = $playerId;
            $playerTeam->team_id = $team->id;
            $playerTeam->save();
            // $team->players()->attach($playerId, [
            //     'player_id' => $playerId,
            //     'team_id' => $team->id,
            // ]);
        }
        Log::info('Players attached to team successfully');

        return response()->json(['message' => 'Team saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
