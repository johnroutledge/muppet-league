@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Team') }}</div>
                <div class="card-body">
                    <team-selector :available-players="{{ json_encode($players) }}"></team-selector>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
