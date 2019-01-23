@extends('layouts.app')

@section('content')
<?php $pos=0 ?>
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
                                <?php $count = [];;?>
                                @for($i = 0; $i < count($question["ans"]); $i++)<?php
                                    do {
                                        $num = rand(1, count($question["ans"]));
                                    } while (in_array($num, $count));
                                    $count[$i] = $num;
                                    ?>@endfor
                                <?php dd($count);
                                    for ($d = 0; $d < count($question["ans"]); $d++) {
                                        switch ($question["type"]) {
                                            case 1:
                                                ?><label for="ans[{{ $pos }}][]"><input type="checkbox" name="ans[{{ $pos }}][]" value="ans{{$d+1}}" id="{{$pos}}ans1">{{ $count[$d] }}</label><br><?php
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
            <button name="sub-btn">Predaj zadacu</button>
        </form>
    </fieldset>

@endsection