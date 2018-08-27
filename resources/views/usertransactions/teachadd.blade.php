@extends('layouts.app')

@section('content')

    <fieldset>
        <form method="POST" action="{{ action('UserTransactionController@teachadd') }}" id="teachAdd" >
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
            <input type="button" name="submit" id="teachSubmit" value="Unesi">
        </form>
    </fieldset>

    <script>
        $(document).ready(function () {
           console.log('Ready');
           $("#teachSubmit").click(function () {
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
               $("form#teachAdd").submit();
           });
        });
    </script>

@endsection