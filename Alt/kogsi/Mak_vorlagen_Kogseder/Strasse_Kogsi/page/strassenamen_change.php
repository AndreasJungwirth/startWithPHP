<?php
echo '<h1>Strassen - Change</h1>';
// Existierenter Strassennamen in der Datenbank ändern durch ein Update statement


echo '<br>';

$selectstmt ='select str_id from adresse.strasse where str_name = ?';
$updatestmt = 'UPDATE adresse.strasse set str_name = ? where str_id= ?';

if (isset($_POST['change'])){

    global $con;
    $stroldname = $_POST['stroldname'];
    $strasnewname = $_POST['strasnewname'];

    $query1 = 'UPDATE adresse.strasse SET str_name = ? where str_id = ?';

    $stmt2 = $con-> prepare($query1);
    $stmt2->execute([ $strasnewname, $stroldname]);

// Ausgabe der Meldung das der Neue Strassenname in der DB auf den neunen eigegebenen Namen umgeschrieben wurde
    echo '<br>Strassenname geändert<br>';

} else {
    // Formular anzeigen
    // Auswahl durch ein Dropdown welcher vorhandene Strassennamen in der Datenbank auf einen neuen geändert werden soll
    ?>
    <form method="POST">
        <label for="strassenname">
            Bestehende Straßennamen ändern:
        </label>
        <?php
        global $con;
        $query =    'select str_id, str_name from adresse.strasse';
        $stmt = $con-> prepare($query);
        $stmt->execute();
        echo '<br><select name="stroldname">';
        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<option value="'.$row[0].'">'.$row[1];
        }
        echo '</select>';
        ?>
        <!-- Eingabe durch ein Textfeld auf was der alte Strassennamen in der Datenbank geändert werden soll --->
        <br>
        <label for="strasnewname">
            Neuen Namen eingeben:
        </label>
        <input type="text" id="strasnewname" name="strasnewname" placeholder="z.B. Wiener Strasse" required>
        <br>
        <input type="submit" name="change" value="Ändern">
    </form>
    <?php
}
