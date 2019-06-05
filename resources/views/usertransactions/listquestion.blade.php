@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Popis pitanja</h1>
    @foreach($decoded as $key => $question)
        <div class="listquestion">
        <p>{{ $key }}. {{ $question['question'] }}</p>
        @if($question['type'] == 3)
            {{ $question['ans'] }}
        @else
            @foreach($question['ans'] as $ansKey => $ans)
                <p>{{ $ans }}@if(in_array($ansKey, $question['correct']))&#10004;@endif</p>
            @endforeach
        @endif
        </div>
    @endforeach

@endsection