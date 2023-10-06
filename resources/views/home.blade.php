@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        @foreach ($team->players as $player)
                            <div>
                                {{ $player->first_name }} {{ $player->surname }} {{ $player->team_short_name }} ({{  $player->position_short_name }})
                            </div>
                        @endforeach
                        <a href="{{ route('team.edit', $team) }}" class="btn btn-primary mt-3">Edit Team (really?)</a>
                   	 <a href="{{ route('scores')  }}" class="btn btn-primary">See Team Scores</a>
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
