@extends('layouts.app')

@section('content')
    <h1 id="h1_form_title">Popis razreda</h1>
    <div style="overflow-x: auto">
        <table id="list_table">
            <thead>
                <th>Broj</th>
                <th>Naziv</th>
            </thead>
            <tbody>
            @if(empty($classes))
                <tr>
                    <td colspan="3">Nema razreda!</td>
                </tr>
            @else
                @foreach($classes as $key => $class)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $class }}</td>
                        @if(\App\User::canUserClass($key, 'list_student'))<td><a href="{{ action('PagesController@studlist', ['class_id' => $key]) }}" target="_blank">Popis Ucenika</a></td>@endif
                        @if(\App\User::isTeacherMainClass($key))<td><a href="{{ action('PagesController@manageclass', ['class_id' => $key]) }}">Upravljaj</a></td>@endif
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection