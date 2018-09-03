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
                    <select name="fieldSel" id="fieldSel" required>

                    </select>
                </p>
                <p>
                    <input type="button" value="Uredu" name="conf1" id="conf1">
                </p>
            </div>
            <div id="enterQues" style="display:none;">
                <p id="quesNum">
                    Pitanje br:
                </p>
                <p id="quesTypeSelector">
                    <label>Tip pitanja: </label><br>
                    <select name="quesType" id="quesType">
                        <option></option>
                        <option value="1">Odabir odgovora</option>
                        <o1ption value="2">Upis odgovora</o1ption>
                    </select>
                </p>
                <div id="question" style="display: none;">
                    <label>Unesite pitanje: </label><br>
                    <input type="text" name="question" id="question"> <br>
                </div>
                <div id="quesType1" style="display: none;">
                        <label>Odgovor 1: </label>
                        <input type="text" name="1ans1" id="1ans1"> <br>
                        <label>Odgovor 2: </label>
                        <input type="text" name="1ans2" id="1ans2"> <br>
                        <label>Odgovor 3: </label>
                        <input type="text" name="1ans3" id="1ans3"> <br>
                        <label>Odgovor 4: </label>
                        <input type="text" name="1ans4" id="1ans4"> <br>
                        <button id="addAns" name="addAns">Dodaj odgovor</button>

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

           $('#conf1').click(function () {
              var subjValLen = $('#subjectSel').val();
              var fieldValLen = $('#fieldSel').val();
              if (subjValLen != null && fieldValLen != null) {
                  $('#selFieldSubj').hide();
                  $('#enterQues').show();
              } else {
                  alert('Popunite sva polja!');
              }
           });

           $('#quesTypeSelector').on('change', function () {
              var selectedType = $("#quesType").val();
              console.log('Tip pitanja: ' + selectedType);
              $('#question').show();
              if (selectedType === "1") {
                  $('#quesType1').show();
              } else if (selectedType === "2") {
                  alert('comming soon');
              }
           });

           $('#addAns').click(function () {

           });
        });
    </script>

@endsection