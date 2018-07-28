@extends('layouts.app')
@section('content')

    @if(\Illuminate\Support\Facades\Session::get('user_class') == 'admin')
        @include('mainmenu.admin')
    @elseif(\Illuminate\Support\Facades\Session::get('user_class') == 'teacher')
        @include('mainmenu.teacher')
    @elseif(\Illuminate\Support\Facades\Session::get('user_class') == 'student')
        @include('mainmenu.student')
    @endif

@endsection
