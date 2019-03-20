@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Unos predmeta</h1>
    <form method="POST" id="subjadd" action="{{ action('UserTransactionController@subjadd') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

        <label for="name" id="form_label">Naziv predmeta: </label>
        <input type="text" name="name" id="generic_input" required>

        <label for="teacher" id="form_label">Glavni nastavnik: </label>
        <select name="teacher" id="generic_input">
            <option value=""></option>
            @foreach(\App\User::where('user_class', 'teacher')->get() as $value)
                <option value="{{ $value->user_id }}">{{ $value->user_name }}</option>
            @endforeach
        </select>

        <label for="gradiva" id="form_label">Odmah na unos gradiva?</label>
        <input type="checkbox" name="gradiva" id="form_label"><br>

        <input type="submit" name="submit" id="generic_submit" value="Unesi">
    </form>

@endsection