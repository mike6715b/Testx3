@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis učenika</h1>
    <label for=""></label>
    <select name="class" id="generic_input">
        <option value="0"></option>
        @foreach($classes as $key => $class)
            <option value="{{ $class }}">{{ \App\Classes::where('class_id', $class)->value('class_name') }}</option>
        @endforeach
    </select>
    <table id="list_table">
        <thead>
        <tr>
            <th>Ime</th>
            <th>Mail</th>
            <th>Korisničko ime</th>
            <th>Razred</th>
        </tr>
        </thead>
        <tbody id="list_table_body">

        </tbody>
    </table>


    <script>
        $(document).ready(function () {
            console.log('Ready!');

            $('#generic_input').on('change', function () {
                $('#list_table_body').empty();
                var selectedValue = $(this).val();
                console.log("Odabrana vrijednost: " + selectedValue);
                if (selectedValue !== 0) {
                    var dataString = "class=" + selectedValue;
                    $.ajax({
                        type: "GET",
                        url: "{{ action('UserTransactionController@ajaxGetStudents') }}",
                        data: dataString,
                        dataType: "JSON",
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            $.each(data, function (key, value) {
                                $('#list_table tbody').append("<tr><td>" + value['user_name'] + "</td><td>" + value['user_email'] + "</td><td>" + value['user_uid'] + "</td><td>" + value['user_class'] +"</td></tr>");
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection