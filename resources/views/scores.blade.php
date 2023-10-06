@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (isset($team))
                            <h5>
                                Team name: {{ $team->name }}
                            </h5>

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Player</th>
                                        <th scope="col">Minutes Played</th>
                                        <th scope="col">Goals Scored</th>
                                        <th scope="col">Assists</th>
                                        <th scope="col">Clean Sheets</th>
                                        <th scope="col">Goals Conceded</th>
                                        <th scope="col">Own Goals</th>
                                        <th scope="col">Penalties Saved</th>
                                        <th scope="col">Penalties Missed</th>
                                        <th scope="col">Yellow Cards</th>
                                        <th scope="col">Red Cards</th>
                                        <th scope="col">Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gameweekData as $player)
                                          <tr>
                                            <td>{{ sprintf('%s %s', $player['first_name'], $player['surname']) }}</td>
                                            <td>{{ $player['minutes'] }}</td>
                                            <td>{{ $player['goals_scored'] }}</td>
                                            <td>{{ $player['assists'] }}</td>
                                            <td>{{ $player['clean_sheets'] }}</td>
                                            <td>{{ $player['goals_conceded'] }}</td>
                                            <td>{{ $player['own_goals'] }}</td>
                                            <td>{{ $player['penalties_saved'] }}</td>
                                            <td>{{ $player['penalties_missed'] }}</td>
                                            <td>{{ $player['yellow_cards'] }}</td>
                                            <td>{{ $player['red_cards'] }}</td>
                                            <td>{{ $player['score'] }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="fw-bold">
                                            <td>Totals</td>
                                            <td>{{ $gameweekData->sum('minutes') }}</td>
                                            <td>{{ $gameweekData->sum('goals_scored') }}</td>
                                            <td>{{ $gameweekData->sum('assists') }}</td>
                                            <td>{{ $gameweekData->sum('clean_sheets') }}</td>
                                            <td>{{ $gameweekData->sum('goals_conceded') }}</td>
                                            <td>{{ $gameweekData->sum('own_goals') }}</td>
                                            <td>{{ $gameweekData->sum('penalties_saved') }}</td>
                                            <td>{{ $gameweekData->sum('penalties_missed') }}</td>
                                            <td>{{ $gameweekData->sum('yellow_cards') }}</td>
                                            <td>{{ $gameweekData->sum('red_cards') }}</td>
                                            <td>{{ $gameweekData->sum('score') }}</td>
                                        </tr>
                                    </tfoot>

                        @else
                            <div class="alert alert-warning" role="alert">
                                You do not have a team yet.
                            </div>
                            <a href="{{ route('team.create') }}" class="btn btn-primary">Create Team</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
