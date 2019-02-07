@extends('layouts.app')

@section('content')
    <div class="studadd">
        <h1 id="h1_form_title">Dodavanje ucenika</h1>
        <form method="POST" action="{{ action("UserTransactionController@studadd") }}" name="studadd" id="studadd">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

            <label for="name" id="form_label">Ime Prezime: </label>
            <input type="text" name="name" id="generic_input" required>

            <label for="uid" id="form_label">Korisnicko ime: </label>
            <input type="text" name="uid" id="generic_input" required>

            <label for="email" id="form_label">Email: </label>
            <input type="email" name="email" id="generic_input" required>

            <label for="pwd" id="form_label">Lozinka: </label>
            <input type="password" minlength="8" name="pwd" id="generic_input" required>

            <label for="reppwd" id="form_label">Ponovljena lozinka: </label>
            <input type="password" minlength="8" name="reppwd" id="generic_input" required>

            <label for="class" id="form_label">Razred: </label>
            <select name="class" id="generic_input" required style="width: auto;">
                @foreach(App\Classes::all() as $class)
                    <option value="{{$class->class_id}}">{{$class->class_name}}</option>
                @endforeach
            </select>

            <input type="checkbox" name="multi" id="multi">
            <label for="multi" id="form_label">Visestruki unos?</label><br>

        </form>
        <button id="generic_submit">Unesi</button>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
           $('#generic_submit').on('click', function() {
               var pass1 = $("[name=pwd]").val();
               var pass2 = $("[name=reppwd]").val();
               if (pass1 == pass2) {
                   $("form#studadd").submit();
               } else {
                   alert("Lozinke se ne podudaraju!");
               }
           });
        });
    </script>
@endsection