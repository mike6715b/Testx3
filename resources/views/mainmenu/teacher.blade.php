<container class="main-menu" align="center">

    <fieldset>
        <legend align="left">Zadace</legend>
        <table>
            <tbody>
            <tr>
                <td><p><a href="{{ route('mainmenu.exam') }}">Stvaranje zadace</a></p></td>
                <td><p><a href="{{ route('mainmenu.examlist') }}">Pisanje zadace</a></p></td>
                <td><p><a href="{{ route('mainmenu.examresult') }}">Rezultati zadace</a></p></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

    <fieldset>
        <legend align="left">Ucenik</legend>
        <table>
            <tbody>
            <tr>
                <td><p><a href="{{ route('mainmenu.studlist') }}">Popis ucenika</a></p></td>
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