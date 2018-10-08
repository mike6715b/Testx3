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
        <div id="logout">
            <form action="{{ route('logout') }}" method="get">
                <button type="sumbit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</header><!-- /header -->

@yield('content')

</body>
</html>