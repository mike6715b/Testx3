@extends('layouts.app')

@section('content')

    <fieldset>
        <legend>Unos Gradiva</legend>
        <form method="POST" name="fieldadd" id="fieldadd" action="{{ action('UserTransactionController@fieldadd') }}">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <p>
                <label>Naziv: </label><br>
                <input type="text" name="name" id="name" required>
            </p>
            <p>
                <label>Predmet: </label>
                <select name="subject" id="subject">
                    <option value="0" selected></option>
                    @foreach(App\Subject::all() as $subject)
                        <option value="{{ $subject->subj_id }}">{{ $subject->subj_name }}</option>
                    @endforeach
                </select>
            </p>
            <button type="submit" name="submit" id="submit">Unesi</button>
        </form>
    </fieldset>

@endsection