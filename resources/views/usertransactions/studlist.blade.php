@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis učenika</h1>
    <table id="list_table">
        <thead>
        <tr>
            <th>Ime</th>
            <th>Mail</th>
            <th>Korisničko ime</th>
            <th>Razred</th>
        </tr>
        </thead>
        <tbody id="list_table_body">
            @if(!empty($students))
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->user_name }}</td>
                        <td>{{ $student->user_email }}</td>
                        <td>{{ $student->user_uid }}</td>
                        <td>{{ \App\Classes::where('class_id', $student->user_class)->value('class_name') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">Nema ucenika!</td>
                </tr>
            @endif
        </tbody>
    </table>

@endsection