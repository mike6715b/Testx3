@extends('layouts.app')

@section('content')
<?php $pos=0 ?>
    <fieldset style="margin-left: 15%; margin-right: 15%; margin-top: 10px; border: 2px solid #e8491d; border-radius: 5px;">
        <legend style="border: 2px solid #e8491d; border-radius: 5px; background-color: #dbdbdb;">Test</legend>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_email }}</p>
        <form  id="exam" method="POST" action="{{ action('ExamController@examcheck') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <table>
            @foreach($questions as $question)
                <tr>
                    <td>
                        <p style="border-radius: 15px; border-color: #ff8e70; border-width: 2px; border-style: solid; padding: 3px; background-color: #c6c6c6">{{ $pos+1 }}. {{ $question['question'] }}</p>
                        <p>
                            @if($question['type'] == 1)
                                <?php $count = []; ?>
                                @for($i = 0; $i < 4; $i++)<?php
                                    do {
                                        $num = rand(1, 4);
                                    } while (in_array($num, $count));
                                    $count[$i] = $num;
                                    ?>@endfor
                                <?php
                                    for ($i = 0; $i < 4; $i++) {
                                        switch ($count[$i]) {
                                            case 1:
                                                ?><label for="ans1"><input type="checkbox" name="ans[{{ $pos }}][]" value="ans1" id="ans1">{{ $question['ans1'] }}</label><br><?php
                                                break;
                                            case 2:
                                                ?><label for="ans2"><input type="checkbox" name="ans[{{ $pos }}][]" value="ans2" id="ans2">{{ $question['ans2'] }}</label><br><?php
                                                break;
                                            case 3:
                                                ?><label for="ans3"><input type="checkbox" name="ans[{{ $pos }}][]" value="ans3" id="ans3">{{ $question['ans3'] }}</label><br><?php
                                                break;
                                            case 4:
                                                ?><label for="ans4"><input type="checkbox" name="ans[{{ $pos }}][]" value="ans4" id="ans4">{{ $question['ans4'] }}</label><br><?php
                                                break;
                                        }
                                    }
                                    ?>
                            @else
                                <p>Nije type 1</p>
                            @endif
                        </p>
                    </td>
                </tr>
                <?php $pos++ ?>
            @endforeach
        </table>
            <button name="sub-btn">Unesi</button>
        </form>
    </fieldset>

@endsection