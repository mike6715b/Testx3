@extends('layouts.app')

@section('content')

    <fieldset>
        <legend>Popis Predmeta</legend>
        <table>
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Autor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->subj_name }}</td>
                        <td>{{ $subject->subj_author }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </fieldset>

@endsection