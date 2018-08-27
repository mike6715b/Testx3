@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Dodavanje pitanja</legend>
        <form method="POST" action="{{ action('UserTransactionController@fieldquesadd') }}" name="fieldquesadd" id="fieldquesadd">
            <div id="selFieldSubj">
                <p>
                    <label>Predmet: </label>
                    <select name="subjectSel" id="subjectSel">
                        <option value="0"></option>
                        @foreach(App\Subject::all() as $subject)
                            <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <label>Gradivo: </label>
                    <select name="fieldSel" id="fieldSel">

                    </select>
                </p>
                <p>
                    <button name="conf1" id="conf1">Uredu</button>
                </p>
            </div>
            <div id="enterQues" style="display:none;">
                <p id="quesNum">
                    Pitanje br:
                </p>
                <p id="quesTypeSelector">
                    <label>Tip pitanja: </label><br>
                    <select name="quesType" id="quesType">
                        <option value="1">Odabir odgovora</option>
                        <option value="2">Upis odgovora</option>
                    </select>
                </p>
                <div id="question" style="display: none;">
                    <label>Unesite pitanje: </label><br>
                    <input type="text" name="question" id="question">
                </div>
                <div id="quesType-1">
                    <p>
                        <label>Odgovor 1: </label>
                        <input type="text" name="1-ans1" id="1-ans1" required>
                    </p>
                    <p>
                        <label>Odgovor 2: </label>
                        <input type="text" name="1-ans2" id="1-ans2">
                    </p>
                    <p>
                        <label>Odgovor 3: </label>
                        <input type="text" name="1-ans3" id="1-ans3">
                    </p>
                    <p>
                        <label>Odgovor 4: </label>
                        <input type="text" name="1-ans4" id="1-ans4">
                    </p>
                    <p>
                        <button id="1-addAns" name="1-addAns">Dodaj odgovor</button>
                    </p>

                </div>
                <button id="submitQues" name="submitQUes" style="display: none;">Unesi pitanje</button>
            </div>
        </form>
    </fieldset>

    <script>
        $(document).ready(function () {
           console.log('Ready!');
           $('#subjectSel').on('change', function () {
              var selectedValue = $(this).val();
              console.log("Odabrano: " + selectedValue);
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
                            $('select[name="fieldSel"]').append('<option value="' + value + '">' + key + '</option>');
                          });
                      }
                  });
              }
           });
        });
    </script>

@endsection