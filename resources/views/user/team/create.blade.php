@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Create Team</h5>
                    <ul>
                        <li>Minimum spend: £50m</li>
                        <li>No more than 2 players from the same team</li>
                        <li>Formation is 4-4-2</li>
                    </ul>
                    {{-- <h6>Minimum spend: £50m</h6>
                    <h6>No more than 2 players from the same team</h6>
                    <h6>Formation is 4-4-2</h6> --}}
                </div>
                <div class="card-body">
                    {{-- {{ $players }} --}}
                    <team-selector :available-players="{{ json_encode($players) }}"
                        :premier-league-teams="{{ json_encode($premierLeagueTeams) }}">
                    </team-selector>
                </div>
                <form method="post" action="{{ route('team.store') }}">
                    @csrf
                    <button type="submit">Save Team</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
