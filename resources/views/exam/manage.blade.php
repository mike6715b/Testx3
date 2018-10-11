@extends('layouts.app')

@section('content')

    <fieldset class="exam-manage">
        <legend align="left">Upravljanje ispitima</legend>
        <table>
            <tr>
                <td>
                    <fieldset id="activetest">
                        <legend align="left">Aktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            <?php $acID = 1; ?>
                            @foreach($active as $test)
                                <tr>
                                    <td>{{ $acID }}</td>
                                    <td>{{ $test->test_title }}</td>
                                    <td>
                                        @if($test->test_type == 2)
                                            Samoprovjera
                                        @else
                                            Provjera znanja
                                        @endif
                                    </td>
                                    <td>
                                        <?php $classes = json_decode($test->test_class) ?>
                                        @foreach($classes as $class)
                                            {{ \App\Classes::where('class_id', $class)->first()->class_name }},
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </td>
                <td>
                    <fieldset id="inactivetest">
                        <legend align="left">Neaktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
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
                                <?php $inacID = 1; ?>
                                @foreach($inactive as $test)
                                    <tr>
                                        <td>{{ $inacID }}</td>
                                        <td>{{ $test->test_title }}</td>
                                        <td>
                                            @if($test->test_type == 2)
                                                Samoprovjera
                                            @else
                                                Provjera znanja
                                            @endif
                                        </td>
                                        <td>
                                            <?php $classes = json_decode($test->test_class) ?>
                                            @foreach($classes as $class)
                                                {{ \App\Classes::where('class_id', $class)->first()->class_name }},
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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