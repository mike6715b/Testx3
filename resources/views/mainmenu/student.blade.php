<style>
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
</style>

<container id="main-menu" align="center">

    <fieldset>
        <legend align="left">Zadace</legend>
        <table>
            <tbody>
            <tr>
                <td><p><a href="{{ route('mainmenu.examlist') }}">Kontrolne zadace</a></p></td>
                <td><p><a href="{{ route('mainmenu.examresult') }}">Samoprovjere</a></p></td>
            </tr>
            </tbody>
        </table>
    </fieldset>

</container>