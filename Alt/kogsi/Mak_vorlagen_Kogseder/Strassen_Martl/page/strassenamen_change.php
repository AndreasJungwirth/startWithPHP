<?php
echo '<h1>Strassen - Change</h1>';
// Existierenter Strassennamen in der Datenbank ändern durch ein INSERT statement

echo '<br>';

if (isset($_POST['save'])){
    //Daten speichern
    global $con;
    $orplid = $_POST['orplid'];
    $strasse = $_POST['strasse'];
    $insertStmt1 = 'INSERT INTO adresse.strasse (str_name) VALUES (?)';
    $insertStmt2 = 'INSERT INTO adresse.strasse_ort_plz VALUES (?, ?)';

    try {
        $array1 = array($strasse);
        $stmt = makeStatement($insertStmt1, $array1);
        $strid = $con->lastInsertId();

         // Ausgabe der Meldung das der Neue Strassenname in der DB auf den neunen eigegebenen Namen umgeschrieben wurde
        $array2 = array($strid, $orplid);
        $stmt2=makeStatement($insertStmt2, $array2);
        echo '<h3>Strasse wurde erfasst</h3>';

    } catch (Exception $e) {
        switch ($e->getCode()) {
            case
            23000:
             // Ausgabe der Meldung das der Name schon in der DB existiert
                echo '<h4>Der Straßenname existiert bereits!</h4>';
                break;
            default:
                echo 'Error - Strasse: '.$e->getCode().': '.$e->getMessage().'<br>';
        }
    }

} else {
    // Formular aneigen
    ?>
        <?php
        global $con;
        $query =    'select orpl_id, plz_nr as "PLZ", ort_name as "ort" 
                        from ort_plz natural join (ort, plz) 
                        order by ORT';
        $stmt = $con-> prepare($query);
        $stmt->execute();

// Auswahl durch ein Dropdown welcher vorhandene Strassennamen in der Datenbank auf einen neuen geändert werden soll
        echo '<p>Straßenname der Geändert werden soll:<br>
        <select name="orplid">';
        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2];
        }
        echo '</p></select>';
        ?>
<!-- Eingabe durch ein Textfeld auf was der alte Strassennamen in der Datenbank geändert werden soll --->
    <form method="POST">
        <label for="strasse">
            Ändern auf:
        </label>
        <br>
        <input type="text" id="strasse" name="strasse" placeholder="z.B. Wiener Strasse" required <br>

        <br><br>
        <input type="submit" name="save" value="Ändern">
    </form>
    <?php
}

?>
