<?php
echo '<h2>Neue Person hinzufügen</h2>';
global $con;
if(isset($_POST['save']))
{
    //Daten speichern
    $nname = $_POST['nname'];
    $vname = $_POST['vname'];
    $insertStmt1 = 'insert into person (per_vname,per_nname) values(?,?)';

    try {
        $array1 = array($nname,$vname);
        $stmt = makeStatement($insertStmt1, $array1);
        $strid = $con->lastInsertId();  //liefert Wert, wegen AUto-increment

        echo '<h3>Person wurde erfasst</h3>';

    } catch (Exception $e) {

        switch ($e->getCode()) {
            case 23000:
                echo '<h4>Der Name existiert bereits!</h4>';
                break;

            default:
                echo 'Error - Strasse: '.$e->getCode().': '.$e->getMessage().'<br>';
        }
    }
}else
{
    //Formular anzeigen

    ?>
    <form method="post">
        <label for="strasse">Vorname:</label>
        <input type="text" id="vname" name="vname" placeholder="z.B. Max"><br>
        <label for="strasse">Nachname:</label>
        <input type="text" id="nname" name="nname" placeholder="z.B. Mustermann"><br>

        <br>

        <input type="submit" name="save" value="speichern"><br>
    </form>
    <?php
}