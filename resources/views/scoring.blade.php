@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rules & Scoring') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 pe-4">
                            <h6 class="fw-bold">Destructions:</h6>
                            <ul>
                                <li class="mt-4">
                                    Muster a squad that performs as comically and abysmally as 
                                    possible on the field. It's a delightful journey where ineptitude is celebrated, and the 
                                    quest for the worst team ever is the ultimate goal!
                                </li>
                                <li class="mt-3">
                                    Select a rag-tag team of 11 players, comprising 1 goalkeeper, 4 defenders, 4 midfielders, 
                                    and 2 forwards. 
                                </li>
                                <li class="mt-3">
                                    You must frivolously waste at least £50m on your squad of muppets.
                                </li>
                                <li class="mt-3">
                                    You can't have more than 2 players from the same team (ie. Luton)
                                </li>
                                <li class="mt-3">
                                    The formation is 4-4-2 (don't try and get creative!)
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Muppet Rewards:</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Event</th>
                                        <th scope="col">Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Player doesn't play (niiice)</td>
                                        <td>{{ App\Constants\Points::DOES_NOT_PLAY  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Goal conceded (yes please!)</td>
                                        <td>{{ App\Constants\Points::GOAL_CONCEDED  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Own goal (the pinnacle of success)</td>
                                        <td>{{ App\Constants\Points::OWN_GOAL  }}</td>
                                    </tr>
                                 
                                    <tr>
                                        <td>Penalty missed (woohoo!)</td>
                                        <td>{{ App\Constants\Points::PENALTY_MISSED  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Red card (perfection)</td>
                                        <td>{{ App\Constants\Points::RED_CARD  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Yellow card (mmm cookies)</td>
                                        <td>{{ App\Constants\Points::YELLOW_CARD  }}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td>Clean sheet (total nightmare)</td>
                                        <td>{{ App\Constants\Points::CLEAN_SHEET  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Assist (again, not good)</td>
                                        <td>{{ App\Constants\Points::ASSIST  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Goal scored (avoid this)</td>
                                        <td>{{ App\Constants\Points::GOAL_SCORED  }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penalty saved (boo!)</td>
                                        <td>{{ App\Constants\Points::PENALTY_SAVED  }}</td>
                                    </tr>
                               </tbody>
                            </table>
                        </div>
                    </div>
                      

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
