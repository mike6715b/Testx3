@extends('layouts.app')

@section('content')
    <style>
        footer {
            position: absolute;
            bottom: 0;
        }
    </style>

    <container class="login-form">
        <form action="{{ action('LoginController@login') }}" method="POST">
            <ul align="center" style="column-count: 2; margin: auto; padding: auto">
                <div>
                    <li style="display: inline; column-span: 1;">Korisnicko ime:</li>
                    <li style="display: inline; columns: 2;"><input name="username" type="text" size="30" style="width: 189px"></li>
                </div>
                <div>
                    <li style="display: inline; column-span: 1;">Lozinka:</li>
                    <li style="display: inline; columns: 2;"><input name="password" type="password" size="30" style="width: 189px"></li>
                </div>
            </ul>
        </form>
    </container>

@endsection

<container class="login">
    <div align="center" class="login-form">
        <form action="{{ action('LoginController@login') }}" method="POST" id="login-form">
            @csrf
            <div class="login-table">
                <table width="300" border="0" cellspacing="0" cellpadding="3">
                    <tbody id="tbody-login">
                    <tr>
                        <td align="right">Korisničko ime:</td>
                        <td><input name="username" type="text" size="30" style="width: 189px;"></td>
                    </tr>
                    <tr>
                        <td align="right">Lozinka:</td>
                        <td><input name="password" type="password" size="30" style="width: 189px;"></td>
                    </tr>
                    </tbody></table>
                <input type="submit" name="submit" align="right" form="login-form" value="Prijavi me">
            </div>
        </form>
    </div>
</container>