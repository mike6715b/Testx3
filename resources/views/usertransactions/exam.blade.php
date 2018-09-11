@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Upravljanje ispitima</legend>
        <fieldset style="width: 35%;">
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

    </fieldset>

@endsection