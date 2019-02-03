<!DOCTYPE html>
<html>
<head>
    <title>Testx3 - Sustav za online provjeru znanja</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/noty.js') }}" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<!-- OLD NAVBAR + HEADER
<header>
    <div class="container">
        <div id="branding">
            <div id="header-logo">
                <a href="{{ route('mainmenu') }}"><h1 id="logo">Testx<sup><span id="num">3</span></sup></h1></a>
            </div>
        </div>
        <br><br><br>
    </div>
</header>
<nav>
    <div id="login-register">
        @if(\Illuminate\Support\Facades\Auth::check())
            <div class="logout">
                <ul>
                    <li><a href="{{ route('mainmenu') }}">Naslovnica</a></li>
                    <li class="dropdown-1">
                        <a href="javascript:void(0)" class="dropbtn">Testovi</a>
                        <div class="dropdown-content">
                            @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
                                <a href="#">Stvaranje zadaca</a>
                            @endif
                            <a href="{{ route('mainmenu.examlist') }}">Dostupne provjere</a>
                            <a href="{{ route('mainmenu.examresult') }}">Rezultati zadace</a>
                        </div>
                    </li>
                    @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
                        <li class="dropdown-1">
                            <a href="javascript:void(0)" class="dropbtn">Korisnici</a>
                            <div class="dropdown-content">
                                @if(Auth::user()->user_class == "admin")
                                    <a href="{{ route('mainmenu.studadd') }}">Dodaj ucenika</a>
                                    <a href="{{ route('mainmenu.classadd') }}">Dodaj razred</a>
                                @endif
                                <a href="{{ route('mainmenu.studlist') }}">Prikaz ucenika</a>
                                @if(Auth::user()->user_class == "admin")
                                    <a href="{{ route('mainmenu.teachadd') }}">Unos profesora</a>
                                    <a href="{{ route('mainmenu.teachlist') }}">Popis profesora</a>
                                @endif
                            </div>
                        </li>
                    @endif
                    @if(Auth::user()->user_class == "admin")
                        <li class="dropdown-1">
                            <a href="javascript:void(0)" class="dropbtn">Predmeti</a>
                            <div class="dropdown-content">
                                <a href="{{ route('mainmenu.subjadd') }}">Dodaj predmet</a>
                                <a href="{{ route('mainmenu.subjlist') }}">Prikaz predmeta</a>
                            </div>
                        </li>
                    @endif
                    @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
                        <li class="dropdown-1">
                            <a href="javascript:void(0)" class="dropbtn">Gradivo</a>
                            <div class="dropdown-content">
                                <a href="{{ route('mainmenu.fieldadd')}}">Unos novog gradiva</a>
                                <a href="{{ route('mainmenu.fieldquesadd') }}">Unos pitanja</a>
                                <a href="{{ route('mainmenu.fieldlist') }}">Prikaz gradiva</a>
                            </div>
                        </li>
                    @endif
                    <li class="dropdown-1">
                        <a href="javascript:void(0)">Korisnik</a>
                        <div class="dropdown-content">
                            <a href="{{ route('logout') }}">Odjava</a>
                            <a href="#">Kontakt</a>
                        </div>
                    </li>
                </ul>
            </div>
        @else
            <nav>
                <ul id="logreg">
                    <a href="{{ route('login') }}"><li>LOGIN</li></a>
                    <a href="{{ route('login') }}"><li>REGISTRACIJA</li></a>
                </ul>
            </nav>
        @endif
    </div>
</nav>
-->


<div class="sidebar">
    <h1 id="logo">Testx<sup><span id="num">3</span></sup></h1>
    @if(\Illuminate\Support\Facades\Auth::check())
        <button class="dropbtn_sweep-to-right">Glavni izbornik</button>
        <div class="dropdown-content">
            <a href="{{ route('mainmenu') }}">&raquo;Naslovnica</a>
            <a href="#">&raquo;Pomoc</a>
            <a href="{{ route('logout') }}">&raquo;Logout</a>
        </div>
        <button class="dropbtn_sweep-to-right">Testovi</button>
        <div class="dropdown-content">
            @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
                <a href="{{ route('mainmenu.exam') }}">&raquo;Stvaranje zadaca</a>
            @endif
            <a href="{{ route('mainmenu.examlist') }}">&raquo;Dostupne zadace</a>
            <a href="{{ route('mainmenu.examresult') }}">&raquo;Provjera rezultata</a>
        </div>
        @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
            <button class="dropbtn_sweep-to-right">Korisnici</button>
            <div class="dropdown-content">
                @if(Auth::user()->user_class == 'admin')
                    <a href="{{ route('mainmenu.studadd') }}">&raquo;Dodaj ucenika</a>
                @endif
                <a href="{{ route('mainmenu.studlist') }}">&raquo;Popis ucenika</a>
                @if(Auth::user()->user_class == "admin")
                    <a href="{{ route('mainmenu.classadd') }}">&raquo;Dodaj razred</a>
                    <a href="{{ route('mainmenu.classlist') }}">&raquo;Popis razreda</a>
                    <a href="{{ route('mainmenu.teachadd') }}">&raquo;Dodaj profesora</a>
                    <a href="{{ route('mainmenu.teachlist') }}">&raquo;Popis profesora</a>
                @endif
            </div>
            <button class="dropbtn_sweep-to-right">Predmeti</button>
            <div class="dropdown-content">
                @if(Auth::user()->user_class == 'admin')
                    <a href="{{ route('mainmenu.subjadd') }}">&raquo;Dodaj predmet</a>
                @endif
                <a href="{{ route('mainmenu.subjlist') }}">&raquo;Popis predmeta</a>
            </div>
        @endif
        @if(Auth::user()->user_class == 'teacher' || Auth::user()->user_class == "admin")
            <button class="dropbtn_sweep-to-right">Gradivo</button>
            <div class="dropdown-content">
                <a href="{{ route('mainmenu.fieldadd') }}">&raquo;Unos novog gradiva</a>
                <a href="{{ route('mainmenu.fieldquesadd') }}">&raquo;Unos pitanja</a>
                <a href="{{ route('mainmenu.fieldlist') }}">&raquo;Popis gradiva</a>
            </div>
        @endif
    @else
        <button class="dropbtn_sweep-to-right">Pocetno</button>
        <div class="dropdown-content">
            <a href="{{ route('mainmenu') }}">&raquo;Naslovnica</a>
            <a href="#">&raquo;Pomoc</a>
            <a href="{{ route('login') }}">&raquo;Login</a>
        </div>
    @endif
</div>

<section id="content">
    @yield('content')
</section>

<!--
                <div class="logout">
                    <ul>
                        <li>Naslovnica</li>
                        <li>Pomoc</li>
                        <li class="dropdown-1">
                            <a href="javascript:void(0)" class="dropbtn">Upsravljanje testovima</a>
                            <div class="dropdown-content">
                                <a href="#">Stvaranje zadaca</a>
                                <a href="#">Samoprovjera</a>
                                <a href="#">Provjera znanja</a>
                            </div>
                        </li>
                        <div id="logoutusr">
                            <li>Logout</li>
                            <li>Korisnik?</li>
                        </div>
                    </ul>
                </div>
-->

<!-- OLD FOOTER
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
-->

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropbtn_sweep-to-right");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
</body>
</html>