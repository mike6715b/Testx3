@extends('layouts.app')

@section('content')
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_email }}</p>
        <form  id="exam" method="POST" action="{{ action('ExamController@examcheck') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <table>
            @foreach($questions as $Queskey => $question)
                <tr>
                    <td>
                        <p>{{ $Queskey+1 }}. {{ $question['question'] }}</p>
                        @foreach($question["ans"] as $key => $value)
                            <p><input type="checkbox" name="{{ $Queskey }}[]" value="{{ $key }}">{{ $value }}</p>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
            <button name="sub-btn">Predaj zadacu</button>
        </form>
    </fieldset>

@endsection