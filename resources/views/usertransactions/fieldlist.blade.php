@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis gradiva</h1>
        <label for="subjectSel" id="form_label">Predmet: </label>
        <select name="subjectSel" id="generic_input" style="width: auto">
            <option value="0"></option>
            @foreach($subjects as $key => $subject)
                <option value="{{ $key }}">{{ $subject }}</option>
            @endforeach
        </select>
        <table id="list_table">
            <thead>
                <tr>
                    <th align="center">Naziv</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>

    <script>

        $(document).ready(function () {
           console.log("Ready!");
           $('#generic_input').on('change', function () {
              var selectedVal = $('#generic_input').val();
              console.log('Change!');
              if (selectedVal !== 0) {
                  var dataString = "subj=" + selectedVal;
                  $.ajax({
                      type: 'GET',
                      url: '{{ action('UserTransactionController@ajaxGetFields') }}',
                      data: dataString,
                      dataType: 'JSON',
                      cache: false,
                      success: function(data) {
                          $('#tbody').empty();
                          $.each(data, function(key, value) {
                              $('#tbody').append('<tr>' +
                                  '<td>' + key + '</td></tr>');
                              //'<td><a href="../showques?id=' + value + '">Prikaz pitanja</a></td></tr>\n'
                          });
                      }
                  });
              }
           });
        });

    </script>

@endsection