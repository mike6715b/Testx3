@extends('layouts.app')

@section('content')
<div id="examlist">
    <div id="tests_self">
        <h1 id="h1_form_title">Samoprovjere</h1>
        <table name="tests_self" id="test_self">
            <thead>
            <th>Naziv testa</th>
            <th>Predmet</th>
            <th>Datum aktivacije</th>
            <th></th>
            </thead>
            <tbody id="tbody_self">
            @if(!empty($self))
                @foreach($self as $testS)
                    <tr>
                        <td>{{ $testS->test_title }}</td>
                        <td>{{ \App\Subject::where('subj_id', \App\Question::where('ques_id', $testS->test_ques)->first()->ques_subj_id)->first()->subj_name }}</td>
                        <td>{{ $testS->updated_at }}</td>
                        <td><a href="/examgen?id={{ $testS->test_id }}">Pisanje</a> </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" align="center">Nema aktivnih provjera!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div id="test_exam">
        <h1  id="h1_form_title">Provjere znanja</h1>
        <table name="test_exam" id="test_exam">
            <thead>
            <th>Naziv testa</th>
            <th>Predmet</th>
            <th>Datum aktivacije</th>
            <th></th>
            </thead>
            <tbody id="tbody_exam">
            @if(!empty($exam))
                @foreach($exam as $testE)
                    <tr>
                        <td>{{ $testE->test_title }}</td>
                        <td>{{ \App\Subject::where('subj_id', \App\Question::where('ques_id', $testE->test_ques)->first()->ques_subj_id)->first()->subj_name }}</td>
                        <td>{{ $testE->updated_at }}</td>
                        <td><a href="/examgen?id={{ $testE->test_id }}">Pisanje</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" align="center">Nema aktivnih provjera!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </fieldset>
    </div>
</div>
@endsection