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
        <form method="POST" action="{{ action("UserTransactionController@studadd") }}" name="studadd" id="studadd">
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
                <input type="password" minlength="8" name="pwd" id="pwd" required>
                Leave empty for random *Comming soon*
            </p>
            <p>
                <label>Razred: </label><br>
                <select name="class" id="class" required>
                    @foreach(App\Classes::all() as $class)
                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <input type="checkbox" name="multi" id="multi">
                <label>Visestruki unos?</label>
            </p>
            <input type="submit" name="submit" id="studSubmit" value="Unesi">
        </form>
    </fieldset>

@endsection