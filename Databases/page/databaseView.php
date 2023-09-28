<?php
global $con;
echo '<h2>Datenbank auswählen</h2>';
session_start();

if (isset($_POST['save']) || isset($_POST['showContent']) ) {
   
    if(isset($_POST['dataId'])){
        $_SESSION['dataID'] = $_POST['dataId'];
    }


    if(isset($_POST['save'])){
    $query1 = "USE " . $_SESSION['dataID'];
    try {
        $stmt = makeStatement($con, $query1);

        $query2 = 'SHOW TABLES';
        $stmt = makeStatement($con, $query2);

        echo '<h4>Tabellen:</h4>';
        echo '<form method="post">';
        echo '<label>Tabelle auswählen:</label>';
        echo "<select name='tableId' id='tableId'>";
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
        }
        echo "</select>";
        echo '<br>';
        echo '<input type="submit" name="showContent" value="Inhalte anzeigen"><br>';
        echo '</form>';
    } catch (Exception $e) {
        switch ($e->getCode()) {
            default:
                echo 'Error - Database: ' . $e->getCode() . ': ' . $e->getMessage() . '<br>';
        }
    }
}else{
        $tableId = $_POST['tableId'];
        $query3 = "select * from ". $_SESSION['dataID'] .".". $tableId;
        makeTable($query3);
    }
} else {
    ?>
    <form method="post">
        <label>Datenbank auswählen:</label>
        <?php
        $query = 'SHOW DATABASES';
        $stmt = makeStatement($con, $query);

        echo "<select name='dataId' id='dataId'>";
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
        }
        echo "</select>";
        ?>
        <br>
        <input type="submit" name="save" value="Speichern"><br>
    </form>
    <?php
}
?>



