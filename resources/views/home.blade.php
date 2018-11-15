@extends('layouts.app')

@section('content')
<section class="home">
    <div id="short-about">
        <h1>Sustav za online provjeru znanja</h1>
        <p>Izradite online testove za svoje ucenike!</p>
        <fieldset>
            <ul>
                <li>jednostavna i brza izrada provjere znanja</li>
                <li>odabir razlicitih vrsta pitanja</li>
                <li>Automatska provjera odgovora</li>
                <li>Zadaci za samoprovjeru</li>
                <li>Prilagoden za sve uredaje</li>
                <li>Stalna podrska</li>
            </ul>
        </fieldset>
    </div>
    <fieldset class="forms-fieldset" id="forms-fieldset">
        <div id="login-form">
            <fieldset id="login-form">
                <legend align="left">Prijava</legend>
                <form action="{{ action('LoginController@login') }}" method="POST" id="login-form">
                    @csrf
                    <div class="login-table">
                        <table>
                            <tbody id="tbody-login"><tr>
                                <td align="right">Korisničko ime:</td>
                                <td><input name="username" type="text" size="30" style="width: 189px;"></td>
                            </tr>
                            <tr>
                                <td align="right">Lozinka:</td>
                                <td><input name="password" type="password" size="30" style="width: 189px;"></td>
                            </tr>
                            </tbody></table>
                        <button type="submit" name="submit">Prijavi me</button>
                    </div>
                </form>
            </fieldset>
        </div>
        <div id="register-option">
            <fieldset id="register-option">
                <legend>Registriraj se</legend>
                <p>Ako jos nemas racun, pritisni gumb ispod i prijavi se za svoj racun!</p>
            </fieldset>
        </div>
    </fieldset>
</section>
@endsection
