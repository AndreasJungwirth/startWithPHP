<?php
echo '<h1>Strassen</h1>';
// Neuen Strassennamen in der Datenbank anlegen mit INSERT statement

echo '<br>';

if (isset($_POST['save'])){
    //Daten speichern
    global $con;
    $orplid = $_POST['orplid'];
    $strasse = $_POST['strasse'];
    $insertStmt1 = 'INSERT INTO adresse.strasse (str_name) VALUES (?)';
    $insertStmt2 = 'INSERT INTO adresse.strasse_ort_plz VALUES (?, ?)';

    try {
 // Ausgabe der Meldung das der Neue Strassenname in der DB angelegt wurde

        $array1 = array($strasse);
        $stmt = makeStatement($insertStmt1, $array1);
        $strid = $con->lastInsertId();

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
// Eingabe des Neuen Strassennamen der Datenbank angelegt werden soll
    ?>
    <form method="POST">
        <label for="strasse">
            Straßenname:
        </label>
            <br>
        <input type="text" id="strasse" name="strasse" placeholder="z.B. Wiener Strasse" required <br>

        <?php
        global $con;
        $query =    'select orpl_id, plz_nr as "PLZ", ort_name as "ort" 
                        from ort_plz natural join (ort, plz) 
                        order by ORT';
        $stmt = $con-> prepare($query);
        $stmt->execute();

        // Eingabe durch ein Dropdown wo der neue Strassennamen in der Datenbank angelgt werden soll
        echo '<br><br>
        <p>Wo:<br>
        <select name="orplid">';
        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2];
        }
        echo '</p></select>';
        ?>
        <script>
          document.getElementById('showTableBtn').addEventListener('click', function() {
    document.getElementById('tableContainer').style.display = 'block';
  });
</script>
<br><br>
        <input type="submit" name="save" value="Speichern">
    </form>
    <?php
}

?>
