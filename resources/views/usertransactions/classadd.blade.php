@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Unesi razred</h1>
    <form action="{{ action('UserTransactionController@classadd') }}" method="POST">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

        <label for="name" id="form_label">Naziv:</label>
        <input type="text" name="name" id="generic_input" required>

        <label for="multi" id="form_label">Visestruki unos?</label>
        <input type="checkbox" name="multi" id="multi"><br>

        <input type="submit" name="submit" id="generic_submit" value="Unesi">
    </form>

@endsection