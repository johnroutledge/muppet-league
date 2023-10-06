@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                      <h5 class="mt-2">Edit Team</h5>
                </div>
                <div class="card-body">
                     <team-selector :available-players="{{ json_encode($players) }}"
                        :premier-league-teams="{{ json_encode($premierLeagueTeams) }}"
                        :selected-players="{{ json_encode($selectedPlayers) }}"
                        :team-name="{{ json_encode($teamName) }}">
                    </team-selector>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
