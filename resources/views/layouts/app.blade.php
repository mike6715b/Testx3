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
        <div id="info">
            <ul>
                <li>Bruno Rehak</li>
                <li>Vinka Rehaka 17, 34550 Pakrac</li>
                <li>tel: 034/438-421, mob:095/812/1448, <a href="http://www.mike6715b.com">www.mike6715b.com</a></li>
            </ul>
        </div>
    </div>
    <div class="status">
        @if(\Illuminate\Support\Facades\Auth::check())
            <div id="logout">
                <form action="{{ route('logout') }}" method="get">
                    <p style="margin-bottom: 0.25em"><button type="sumbit" name="logout">Logout</button>
                        {{ \Illuminate\Support\Facades\Auth::user()->user_name }}</p>
                </form>
            </div>
        @else
        @endif
    </div>
</header><!-- /header -->

@yield('content')

</body>
</html>