@extends('layouts.app')

@section('content')
    <h1 id="h1_form_title">Upravljanje testovima</h1>

                        <table id="active-test">
                            <thead>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Razredi</th>
                            </thead>
                            <tbody>
                            @foreach($active as $key => $test)
                                <tr>
                                    <td>{{ $test->test_title }}</td>
                                    <td>
                                        @if($test->test_type == 2)
                                            Samoprovjera
                                        @else
                                            Provjera znanja
                                        @endif
                                    </td>
                                    <td>
                                        <select>
                                            @foreach($activeClasses[$key] as $class)
                                                <option>{{ $class }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><a href="./deac?id={{ $test->test_id }}">Deaktiviraj</a></td>
                                    <td><a href="./deltest?id={{ $test->test_id }}" class="confirmation">Obrisi</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    <table id="inactive-test">
                        <thead>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            @if($inactive->count() == 0)
                                <tr>
                                    <td colspan="4">Nema neaktivnih provjera znanja</td>
                                </tr>
                            @else
                                @foreach($inactive as $key => $test)
                                    <tr>
                                        <td>{{ $test->test_title }}</td>
                                        <td>
                                            @if($test->test_type == 2)
                                                Samoprovjera
                                            @else
                                                Provjera znanja
                                            @endif
                                        </td>
                                        <td>
                                            <select name="" id="">
                                                @foreach($inactiveClasses[$key] as $class)
                                                    <option>{{ $class }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><a href="./act?id={{ $test->test_id }}">Aktiviraj</a></td>
                                        <td><a href="./deltest?id={{ $test->test_id }}" class="confirmation">Obrisi</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

        <h1 id="h1_form_title" style="width: 100%">Unos nove zadace</h1>
            <form method="POST" id="addexam" action="{{ action('ExamController@examcreate') }}">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    <label for="title" id="form_label">Naziv testa: </label>
                    <input type="text" name="title" id="generic_input" required>

                    <label for="subject" id="form_label">Predmet: </label>
                    <select name="subject" id="generic_input" required>
                        <option value="0" selected></option>
                        @foreach(App\Subject::all() as $subject)
                            <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                        @endforeach
                    </select>

                    <label for="field" id="form_label">Gradivo: </label>
                    <select name="field" id="generic_input" required>
                    </select>

                    <label for="class" id="form_label">Razred: </label>
                    <select name="class[]" id="generic_input" multiple required style="width: 25%">
                        @foreach(App\Classes::all() as $class)
                            <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                        @endforeach
                    </select>

                    <label for="type" id="form_label">Tip testa: </label>
                    <select name="type" id="generic_input" required>
                        <option value="2">Samoprovjera</option>
                        <option value="1">Provjera znanja</option>
                    </select>

                    <input type="submit" name="submit" id="generic_submit" value="Unesi">
            </form>

    <script>
        $(document).ready(function () {

            console.log('Ready!');
            $('select[name=subject]').on('change', function () {
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

            $(".confirmation").on('click', function () {
                return confirm("Jeste li sigurni da želite obrisati test?");
            })


        });
    </script>

@endsection