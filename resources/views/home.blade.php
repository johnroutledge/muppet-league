@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Muppets') }}</div>

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
                                @if ($player->team_short_name == 'CHE')
                                    <em class="ms-1">Good choice - Chelsea are a bunch of muppets!</em>
                                @endif
                                @if ($player->team_short_name == 'AVL')
                                    <em class="ms-1">Wise choice - James hates the Villa!</em>
                                @endif
                                @if ($player->team_short_name == 'LIV')
                                    <em class="ms-1">You'll never be a muppet picking from this team of fine footballing specimens!</em>
                                @endif
                                @if ($player->team_short_name == 'LUT' || $player->team_short_name == 'BUR')
                                    <em class="ms-1">An obvious choice, well done!</em>
                                @endif
                            </div>
                        @endforeach
                        <div class="mt-3">
                            <a href="{{ route('team.edit', $team) }}" class="btn btn-primary">Edit Team (really?)</a>
                            <a href="{{ route('scores')  }}" class="btn btn-outline-primary ms-2">See Team Scores</a>
                        </div>
                     
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
