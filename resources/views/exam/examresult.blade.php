@extends('layouts.app')

@section('content')

    <fieldset class="examresult">
        <legend>Rezultati</legend>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
        <p style="margin-bottom: 0px; margin-top: 0px">{{ \Illuminate\Support\Facades\Auth::user()->user_email }}</p>
        <p>Bodovi: {{ $score }}</p>
        <table>
            <?php $count = 0; //dd($anses)?>
            @foreach($questions as $question)
                <tr>
                    <p>{{ $question['question'] }}</p>
                    <p style="display: inline;">{{ $question['ans1'] }}<?php if (in_array('ans1', $question['correct'])) { if (in_array('ans1', $anses[$count])) { ?></p> <img src="{{ asset('img/kvacica.jpg') }}" height="12" width="12"> <?php } } elseif (in_array('ans1', $anses[$count])) { ?> <img src="{{ asset('img/red-x.jpg') }}" height="15" width="15"> <?php }  ?> <br>
                    <p style="display: inline;">{{ $question['ans2'] }}<?php if (in_array('ans2', $question['correct'])) { if (in_array('ans2', $anses[$count])) { ?></p> <img src="{{ asset('img/kvacica.jpg') }}" height="12" width="12"> <?php } } elseif (in_array('ans2', $anses[$count])) { ?> <img src="{{ asset('img/red-x.jpg') }}" height="15" width="15"> <?php }  ?> <br>
                    <p style="display: inline;">{{ $question['ans3'] }}<?php if (in_array('ans3', $question['correct'])) { if (in_array('ans3', $anses[$count])) { ?></p> <img src="{{ asset('img/kvacica.jpg') }}" height="12" width="12"> <?php } } elseif (in_array('ans3', $anses[$count])) { ?> <img src="{{ asset('img/red-x.jpg') }}" height="15" width="15"> <?php }  ?> <br>
                    <p style="display: inline;">{{ $question['ans4'] }}<?php if (in_array('ans4', $question['correct'])) { if (in_array('ans4', $anses[$count])) { ?></p> <img src="{{ asset('img/kvacica.jpg') }}" height="12" width="12"> <?php } } elseif (in_array('ans4', $anses[$count])) { ?> <img src="{{ asset('img/red-x.jpg') }}" height="15" width="15"> <?php }  ?> <br>
                </tr>
                <?php $count++ ?>
            @endforeach
        </table>
    </fieldset>

@endsection