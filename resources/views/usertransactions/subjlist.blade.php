@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis predmeta</h1>
    <table id="list_table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            @if(Auth::user()->user_class == 'admin')
                <th>Profesor</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @if(Auth::user()->user_class == 'admin')
            @foreach(App\Subject::all() as $subject)
                <tr>
                    <td>{{ $subject->subj_id }}</td>
                    <td>{{ $subject->subj_name }}</td>
                    <td>{{ App\User::where('user_id', $subject->subj_author)->first()->value('user_name') }}</td>
                </tr>
            @endforeach
        @else
            @foreach(App\Subject::where('subj_author', Auth::user()->user_id)->get() as $subject)
                <tr>
                    <td>{{ $subject->subj_id }}</td>
                    <td>{{ $subject->subj_name }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection