@extends('layouts.app')
@section('content')

    @if(Auth::user()->user_class == 'admin')
        @include('mainmenu.admin')
    @elseif(Auth::user()->user_class == 'teacher')
        @include('mainmenu.teacher')
    @elseif(Auth::user()->user_class == 'student')
        @include('mainmenu.student')
    @else
        Error!
    @endif

@endsection
