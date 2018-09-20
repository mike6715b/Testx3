@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Upravljanje ispitima</legend>
        <table>
            <tr>
                <td>
                    <fieldset style="margin-left: 10em" id="activetest">
                        <legend align="left">Aktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Status</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Prvi ispit</td>
                                <td>Odaberi odgovor</td>
                                <td>Aktivan</td>
                                <td>4.MT</td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </td>
                <td>
                    <fieldset style="margin-left: 15em" id="inactivetest">
                        <legend align="left">Neaktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Status</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Drugi ispit</td>
                                <td>Odaberi odgovor</td>
                                <td>Neaktivan</td>
                                <td>4.MT</td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>

        <fieldset id="addtest">
            <legend>Dodavanje ispita</legend>
            <form method="POST" id="addexam" action="{{ action('ExamController@examcreate') }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <p>
                    <label>Naziv testa: </label>
                    <input type="text" name="title" id="title" required>
                </p>
                <p>
                    <label>Predmet: </label>
                    <select name="subject" id="subject" required>
                        <option value="0" selected></option>
                        @foreach(App\Subject::all() as $subject)
                            <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>Gradivo: </label>
                    <select name="field" id="field" required>
                    </select>
                </p>
                <p>
                    <label>Razred: </label>
                    <select name="class[]" id="class" multiple required>
                        @foreach(App\Classes::all() as $class)
                            <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>Tip testa: </label>
                    <select name="type" id="type" required>
                        <option value="2">Samoprovjera</option>
                        <option value="1">Provjera znanja</option>
                    </select>
                </p>
                <p>
                    <button type="submit" name="submit">Unesi</button>
                </p>
            </form>
        </fieldset>

    </fieldset>

    <script>
        $(document).ready(function () {
            console.log('Ready!');
            $('select#subject').on('change', function () {
                var selectedValue = $(this).val();
                console.log('Odabrano: ' + selectedValue);
                if (selectedValue !== 0) {
                    var dataString = "subj=" + selectedValue;
                    $.ajax({
                        type: "GET",
                        url: "{{ action('UserTransactionController@ajaxGetFields') }}",
                        data: dataString,
                        dataType: "JSON",
                        cache: false,
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('select[name="field"]').append('<option value="' + value + '">' + key + '</option>');
                            });
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "{{ action('UserTransactionController@ajaxGetClasses') }}",
                        data: dataString,
                        dataType: "JSON",
                        cache: false,
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('select[name="field"]').append('<option value="' + value + '">' + key + '</option>');
                            });
                        }
                    });
                }
            });


        });
    </script>

@endsection