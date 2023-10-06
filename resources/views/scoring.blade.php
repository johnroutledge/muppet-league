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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Event</th>
                                    <th scope="col">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Player doesn't play</td>
                                    <td>{{ App\Constants\Points::DOES_NOT_PLAY  }}</td>
                                </tr>
                                <tr>
                                    <td>Goal scored</td>
                                    <td>{{ App\Constants\Points::GOAL_SCORED  }}</td>
                                </tr>
                                <tr>
                                    <td>Assist</td>
                                    <td>{{ App\Constants\Points::ASSIST  }}</td>
                                </tr>
                                <tr>
                                    <td>Clean sheet</td>
                                    <td>{{ App\Constants\Points::CLEAN_SHEET  }}</td>
                                </tr>
                                <tr>
                                    <td>Goal conceded</td>
                                    <td>{{ App\Constants\Points::GOAL_CONCEDED  }}</td>
                                </tr>
                                <tr>
                                    <td>Own goal</td>
                                    <td>{{ App\Constants\Points::OWN_GOAL  }}</td>
                                </tr>
                                <tr>
                                    <td>Penalty saved</td>
                                    <td>{{ App\Constants\Points::PENALTY_SAVED  }}</td>
                                </tr>
                                <tr>
                                    <td>Penalty missed</td>
                                    <td>{{ App\Constants\Points::PENALTY_MISSED  }}</td>
                                </tr>
                                <tr>
                                    <td>Yellow card</td>
                                    <td>{{ App\Constants\Points::YELLOW_CARD  }}</td>
                                </tr>
                                <tr>
                                    <td>Red card</td>
                                    <td>{{ App\Constants\Points::RED_CARD  }}</td>
                                </tr>
                           </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
