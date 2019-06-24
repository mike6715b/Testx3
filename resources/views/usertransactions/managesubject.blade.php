@extends('layouts.app')

@section('content')

    <?php //dd($perms); ?>

    <h1 id="h1_form_title">Upravljanje predmetom</h1>
    <table id="list_table">
        <thead>
        <tr>
            <th>Profesor</th>
            <th>Ispis predmeta</th>
            <th>Dodavanje gradiva</th>
            <th>Uklanjanje gradiva</th>
            <th>Dodavanje pitanja</th>
            <th>Uklanjanje pitanja</th>
            <th>Stvaranje ispita</th>
            <th>Obrisati?</th>
        </tr>
        </thead>
        <tbody id="list_table_body">
        @foreach($perms as $perm)
            <tr>
                <td>{{ \App\User::where('user_id', $perm['user_id'])->value('user_name') }}</td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},list_subj"@if($perm['list_subj']) checked @endif></td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},add_field" @if($perm['add_field'])checked @endif></td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},remove_field" @if($perm['remove_field'])checked @endif></td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},add_question" @if($perm['add_question'])checked @endif></td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},remove_question" @if($perm['remove_question'])checked @endif></td>
                <td><input type="checkbox" name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }},make_exam" @if($perm['make_exam'])checked @endif></td>
                <td><img name="{{ $perm['user_id'] }},{{ $perm['subj_id'] }}" src="{{ asset('img/red-x.jpg') }}" alt="Obrisi" width="20" height="20"></td>
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
            var attrName = $(this).attr('name');
            var nameA = attrName.split(",");
            let attrChecked = $(this).prop('checked');
            $.ajax({
                type: "GET",
                url: "{{ action('AjaxController@ajaxUpdateSubjectPerm') }}",
                data: { user_id: nameA[0], subj_id: nameA[1], perm: nameA[2], value: attrChecked},
                success: function() {
                    new Noty({
                        text: "Dopustenje " + nameA[2] + " za predmet " + nameA[1] + " za korisnika " + nameA[0] + " je sada " + attrChecked,
                        type: "success",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 3000,
                        progressBar: true,
                    }).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    new Noty({
                        text: "Dogodila se pogreska! \n" + thrownError,
                        type: "error",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 3000,
                        progressBar: true,
                    }).show();
                }
            });
        });

        $('#list_table tbody').on('click', 'img', function () {
            var attrName = $(this).attr('name');
            var nameA = attrName.split(",");
            if(confirm("Jeste li sigurni da zelite obrisati dopustenja?")) {
                $.ajax({
                    type: "GET",
                    url: "{{ action('AjaxController@ajaxDeleteSubjectPerm') }}",
                    data: { user_id: nameA[0], subj_id: nameA[1] },
                    success: function () {
                        new Noty({
                            text: "Obrisana su dopustenja za korisnika " + nameA[0],
                            type: "success",
                            layout: "topRight",
                            theme: "relax",
                            timeout: 3000,
                            progressBar: true,
                        }).show();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        new Noty({
                            text: "Dogodila se pogreska! \n" + thrownError,
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
            var subj_id = getUrlParameter('subj_id');
            $('tr[id=addPerm]').hide();
            $('tr[id=teachID]').show();
            $.ajax({
                type: "GET",
                url: "{{ action('AjaxController@ajaxGetTeachers') }}",
                dataType: "JSON",
                success: function (data) {
                    $.each(data, function(key, value) {
                        $('select[name="teacherID"]').append('<option value="' + value + '">' + key + '</option>');
                    });
                }
            });
        });

        $('#selTeach').change(function () {
            var teachID = $('#selTeach').val();
            $.ajax({
                type: "GET",
                data: { teach_id: teachID, subj_id: getUrlParameter('subj_id') },
                url: "{{ action('AjaxController@ajaxAddSubjectPerm') }}",
                success: function () {
                    new Noty({
                        text: "Dodana su nova dopustenja za korisnika " + $("#selTeach option:selected").text(),
                        type: "success",
                        layout: "topRight",
                        theme: "relax",
                        timeout: 3000,
                        progressBar: true,
                    }).show();
                    $('tr[id=teachID]').hide();
                    $('#list_table > tbody > tr[id=addPerm]').prev().after('<tr><td>' + $("#selTeach option:selected").text() + '</td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',list_subj"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',add_field"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',remove_field"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',add_question"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',remove_question"></td>' +
                        '<td><input type="checkbox" name="' + teachID + ',' + getUrlParameter("subj_id") + ',make_exam"></td>' +
                        '<td><img name="' + teachID + ',' + getUrlParameter("subj_id") + '" src="{{ asset('img/red-x.jpg') }}" alt="Obrisi" width="20" height="20"></td></tr>');
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
                        timeout: 3000,
                        progressBar: true,
                    }).show();
                }
            });
        });
    </script>

@endsection