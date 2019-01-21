@extends('layouts.app')

@section('content')

    <h1 id="h1_form_title">Dodavanje gradiva</h1>
        <form method="POST" name="fieldadd" id="fieldadd" action="{{ action('UserTransactionController@fieldadd') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

            <label for="name" id="form_label">Naziv: </label>
            <input type="text" name="name" id="generic_input" required>

            <label for="subject" id="form_label">Predmet: </label>
            <select name="subject" id="generic_input" style="width: auto">
                <option value="0" selected></option>
                @foreach(App\Subject::all() as $subject)
                    <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                @endforeach
            </select>

            <input type="submit" name="submit" id="generic_submit" value="Unesi">
        </form>

@endsection