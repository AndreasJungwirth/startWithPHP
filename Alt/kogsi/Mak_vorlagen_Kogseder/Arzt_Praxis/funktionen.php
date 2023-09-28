<?php
// Make Tabelle "Tabelle erstellen" funktion 
function makeTable($query, array $data = NULL)
{
    global $con;
    try {
        $stmt = $con->prepare($query);
        $stmt->execute($data);

        /*Tabelle mit "dynamischer" Spaltenbezeichnung mittels meta-Daten*/
        $meta = array();

        echo '<table class="table">
            <tr>';
        $colCount = $stmt->columnCount();
        for ($i = 0; $i < $colCount; $i++) {
            $meta[] = $stmt->getColumnMeta($i);
            echo '<th>' . $meta[$i]['name'] . '</th>';
        }

        echo '</tr>';

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo '<tr>';
            foreach ($row as $r) {
                echo '<td>' . $r . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } catch (Exception $e) {
        echo 'Error - Tabelle Adressen: ' . $e->getCode() . ': ' . $e->getCode() . '<br>';
    }
    
}
// Nimmt Sql abfragee zb ? und füllt diese dann aus zb. 'INSERT INTO ort (ort_name) VALUES (?)';
//  $array1 = array($ortsname); siehe new ort oder ortinput
// und returnt Tabell
function makeStatement($query, $executeArray = NULL)
{
    global $con;

    $stmt = $con->prepare($query);
    $stmt->execute($executeArray);
    return $stmt;
}
?>