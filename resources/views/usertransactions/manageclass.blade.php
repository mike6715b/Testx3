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
                <th>Provjere</th>
                <th>Ocjene</th>
            </tr>
        </thead>
        <tbody id="list_table_body">
            @foreach($perms as $perm)
                <tr>
                    <td>{{ \App\User::where('user_id', $perm['user_id'])->value('user_name') }}</td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['list_class']"@if($perm['list_class']) checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['list_student']" @if($perm['list_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['add_student']" @if($perm['add_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['remove_student']" @if($perm['remove_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['edit_student']" @if($perm['edit_student'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['read_student_info']" @if($perm['read_student_info'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['assign_exam']" @if($perm['assign_exam'])checked @endif></td>
                    <td><input type="checkbox" name="{{ $perm['class_id'] }}['list_grade']" @if($perm['list_grade'])checked @endif></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection