@extends('layouts.app')

@section('content')

    <fieldset>
        <table>
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Mail</th>
                    <th>Korisnicko ime</th>
                </tr>
            </thead>
            <tbody>
                @foreach(App\User::where('user_class', '=', 'teacher')->get() as $teacher)
                    <tr>
                        <td>{{ $teacher->user_name }}</td>
                        <td>{{ $teacher->user_mail }}</td>
                        <td>{{ $teacher->user_uid }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </fieldset>

@endsection