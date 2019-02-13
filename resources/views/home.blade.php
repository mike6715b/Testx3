@extends('layouts.app')

@section('content')
    <section class="home">
        <h1 id="branding" align="center">Testx<sup><span id="num">3</span></sup></h1>
        <p id="short-abot" align="center">Sustav za online provjeru znanja</p>
        <div class="home-row">
            <div class="home-column">
                <img src="{{ asset('img/click-finger.png') }}" alt="Brzo i jednostavno">
                <h2 align="center">Brzo i jednostavno</h2>
                <p align="center">Brzo i jednostavno postaljvanje uz samo par klikova i spremni se da pravite nove provjere znanja za vaše učenike!</p>
            </div>
            <div class="home-column">
                <img src="{{ asset('img/cloud.png') }}" alt="Oblak">
                <h2 align="center">Sve u oblaku</h2>
                <p align="center">Sve je u oblaku, pa možete od kuće, iz škole, sa mora ili iz inozemstva pristupiti i učiti kroz online provjere znanja.</p>
            </div>
            <div class="home-column">
                <img src="{{ asset('img/progress-icon-21.jpg') }}" alt="Pratite napredak">
                <h2 align="center">Pratite napredak učenika</h2>
                <p align="center">Pratite kako vaši učenici napreduju kroz zadatke koje im zadajete kroz samoprovjere ili ocjenite njihovo znanje sa provjerama znanja.</p>
            </div>
        </div>

    </section>

    <script>
        new Noty({
            text: "Uspjeh! YAY",
            type: "success",
            layout: "topRight",
            theme: "relax",
            timeout: 3000,
            progressBar: true,
        }).show();
    </script>
@endsection
