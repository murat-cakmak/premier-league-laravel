@extends('league')
@section('table')
<table>
    <thead>
    <tr class="title">PREMIER LEAGUE</tr>
    <tr>
        <td>Team</td>
        <td>Played</td>
        <td>Won</td>
        <td>Draw</td>
        <td>Lose</td>
        <td>Points</td>
    </tr>
    </thead>
    <tbody>
    @if (!empty($league))
    @foreach ($league as @lg)
    <tr>

    </tr>
    @endforeach
    @endif
    </tbody>
</table>
@endsection