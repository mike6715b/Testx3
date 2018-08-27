@extends('layouts.app')

@section('content')

    <fieldset>
        <table>
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Mail</th>
                    <th>Korisnicko ime</th>
                    <th>Razred</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->user_email }}</td>
                        <td>{{ $user->user_uid }}</td>
                        <td>{{ $user->user_class }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </fieldset>

@endsection