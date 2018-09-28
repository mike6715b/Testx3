@extends('layouts.app')

@section('content')
<?php $pos=1 ?>
    <fieldset>
        <legend>Test</legend>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_email }}</p>
        <form  id="exam" method="POST" action="{{ action('ExamController@examcheck') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <table>
            @foreach($questions as $question)
                <tr>
                    <td>
                        <p>{{ $pos }}. {{ $question['question'] }}</p>
                        <p>
                            @if($question['type'] == 1)
                                <input type="checkbox" name="ans1">{{ $question['ans1'] }}<br>
                                <input type="checkbox" name="ans2">{{ $question['ans2'] }}<br>
                                <input type="checkbox" name="ans3">{{ $question['ans3'] }}<br>
                                <input type="checkbox" name="ans4">{{ $question['ans4'] }}<br>
                            @else
                                <p>Nije type 1</p>
                            @endif
                        </p>
                    </td>
                </tr>
                <?php $pos++ ?>
            @endforeach
        </table>
        </form>
    </fieldset>

@endsection