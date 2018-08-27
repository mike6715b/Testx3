@extends('layouts.app')

@section('content')
    <style>
        fieldset {
            width: 90%;
            margin: auto;
            margin-top: 10px;
        }
    </style>
    <fieldset>
        <legend align="left">Dodavanje razreda</legend>
        <form action="{{ action('UserTransactionController@classadd') }}" method="POST">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <p>
                <label>Ime:</label>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <input type="checkbox" name="multi" id="multi">
                <label>Visestruki unos?</label>
            </p>
            <button type="submit" name="submit" id="submit">Unesi</button>
        </form>
    </fieldset>

@endsection