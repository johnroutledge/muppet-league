@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Team - minimum spend: £50m') }}</div>
                <div class="card-body">
                    {{-- {{ $players }} --}}
                    <team-selector :available-players="{{ json_encode($players) }}"
                        :premier-league-teams="{{ json_encode($premierLeagueTeams) }}">
                    </team-selector>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
