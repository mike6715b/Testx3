@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Upravljanje ispitima</legend>
        <table>
            <tr>
                <td>
                    <fieldset style="margin-left: 10em" id="activetest">
                        <legend align="left">Aktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Status</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Prvi ispit</td>
                                <td>Odaberi odgovor</td>
                                <td>Aktivan</td>
                                <td>4.MT</td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </td>
                <td>
                    <fieldset style="margin-left: 15em" id="inactivetest">
                        <legend align="left">Neaktivni ispiti</legend>
                        <table id="active-test">
                            <thead>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Tip</th>
                            <th>Status</th>
                            <th>Razred</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Drugi ispit</td>
                                <td>Odaberi odgovor</td>
                                <td>Neaktivan</td>
                                <td>4.MT</td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>

        <fieldset id="addtest">
            <legend>Dodavanje ispita</legend>
            <form method="POST" id="addexam">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <p>
                    <label>Predmet: </label>
                    <select name="subject" id="subject">
                        <option value="0" selected></option>
                        @foreach(App\Subject::all() as $subject)
                            <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                        @endforeach
                    </select>
                </p>
            </form>
        </fieldset>

    </fieldset>

@endsection