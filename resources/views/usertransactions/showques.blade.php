@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Prikaz pitanja</legend>
        <form action="../mainmenu/fieldlist">
            <input type="submit" value="Povratak" />
        </form>
        <table id="pitanja">

            <thead>
                <th align="center">Tip pitanja</th>
                <th align="center">Pitanje</th>
                <th align="center">Odgovor 1</th>
                <th align="center">Odgovor 2</th>
                <th align="center">Odgovor 3</th>
                <th align="center">Odgovor 4</th>
                <th align="center">Tocan?</th>
            </thead>

            <tbody>
                @foreach($decoded as $question)
                    <tr>
                        <td>{{ $question['type'] }}</td>
                        <td>{{ $question['question'] }}</td>
                        <td>{{ $question['ans1'] }}</td>
                        <td>{{ $question['ans2'] }}</td>
                        <td>{{ $question['ans3'] }}</td>
                        <td>{{ $question['ans4'] }}</td>
                        <td>@if(is_array($question['correct']))
                                @foreach($question['correct'] as $ans)
                                    @if($ans == 'ans1') 1
                                    @elseif($ans == 'ans2') 2
                                    @elseif($ans == 'ans3') 3
                                    @else 4
                                    @endif
                                @endforeach
                            @else
                                @if($ans == 'ans1') 1
                                @elseif($ans == 'ans2') 2
                                @elseif($ans == 'ans3') 3
                                @else 4
                                @endif
                            @endif</td>
                    <tr>
                @endforeach
            </tbody>

        </table>
    </fieldset>

@endsection