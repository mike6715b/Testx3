<container class="main-menu" align="center">

    <fieldset>
        <legend>Zadace</legend>
        <table>
            <tbody>
            <tr>
                <td><a href="{{ route('mainmenu.exam') }}"><p>Stvaranje zadace</a></p></td>
                <td><a href="{{ route('mainmenu.examlist') }}"><p>Pisanje zadace</a></p></td>
                <td><a href="{{ route('mainmenu.examresult') }}"><p>Rezultati zadaca</a></p></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>Korisnici</legend>
        <table>
            <tbody>
            <tr>
                <td><a href="{{ route('mainmenu.studadd') }}"><p>Unos ucenika</p></a></td>
                <td><a href="{{ route('mainmenu.classadd') }}"><p>Unos razreda</p></a></td>
                <td><a href="{{ route('mainmenu.studlist') }}"><p>Prikaz ucenika</p></a></td>
                <td><a href="{{ route('mainmenu.teachadd') }}"><p>Unos profesora</p></a></td>
                <td><a href="{{ route('mainmenu.teachlist') }}"><p>Prikaz profesora</p></a></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>Predmeti</legend>
        <table>
            <tbody>
            <tr>
                <td><a href="{{ route('mainmenu.subjadd') }}"><p>Dodaj predmet</p></a></td>
                <td><a href="{{ route('mainmenu.subjlist') }}"><p>Prikaz predmeta</p></a></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend>Gradivo</legend>
        <table>
            <tbody>
            <tr>
                <td><a href="{{ route('mainmenu.fieldadd') }}"><p>Unos novog gradiva</p></a></td>
                <td><a href="{{ route('mainmenu.fieldquesadd') }}"><p>Unos pitanja</p></a></td>
                <td><a href="{{ route('mainmenu.fieldlist') }}"><p>Prikaz gradiva</p></a></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

</container>