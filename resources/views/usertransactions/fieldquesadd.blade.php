@extends('layouts.app')

@section('content')
    
    <h1 id="h1_form_title">Unos novih pitanja</h1>
    <div class="fieldquesadd">
        <form method="POST" action="{{ action('UserTransactionController@fieldquesadd') }}" name="fieldquesadd" id="fieldquesadd">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            @if (!isset($retData))
                <div id="selFieldSubj">
                    <label for="subjectSel" id="form_label">Predmet: </label>
                    <select name="subjectSel" id="subjectSel">
                        <option value="0"></option>
                        @foreach(App\Subject::all() as $subject)
                            <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                        @endforeach
                    </select>
                    <label for="fieldSel" id="form_label">Gradivo: </label>
                    <select name="fieldSel" id="fieldSel" required>

                    </select>
                    <input type="button" value="U redu" name="conf1" id="conf1">
                </div>
            @else
                <div style="display: none">
                    <select name="subjectSel" id="subjectSel">
                        <option value="{{ $retData[0] }}"></option>
                    </select>
                    <select name="fieldSel" id="fieldSel" required>
                        <option value="{{ $retData[1] }}"></option>
                    </select>
                </div>
            @endif
            <div id="enterQues" style="display:none;">
                <p id="quesNum">
                    Pitanje br:
                </p>
                <label for="quesType" id="form_label">Tip pitanja: </label><br>
                <select name="quesType" id="quesType">
                    <option value="0"></option>
                    <option value="1">Visestruki odgovor</option>
                    <option value="2">Odabir odgovora</option>
                    <option value="3">Upis odgovora</option>
                </select>
                <div id="question" style="display: none;">
                    <label for="question" id="form_label">Unesite pitanje: </label><br>
                    <input type="text" name="question" id="question" required style="width: 75%"> <br>
                </div>
                <div id="ques" style="display: none;">

                </div>
                <div id="addRemoveAnses" style="display: none">
                    <button type="button" id="btnPlus"><bold>+</bold></button><button type="button" id="btnMinus"><bold>-</bold></button>
                </div>
                <div id="multi" style="display: none">
                    <label for="multi" id="form_label">Visestruki unos</label>
                    <input type="checkbox" name="multi" value="1">
                </div>
                <br><input type="submit" id="generic_submit" style="display: none" value="Unesi pitanje">
            </div>
        </form>
    </div>


    <script>

        //Za kad dodajem nova pitanja, koristiti jquery za ispis pitanja ovisno o tome koju vrstu odaberemo.

        $(document).ready(function () {
           console.log('Ready!');
           var selectedSubj = $('#subjectSel').val();
           var selectedField = $('#fieldSel').val();
           if (selectedSubj != null && selectedField != null) {
               $('#selFieldSubj').hide();
               $('#enterQues').show();
           }

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

           $('#quesType').on('change', function () {
              var selectedType = $("#quesType").val();
              console.log('Tip pitanja: ' + selectedType);
              $('#question').show();
              $('#multi').show();
              if (selectedType === "1") {
                  $('#ques').empty().show().append("<input type=\"checkbox\" name=\"tocanOdg[]\" value=\"0\"><input type=\"text\" name=\"ans[]\" id=\"ans\" required><br>");
                  $('#addRemoveAnses').show();
                  $('#generic_submit').show();
              } else if (selectedType === "2") {
                  $('#ques').empty().show().append("<input type=\"radio\" name=\"tocanOdg[]\" value=\"0\"><input type=\"text\" name=\"ans[]\" id=\"ans\" required><br>");
                  $('#addRemoveAnses').show();
                  $('#generic_submit').show();
              } else if (selectedType === "3") {
                  $('#ques').empty().show().append("<label for=\"ans\" id=\"form_label\">Odgovor: </label><input type=\"text\" name=\"ans\" id=\"ans\" required><br>");
                  $('#addRemoveAnses').hide();
                  $('#generic_submit').show();
              }
           });

           $('#btnPlus').click(function () {
               var selectedType = $("#quesType").val();
               var numbs = $('#ques > input').length/2;
               if (selectedType === "1") {
                   $('#ques').append("<input type=\"checkbox\" name=\"tocanOdg[]\" value=\"" + numbs + "\"><input type=\"text\" name=\"ans[]\" id=\"ans\" required><br>");
               } else if (selectedType === "2") {
                   $('#ques').append("<input type=\"radio\" name=\"tocanOdg[]\" value=\"" + numbs + "\"><input type=\"text\" name=\"ans[]\" id=\"ans\" required><br>");
               }
           });

           $('#btnMinus').click(function () {
               if ($('#ques > input').length/2+1 >= 3) {
                   $('#ques input').last().remove();
                   $('#ques input').last().remove();
                   $('#ques br').last().remove();
               }
           });

           /*$("#addAns").click(function (e) {
               e.preventDefault();
               $("#quesType1").append('<label>Odgovor: </label><input type="text" name="ans[]" required/> <br>');
           });*/
           
        });
    </script>

@endsection