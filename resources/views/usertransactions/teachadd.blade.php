@extends('layouts.app')

@section('content')

    <fieldset>
        <form method="POST" action="{{ action('UserTransactionController@teachadd') }}" id="teachAdd" >
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <p>
                <label>Ime Prezime: </label><br>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <label>Username: </label><br>
                <input type="text" name="uid" id="uid" required>
            </p>
            <p>
                <label>Email: </label><br>
                <input type="email" name="email" id="email" required>
            </p>
            <p>
                <label>Password: </label><br>
                <input type="password" name="pwd" id="pwd">
                Leave empty for random
            </p>
            <p>
                <input type="checkbox" name="multi" id="multi">
                <label>Visestruki unos?</label>
            </p>
            <button type="submit" name="submit" id="submit">Unesi</button>
        </form>
    </fieldset>

@endsection