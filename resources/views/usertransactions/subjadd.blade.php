@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Unos predmeta</h1>
    <form method="POST" id="subjadd" action="{{ action('UserTransactionController@subjadd') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

        <label for="name" id="form_label">Naziv: </label>
        <input type="text" name="name" id="generic_input" required>

        <label for="gradiva" id="form_label">Odmah na unos gradiva?</label>
        <input type="checkbox" name="gradiva" id="form_label"><br>

        <input type="submit" name="submit" id="generic_submit" value="Unesi">
    </form>

@endsection