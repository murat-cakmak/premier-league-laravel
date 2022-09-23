<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PREMIER LEAGUE</title>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
    <div class="container">
        <div class="league-table">
            <div class="weekly-title">League Table</div>
            <table class="weekly">
                <thead class="weekly-head">
                    <tr>
                        <td class="team">Team</td>
                        <td class="score">Played</td>
                        <td class="score">Won</td>
                        <td class="score">Draw</td>
                        <td class="score">Lose</td>
                        <td class="score">Points</td>
                    </tr>
                </thead>
                <tbody>
                @if (!empty($league))
                    @foreach ($league as $lg)
                        <tr>
                            <td class="team">
                                <img src="{{ asset('img/'. $lg->logo)}}" alt="{{ $lg->name }}">
                                {{ $lg->name }}
                            </td>
                            <td class="score">{{ $lg->played }}</td>
                            <td class="score">{{ $lg->won }}</td>
                            <td class="score">{{ $lg->draw }}</td>
                            <td class="score">{{ $lg->lose }}</td>
                            <td class="score">{{ $lg->points }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="match-result">
            <div class="results-title">Match Results</div>
            <table class="results">
                <thead>
                    <tr>
                        <td rowspan="3">1 st Week Match Result</td>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($matches))
                        @foreach ($matches[1] as $Match)
                            <tr>
                                <td style="width: 35%">{{ $Match['home_team'] }}</td>
                                <td style="text-align: center">
                                    {{ $Match['home_goal'] }}
                                    {{ $Match['away_goal'] }}
                                </td>
                                <td style="width: 35%">{{ $Match['away_team'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <div class="buttons">
            <a href="/play-all" class="play-all-button">Play All</a>
            <a href="/play-week/{{$league[0]->played + 1}}" class="play-week-button">Play Week</a>
        </div>
    </div>
</body>
</html>