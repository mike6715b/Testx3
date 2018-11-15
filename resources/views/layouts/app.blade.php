<!DOCTYPE html>
<html>
<head>
    <title>Testx3 - Sustav za online provjeru znanja</title>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<header>
    <div class="container">
        <div id="branding">
            <div id="header-logo">
                <a href="{{ route('mainmenu') }}"><img src="{{ asset('img/testx3.png') }}"></a>
            </div>
        </div>
        <div id="login-register">
            @if(\Illuminate\Support\Facades\Auth::check())
                <div id="logout">
                    <form action="{{ route('logout') }}" method="get">
                        <p style="margin-bottom: 0.25em"><br><br><button type="sumbit" name="logout">Logout</button>
                            {{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
                    </form>
                </div>
            @else
                <p><br><br>LOGIN REGISTER</p>
            @endif
        </div>
    </div>

</header><!-- /header -->

@yield('content')

<footer class="container">
    <fieldset id="testx3">
        <legend>Testx3</legend>
        <ul>
            <li>NASLOVNICA</li>
            <li>FAQ</li>
            <li>KONTAKT</li>
        </ul>
    </fieldset>
    <fieldset id="kontakt">
        <legend>Kontakt</legend>
        <ul>
            <li>Prijava problema</li>
            <li>Imate prijedlog? Pisite nam!</li>
            <li>Kontaktirajte nas e-mailom za upite</li>
        </ul>
    </fieldset>
</footer>

</body>
</html>