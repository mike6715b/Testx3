<!DOCTYPE html>
<html>
<head>
    <title>Testx3 - Sustav za online provjeru znanja</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/noty.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/noty.js') }}" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140416731-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-140416731-1');
    </script>

</head>
<body>
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
                    <a href="{{ route('mainmenu.studlist') }}">&raquo;Popis ucenika</a>
                    <a href="{{ route('mainmenu.classadd') }}">&raquo;Dodaj razred</a>
                @endif
                <a href="{{ route('mainmenu.classlist') }}">&raquo;Popis razreda</a>
                @if(Auth::user()->user_class == "admin")
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