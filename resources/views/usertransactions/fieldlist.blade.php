@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Popis gradiva</legend>
        <label>Predmet: </label>
        <select name="subjectSel" id="subjectSel">
            <option value="0"></option>
            @foreach(App\Subject::all() as $subject)
                <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
            @endforeach
        </select>
        <table id="gradiva">
            <thead>
                <tr>
                    <th align="center">ID</th>
                    <th align="right">Naziv</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </fieldset>

    <script>

        $(document).ready(function () {
           console.log("Ready!");
           $('#subjectSel').on('change', function () {
              var selectedVal = $('#subjectSel').val();
              //console.log('Change!');
              if (selectedVal !== 0) {
                  var dataString = "subj=" + selectedVal;
                  $.ajax({
                      type: 'GET',
                      url: '{{ action('UserTransactionController@ajaxGetFields') }}',
                      data: dataString,
                      dataType: 'JSON',
                      cache: false,
                      success: function(data) {
                          $.each(data, function(key, value) {
                              $('#tbody').append('<tr><td>' + value + '<td><td>' + key + '</td>></tr>');
                          });
                      }
                  });
              }
           });
        });

    </script>

@endsection