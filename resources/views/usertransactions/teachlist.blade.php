@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis profesora</h1>
    <table id="list_table">
        <thead>
        <tr>
            <th>Ime</th>
            <th>Mail</th>
            <th>Korisničko ime</th>
        </tr>
        </thead>
        <tbody>
        @foreach(App\User::where('user_class', '=', 'teacher')->get() as $teacher)
            <tr>
                <td>{{ $teacher->user_name }}</td>
                <td>{{ $teacher->user_email }}</td>
                <td>{{ $teacher->user_uid }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection