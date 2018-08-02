@extends('layouts.app')
@section('content')

    @if($user_class == 'admin')
        @include('mainmenu.admin')
    @elseif($user_class == 'teacher')
        @include('mainmenu.teacher')
    @elseif($user_class == 'student')
        @include('mainmenu.student')
    @else
        Error!
    @endif

@endsection
