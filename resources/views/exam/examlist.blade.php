@extends('layouts.app')

@section('content')

    <fieldset class="exam-list">
        <legend align="left">Samoprovjera</legend>
        <table name="tests_self" id="test_self">
            <thead>
            <th>Naziv testa</th>
            <th>Predmet</th>
            <th>Datum aktivacije</th>
            <th></th>
            </thead>
            <tbody id="tbody_self">
            @if(!empty($self))
                @foreach($self as $testS)
                    <tr>
                        <td>{{ $testS[1] }}</td>
                        <td>{{ $testS[2] }}</td>
                        <td>{{ $testS[3] }}</td>
                        <td><a href="/examgen?id={{ $testS[4] }}">Pisanje</a> </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" align="center">Nema aktivnih provjera!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </fieldset>

    <fieldset class="exam-list">
        <legend align="left">Provjera znanja</legend>
        <table name="test_exam" id="test_exam">
            <thead>
            <th>Naziv testa</th>
            <th>Predmet</th>
            <th>Datum aktivacije</th>
            <th></th>
            </thead>
            <tbody id="tbody_exam">
            @if(!empty($exam))
                @foreach($exam as $testE)
                    <tr>
                        <td>{{ $testE[1] }}</td>
                        <td>{{ $testE[2] }}</td>
                        <td>{{ $testE[3] }}</td>
                        <td><a href="/examgen?id={{ $testE[4] }}">Pisanje</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" align="center">Nema aktivnih provjera!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </fieldset>

@endsection