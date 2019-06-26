@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Upravljanje razredom</h1>
    <table id="list_table">
        <thead>
            <tr>
                <th>Profesor</th>
                <th>Ispis</th>
                <th>Popis</th>
                <th>Dodavanje</th>
                <th>Uklanjanje</th>
                <th>Izmjena</th>
                <th>Podatci</th>
                <th>Provjere</th>
                <th>Ocjene</th>
                <th>Obrisati?</th>
            </tr>
        </thead>
        <tbody id="list_table_body">
            @foreach($perms as $perm)
                <tr>
                    <td>{{ \App\User::where('user_id', $perm['user_id'])->value('user_name') }}</td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},list_class"@if($perm['list_class']) checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},list_student" @if($perm['list_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},add_student" @if($perm['add_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},remove_student" @if($perm['remove_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},edit_student" @if($perm['edit_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},read_student_info" @if($perm['read_student_info'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},assign_exam" @if($perm['assign_exam'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['class_id'] }},list_grade" @if($perm['list_grade'])checked @endif></td>
                    <td><img name="{{ $perm['user_id'] }},{{ $perm['class_id'] }}" src="{{ asset('img/red-x.jpg') }}" alt="Obriši" width="20" height="20"></td>
                </tr>
            @endforeach
            <tr id="addPerm">
                <td colspan="10" id="addPerm">Dodaj...</td>
            </tr>
            <tr id="teachID" style="display:none">
                <td>
                    <select name="teacherID" id="selTeach">
                        <option value="0"></option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
        };

        $('#list_table tbody').on('click', 'input[type=checkbox]', function () {
            var permList = { list_class: "ispis rzreda", list_student: "popis učenika", add_student: "dodavanje učenika",
                remove_student: "uklanjanje učenika", edit_student: "uređivanje učenika",
                read_student_info: "čitanje podataka o učeniku", assign_exam: "dodjeljivanje ispita", list_grade: "ispis ocjena" };
            var trueFalse = { true: "dopušteno", false: "zabranjeno" };
            var attrName = $(this).attr('name');
            var nameA = attrName.split(",");
            let attrChecked = $(this).prop('checked');
            let teachName = $(this).parent().siblings(":first").text();
            $.ajax({
                type: "GET",
                url: "{{ action('AjaxController@ajaxUpdateClassPerm') }}",
                data: { user_id: nameA[0], class_id: nameA[1], perm: nameA[2], value: attrChecked},
                success: function() {
                    new Noty({
                        text: "Dopuštenje \"" + permList[nameA[2]] + "\" za korisnika " + teachName + " je sada <b>" + trueFalse[attrChecked] + "</b>",
                        type: "success",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 4000,
                        progressBar: true,
                    }).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    new Noty({
                        text: "Dogodila se pogreška! \n" + thrownError,
                        type: "error",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 10000,
                        progressBar: true,
                    }).show();
                }
            });
        });

        $('#list_table tbody').on('click', 'img', function () {
            var attrName = $(this).attr('name');
            var nameA = attrName.split(",");
            let teachName = $(this).parent().siblings(":first").text();
            if(confirm("Jeste li sigurni da želite obrisati dopuštenja za profesora " + teachName)) {
                $.ajax({
                    type: "GET",
                    url: "{{ action('AjaxController@ajaxDeleteClassPerm') }}",
                    data: { user_id: nameA[0], class_id: nameA[1] },
                    success: function () {
                        new Noty({
                            text: "Obrisana su dopuštenja za korisnika " + teachName,
                            type: "success",
                            layout: "topRight",
                            theme: "relax",
                            timeout: 3000,
                            progressBar: true,
                        }).show();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        new Noty({
                            text: "Dogodila se pogreška! \n" + thrownError,
                            type: "error",
                            layout: "topRight",
                            theme: "relax",
                            timeout: 3000,
                            progressBar: true,
                        }).show();
                    }
                });
                $(this).closest("tr").remove();
            }
        });

        $('#addPerm').on('click', function () {
            var class_id = getUrlParameter('class_id');
            $('tr[id=addPerm]').hide();
            $('tr[id=teachID]').show();
            $.ajax({
                type: "GET",
                url: "{{ action('AjaxController@ajaxGetTeachers') }}",
                dataType: "JSON",
                success: function (data) {
                    $.each(data, function(key, value) {
                        $('select[name="teacherID"]').append('<option value=" ' + value + ' ">' + key + '</option>');
                    });
                }
            });
        });

        $('#selTeach').change(function () {
            var teachID = $('#selTeach').val();
            $.ajax({
                type: "GET",
                data: { teach_id: teachID, class_id: getUrlParameter('class_id') },
                url: "{{ action('AjaxController@ajaxAddClassPerm') }}",
                success: function () {
                    new Noty({
                        text: "Dodana su nova dopuštenja za korisnika " + $("#selTeach option:selected").text(),
                        type: "success",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 3000,
                        progressBar: true,
                    }).show();
                    $('tr[id=teachID]').hide();
                    $('#list_table > tbody > tr[id=addPerm]').prev().after('<tr><td>' + $("#selTeach option:selected").text() + '</td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',list_class"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',list_student"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',add_student"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',remove_student"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',edit_student"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',read_student_info"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',assign_exam"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("class_id") + ',list_grade"></td>' +
                        '<td><img name="' + teachID + ',' + getUrlParameter("class_id") + '" src="{{ asset('img/red-x.jpg') }}" alt="Obriši" width="20" height="20"></td></tr>');
                    $('#selTeach > option').remove();
                    $('tr[id=addPerm]').show();
                    $('thead > tr').show();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    new Noty({
                        text: "Dogodila se pogreska! \n" + thrownError,
                        type: "error",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 10000,
                        progressBar: true,
                    }).show();
                }
            });
        });
    </script>

@endsection