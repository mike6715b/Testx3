@extends('layouts.app')

@section('content')

    <fieldset>
        <legend align="left">Samoprovjera</legend>
        <table>
            <tr>
                <td>
                    <table name="available_tests" id="available_tests">
                        <thead>
                        <th></th>
                        </thead>
                    </table>
                </td>
            </tr>
        </table>
    </fieldset>

@endsection