@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Unos Predmeta</legend>
        <form method="POST" id="subjadd" action="{{ action('UserTransactionController@subjadd') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <p>
                <label>Naziv: </label><br>
                <input type="text" name="name" id="name" required>
            </p>
            <input type="checkbox" name="gradiva" id="gradiva">
            <label>Odmah na unos gradiva?</label><br>
            <button type="submit" name="submit">Unesi</button>
        </form>
    </fieldset>

@endsection