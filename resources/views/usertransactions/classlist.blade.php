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
            @foreach(App\Classes::all() as $class)
                <tr>
                    <td>{{ $class->class_id }}</td>
                    <td>{{ $class->class_name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection