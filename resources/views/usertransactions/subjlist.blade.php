@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis predmeta</h1>
    <table id="list_table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Autor</th>
        </tr>
        </thead>
        <tbody>
        @foreach(App\Subject::where('subj_author', Auth::user()->user_uid)->get() as $subject)
            <tr>
                <td>{{ $subject->subj_id }}</td>
                <td>{{ $subject->subj_name }}</td>
                <td>{{ $subject->subj_author }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection