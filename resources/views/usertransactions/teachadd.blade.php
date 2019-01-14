@extends('layouts.app')

@section('content')

        <h1 id="h1_form_title">Unesi profesora</h1>
        <form method="POST" action="{{ action('UserTransactionController@teachadd') }}" id="teachAdd" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

            <label for="name" id="form_label">Ime Prezime: </label>
            <input type="text" name="name" id="generic_input" required>

            <label for="uid" id="form_label">Username: </label>
            <input type="text" name="uid" id="generic_input" required>

            <label for="email" id="form_label">Email: </label>
            <input type="email" name="email" id="generic_input" required>

            <label for="pwd" id="form_label">Password: </label>
            <input type="password" name="pwd" id="generic_input">

            <label for="multi" id="form_label">Visestruki unos?</label>
            <input type="checkbox" name="multi" id="multi"><br>

            <input type="submit" name="submit" id="generic_submit" value="Unesi">
        </form>

@endsection