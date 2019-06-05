@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Upravljanje razredom</h1>
    <table id="list_table">
        <thead>
            <tr>
                <th>Profesor</th>
                <th>Ispis</th>
                <th>Popis</th>
                <th>Dodavanje</th>
                <th>Uklanjanje</th>
                <th>Izmjena</th>
                <th>Podatci</th>
                <th>Samoprovjere</th>
                <th>Provjere</th>
                <th>Ocjene</th>
            </tr>
        </thead>
        <tbody id="list_table_body">
            @foreach($perms as $perm)
                <tr>
                    <td>{{ \App\User::where('user_id', $perm['user_id'])->value('user_name') }}</td>
                    <td>@if($perm['list_class'])<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['list_student'])<input type="checkbox" name="{{ $perm['class_id'] }}['list_student']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['add_student'])<input type="checkbox" name="{{ $perm['class_id'] }}['add_student']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['remove_student'])<input type="checkbox" name="{{ $perm['class_id'] }}['remove_student']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['edit_student'])<input type="checkbox" name="{{ $perm['class_id'] }}['edit_student']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['read_student_info'])<input type="checkbox" name="{{ $perm['class_id'] }}['read_student_info']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['assign_self_exam'])<input type="checkbox" name="{{ $perm['class_id'] }}['assign_self_exam']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['assign_exam'])<input type="checkbox" name="{{ $perm['class_id'] }}['assign_exam']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                    <td>@if($perm['list_grade'])<input type="checkbox" name="{{ $perm['class_id'] }}['list_grade']" checked>
                        @else<input type="checkbox" name="{{ $perm['class_id'] }}['list_class']">@endif</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection