@extends('layouts.app')

@section('content')
    <?php $rb = 1; ?>
    <h1 id="h1_form_title">Rezultati zadace</h1>
        <table align="center" id="list_table">
            <thead>
                @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == 'admin')
                    <th>Ucenik</th>
                @endif
                <th>Naziv testa</th>
                <th>Ocjena</th>
                <th>Vrijeme rjesavanja</th>
            </thead>
            <tbody>
                @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == 'admin')
                    @if(count($data) != 0)
                        @foreach($data as $dat)
                            <?php $dat = $dat[0]; ?>
                            <tr>
                                <td>{{ \App\User::where('user_id', $dat->test_user_id)->first()['user_name'] }}</td>
                                <td>{{ \App\Test::where('test_id', '=', $dat->test_id)->first()['test_title'] }}</td>
                                <td>{{ $dat->test_grade }}</td>
                                <td>{{ $dat->test_complete }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">Nema rijesenih provjera</td>
                        </tr>
                    @endif
                @elseif(count($data) != 0)
                        @foreach($data as $dat)
                            <tr>
                                <td>{{ \App\Test::where('test_id', '=', $dat->test_id)->first()['test_title'] }}</td>
                                <td>{{ $dat->test_grade }}</td>
                                <td>{{ $dat->test_complete }}</td>
                            </tr>
                            <?php $rb++ ?>
                        @endforeach
                @else
                    <td colspan="3">Nema rijesenih provjera</td>
                @endif
            </tbody>
        </table>
    </fieldset>

@endsection