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
                <label>Razred: </label><br>
                <select name="class" id="class" required>
                    <option value="0" selected></option>
                    @foreach(App\Classes::all() as $class)
                        <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <input type="checkbox" name="multi" id="multi">
                <label>Visestruki unos?</label>
            </p>
            <input type="button" name="submit" id="studSubmit" value="Unesi">
        </form>
    </fieldset>

    <script>
        //TODO
        //Gumb treba voditi na funkciju u jQuery
        //Dodati script za provjeru inputa
        //Random password generator
        //Form treba uputiti na controller funkciju

        $(document).ready(function () {
           console.log('READY!');
           $("#studSubmit").click(function () {
              var pwdLen = $("#pwd").val().length;
              if (pwdLen == 0) {
                var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
                var pwd = "";
                for (var x = 0; x < 8; x++) {
                    var i = Math.floor(Math.random() * chars.length);
                    pwd += chars.charAt(i);
                }
                console.log("Password: " + pwd);
                $("#pwd").val(pwd);
              }
            console.log("submit");
            $("form#studadd").submit();
           });
        });
    </script>

@endsection