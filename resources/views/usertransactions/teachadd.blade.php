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

            <label for="pwd" id="form_label">Lozinka: </label>
            <input type="password" name="pwd" id="generic_input">

            <label for="reppwd" id="form_label">Ponovljena lozinka: </label>
            <input type="password" minlength="8" name="reppwd" id="generic_input" required>

            <label for="multi" id="form_label">Visestruki unos?</label>
            <input type="checkbox" name="multi" id="multi"><br>

        </form>

        <button id="generic_submit">Unesi</button>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#generic_submit').on('click', function() {
                    var pass1 = $("[name=pwd]").val();
                    var pass2 = $("[name=reppwd]").val();
                    if (pass1 == pass2) {
                        $("form#teachAdd").submit();
                    } else {
                        alert("Lozinke se ne podudaraju!");
                    }
                });
            });
        </script>

@endsection