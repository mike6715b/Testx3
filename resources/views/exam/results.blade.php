@extends('layouts.app')

@section('content')
    <?php $rb = 1; ?>
    <fieldset class="exam-result-done">
        <legend>Rezultati zadace</legend>
        <table align="center">
            <thead>
                <th>Rb.</th>
                <th>Naziv testa</th>
                <th>Ocjena</th>
                <th>Vrijeme rjesavanja</th>
            </thead>
            <tbody>
                @if(count($data) != 0)
                    @foreach($data as $dat)
                        <tr>
                            <td>{{ $rb }}</td>
                            <td>{{ \App\Test::where('test_id', '=', $dat->test_id)->first()->test_title }}</td>
                            <td>{{ $dat->test_grade }}</td>
                            <td>{{ $dat->test_complete }}</td>
                        </tr>
                        <?php $rb++ ?>
                    @endforeach
                @else
                    <td colspan="4">Nema rijesenih provjera</td>
                @endif
            </tbody>
        </table>
    </fieldset>

@endsection