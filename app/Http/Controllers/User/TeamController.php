<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerTeam;
use App\Models\PremierLeagueTeam;
use App\Models\Team;
use Illuminate\Http\Request;
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
        // HACKY WAY OF SAVING/UPDATING TEAM - SEPERATE INTO TWO METHODS WHEN TIME PERMITS
        $team = Team::where('user_id', auth()->id())->first();
        if ($team) {
            $team->name = $request->input('teamName');
            $team->save();
        } else {
            $team = new Team();
            $team->name = $request->input('teamName');
            $team->user_id = auth()->id();
            $team->save();
        }

        $playerTeam = PlayerTeam::where('team_id', $team->id)->delete();

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
        $players = Player::join('premier_league_teams', 'players.premier_league_team_id', '=', 'premier_league_teams.id')
            ->orderBy('premier_league_teams.name')
            ->orderBy('players.position')
            ->select('players.*')
            ->get();

        $selectedPlayerIds = PlayerTeam::where('team_id', $id)->pluck('player_id')->toArray();
        $selectedPlayers = Player::whereIn('id', $selectedPlayerIds)->get();

        $teamName = Team::where('id', $id)->pluck('name')->first();

        $premierLeagueTeams = PremierLeagueTeam::orderBy('name')->get();

        return view('user.team.edit', compact('players', 'premierLeagueTeams', 'selectedPlayers', 'teamName'));
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
