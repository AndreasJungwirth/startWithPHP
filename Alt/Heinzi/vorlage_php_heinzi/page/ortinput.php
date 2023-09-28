<form method="POST">

    <?php

    echo '<h1>Ort Hinzufügen</h1>';
    if(isset($_POST['save']) || isset($_POST['ja']))
    {
        $query = 'select * from ort where ort_name = ?';
        $ort = $_POST['ort'];
        $array = array($ort);
        $count = makeStatement($query, $array)->rowCount();
        if($count === 1)
        {
            echo 'Der Ort '.$ort.' exestiert bereits';
        }
        else
        {
            if(isset($_POST['ja']))
            {
                $query = "insert into ort(ort_name) values (?)";
                makeStatement($query, $array);
                echo 'Ort '.$ort.' hinzugefügt';
            }
            else
            {
                echo 'Wollen sie den Ort "'.$ort.'" wirklich hinzufügen?<br>';
                echo '<input type="submit" name="ja" value="Ja">';
                echo '<input type="submit" name="nein" value="Nein">';
                echo '<input type="hidden" name="ort" value="'.$ort.'">';
            }
        }

    }else

    {

    ?>
    <label for="ort">Ort Hinzufügen: </label>
    <input type="text" id="ort" name="ort" placeholder="z.B. Wels" required>

    <input type="submit" name="save" value="Speichern">

</form>




<?php

// Ort Tabelle

$query = 'select ort_id as "ID", ort_name as "Ort" from ort';


global $con;

try{

    $stmt = $con->prepare($query);
    $stmt->execute();
    //Tabelle mit 'dynamischer' Spaltenbezeichnung mittels meta-Daten
    $meta = array();
    echo '<table class="table">
                <tr>';
    $colCount = $stmt->columnCount();
    for ($i=0; $i < $colCount; $i++) {
        $meta[] = $stmt->getColumnMeta($i);
        echo '<th>'.$meta[$i]['name'].'</th>';

    }

    echo '</tr>';
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {



        if ($row[0] == $_SESSION['last_id']??null)
        {
            echo '<tr style="color:red">';
            foreach ($row as $r ) {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';

        }
        else
        {
            echo '<tr>';
            foreach ($row as $r ) {
                echo '<td>'.$r.'</td>';
            }
            echo '</tr>';

        }

    }
    echo '</table>';
}
catch(Exception $e)
{
    echo 'Error - Tabelle Adresse: '.$e->getCode().': '.$e->getMessage().'<br>';
}
}

?>
