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
                        <div class="alert alert-success" role="alert">
                            {{ $team->name }} is your team.
                        </div>
                        <a href="{{ route('team.show', $team->id) }}" class="btn btn-primary">View Team</a>
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
