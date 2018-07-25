<!DOCTYPE html>
<html>
<head>
    <title>Testx3 - Sustav za online provjeru znanja</title>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

</head>
<body>
<style>
    body{
        font: 15px/1.5 Arial, Helvetica,sans-serif;
        padding:0;
        margin:0;
        background-color:#dbdbdb;
    }

    /* Global */
    .container{
        width:80%;
        margin:auto;
        overflow:hidden;
    }

    ul{
        margin:0;
        padding:0;
    }

    container {
        width: 50%;
        margin: auto;
        text-align: left;
    }
    /* --GLOBAL */

    /* Header */
    header {
        background:#35424a;
        color:#ffffff;
        padding-top:10px;
        min-height:100px;
        border-bottom:#e8491d 3px solid;
    }

    header #header-logo {
        float:left;
    }

    header ul {
        text-align:right;
        float:right;
        margin-right: 0;
        padding-right: 0;
    }

    header li {
        color: #e87b1d;
        display: block;
    }

    header a {
        color:#e87b1d;
        text-decoration: none;
    }

    header #info {
        margin-top:5px;
        text-align: right;
    }

    /* --Header */

    #main-menu {
        text-decoration: none;
    }

    .login-form{
        margin-top: 100px;
        padding-top: 20px;
        padding-bottom: 20px;
        white-space: nowrap;
        overflow: hidden;

    }

    .login-table {
        background-color: #c1c1c1;
        width: 500px;
        padding-top: 20px;
        padding-bottom: 20px;
        border: 2px solid #e8491d;
        border-radius: 20px;
    }

    .login-table button {
        background-color: #fff;
        border: 1px solid #e8491d;
        border-radius: 5px;
    }

    .main-menu #main-menu {
        margin: auto;
        text-align: left;
    }

    .main-menu fieldset{
        border-color: #e8491d;
        border-radius: 5px;
        width: 500px;
        margin: auto;
        margin-top: 7px;
        background-color: #c4c4c4;
    }

    .main-menu fieldset legend {
        border: 2px solid #e8491d;
        border-radius: 5px;
        background-color: #dbdbdb;
    }

    .main-menu table tbody tr td {
        padding-right: 10px;
    }

    .add-student fieldset form input{
        display: block;
    }

    .fieldview td {
        text-align: center;
        aalign: center;
    }
</style>
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