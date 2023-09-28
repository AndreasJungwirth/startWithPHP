<?php
global $con;
echo '<h2>Person ändern</h2>';
if(isset($_POST['save']))
{
    //Daten speichern
    $personId = $_POST['personId'];
    $personV = $_POST['personV'];
    $personN = $_POST['personN'];
    $updateStmt1 = 'update person set per_vname = ?, per_nname = ? where per_id = ?';

    try {
        $array1 = array($personV,$personN, $personId);
        $stmt = makeStatement($updateStmt1, $array1);

        echo '<h3>Person wurde umbenannt</h3>';

    } catch (Exception $e) {

        switch ($e->getCode()) {
            case 23000:
                echo '<h4>Der Name existiert bereits!</h4>';
                break;

            default:
                echo 'Error - Person: '.$e->getCode().': '.$e->getMessage().'<br>';
        }
    }
}else
{
    //Formular anzeigen

    ?>
    <form method="post">
        <label>Person auswählen:</label>

        <?php

        $query='select per_id ,CONCAT(per_nname, " ", per_vname) as Name from Person';
        $stmt= $con->prepare($query);
        $stmt->execute();

        echo '<select name="personId">';
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<option value = "'.$row[0].'">'.$row[1];
        }

        ?>
        </select>

        <label>Neuer Name:</label>
        <input type="text" id="personV" name="personV" placeholder="z.B. Max"><br>
        <input type="text" id="personN" name="personN" placeholder="z.B. Mustermann"><br>

        <input type="submit" name="save" value="speichern"><br>
    </form>
    <?php
}