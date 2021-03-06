@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{$fixture->homeClub}} {{$fixture->homeChar}} vs. {{$fixture->awayClub}} {{$fixture->awayChar}}</h1>
</div>
<div class="container">
    <table class="table">
        <tbody>
            <tr scope="row">
                <td><div class="right">Home Team:</div></td>
                <td><div>{{$fixture->homeClub}} {{$fixture->homeChar}}</div></td>
            </tr>
            <tr scope="row">
                <td><div class="right">Away Team:</div></td>
                <td><div>{{$fixture->awayClub}} {{$fixture->awayChar}}</div></td>
            </tr>
            <tr scope="row">
                <td><div class="right">Venue:</div></td>
                <td><div>{{$fixture->venue}}</div></td>
            </tr>
            <tr scope="row">
                <td><div class="right">Division:</div></td>
                <td><div>{{$fixture->division}}</div></td>
            </tr>
            <tr scope="row">
                <td><div class="right">Week Number:</div></td>
                <td><div>{{$fixture->weekNum}}</div></td>
            </tr>
            <tr scope="row">
                <td><div class="right">Match Date:</div></td>
                <td><div>{{$fixture->matchDate}}</div></td>
            </tr>
        </tbody>
    </table>
    @isset($players)
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th>Home</th>
                    <th>Away</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div>Player 1</td>
                    <td><div>{{$players->homeA1->playerName}}</div></td>
                    <td><div>{{$players->awayA1->playerName}}</div></td>
                </tr>
                <tr>
                    <td><div>Player 2</td>
                    <td><div>{{$players->homeA2->playerName}}</div></td>
                    <td><div>{{$players->awayA2->playerName}}</div></td>
                </tr>
                <tr>
                    <td><div>Player 3</td>
                    <td><div>{{$players->homeB1->playerName}}</div></td>
                    <td><div>{{$players->awayB1->playerName}}</div></td>
                </tr>
                <tr>
                    <td><div>Player 4</td>
                    <td><div>{{$players->homeB2->playerName}}</div></td>
                    <td><div>{{$players->awayB2->playerName}}</div></td>
                </tr>
            </tbody>
        </table>
        @foreach ($matches as $key => $match)
            <div class="container">
                <table class="table table-bordered">
                    <tr>
                    <th colspan="9">{{$key}}</th>
                    </tr>
                    <tr>
                        <td>Home</td>
                        @foreach ($match as $set)
                            <td>{{$set->homeScore}}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Away</td>
                        @foreach ($match as $set)
                            <td>{{$set->awayScore}}</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        @endforeach
    @else
        @if (!Auth::guest())
        <h1>Results</h1>
        {!! Form::open(['action' => 'FixtureController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('Date', 'Match Date:')}}
            {!! Form::date('matchDate', \Carbon\Carbon::now(), ['class' => 'form-control', 'max' => \Carbon\Carbon::now()->toDateString()]) !!}
        </div>
        <table>
            <tr>
                <div class="form-group">
                    <td>{{Form::label('homeA', 'Home A Pair')}}</td>
                    <td>{{Form::select('players[home][a1]', [null=>'None'] + $homePlayers)}}</td>
                    <td>{{Form::select('players[home][a2]', [null=>'None'] + $homePlayers)}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>{{Form::label('homeB', 'Home B Pair')}}</td>
                    <td>{{Form::select('players[home][b1]', [null=>'None'] + $homePlayers)}}</td>
                    <td>{{Form::select('players[home][b2]', [null=>'None'] + $homePlayers)}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>{{Form::label('awayA', 'Away A Pair')}}</td>
                    <td>{{Form::select('players[away][a1]', [null=>'None'] + $awayPlayers)}}</td>
                    <td>{{Form::select('players[away][a2]', [null=>'None'] + $awayPlayers)}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>{{Form::label('awayB', 'Away B Pair')}}</td>
                    <td>{{Form::select('players[away][b1]', [null=>'None'] + $awayPlayers)}}</td>
                    <td>{{Form::select('players[away][b2]', [null=>'None'] + $awayPlayers)}}</td>
                </div>
            </tr>
        </table>
        <table class="table score">
            <tr>
                <td colspan=4>{{Form::label('AvA', 'Home A vs Away A')}}</td>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Home:</td><td>{{Form::number('match[AA][1][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AA][2][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AA][3][home]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Away:</td><td>{{Form::number('match[AA][1][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AA][2][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AA][3][away]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                <td>Tie Break:</td><td>{{Form::checkbox('match[AA][1][tie]', 1)}}</td><td>{{Form::checkbox('match[AA][2][tie]', 1)}}</td><td></td>
                </div>
            </tr>
            <tr>
                <td colspan=4>{{Form::label('AvB', 'Home A vs Away B')}}</td>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Home:</td><td>{{Form::number('match[AB][1][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AB][2][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AB][3][home]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Away:</td><td>{{Form::number('match[AB][1][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AB][2][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[AB][3][away]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                <td>Tie Break:</td><td>{{Form::checkbox('match[AB][1][tie]', 1)}}</td><td>{{Form::checkbox('match[AB][2][tie]', 1)}}</td><td></td>
                </div>
            </tr>
            <tr>
                <td colspan=4>{{Form::label('BvA', 'Home B vs Away A')}}</td>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Home:</td><td>{{Form::number('match[BA][1][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BA][2][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BA][3][home]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Away:</td><td>{{Form::number('match[BA][1][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BA][2][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BA][3][away]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                <td>Tie Break:</td><td>{{Form::checkbox('match[BA][1][tie]', 1)}}</td><td>{{Form::checkbox('match[BA][2][tie]', 1)}}</td><td></td>
                </div>
            </tr>
            <tr>
                <td colspan=4>{{Form::label('BvB', 'Home B vs Away B')}}</td>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Home:</td><td>{{Form::number('match[BB][1][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BB][2][home]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BB][3][home]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                    <td>Away:</td><td>{{Form::number('match[BB][1][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BB][2][away]', 0, ['min'=>0])}}</td><td>{{Form::number('match[BB][3][away]', 0, ['min'=>0])}}</td>
                </div>
            </tr>
            <tr>
                <div class="form-group">
                <td>Tie Break:</td><td>{{Form::checkbox('match[BB][1][tie]', 1)}}</td><td>{{Form::checkbox('match[BB][2][tie]', 1)}}</td><td></td>
                </div>
            </tr>
        </table>
        <div class="form-group">
            {{Form::label('ScoreSheet', 'Score Sheet')}}<br>
            {{Form::file('cover_image')}}
        </div>
            {{ Form::hidden('id', $id) }}
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        @endif
    @endisset

</div>
@endsection