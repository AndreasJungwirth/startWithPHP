<?php
 global $con;
 $nname = "";
 $vname = "";
 
 
 if (count($_POST) > 0) {
	$vname = $_POST['vorname'];
    $nname = $_POST['nachname'];
}

 ?>

 <form method="post">
    <h3>Namen eingeben: </h3>
    <input type="text" id="vorname" name="vorname" placeholder="Vorname" value="<?php echo $vname ?>">
    <input type="text" id="nachname" name="nachname" placeholder="Nachname" value="<?php echo $nname ?>">
    <br>
    <input type="submit" name="show" value="show">
 </form>
 <ul>
<?php
   
        $query = 'select Vorname, Nachname, Emailadresse, Titel, Beschreibung from
        tbl_rezepte inner join tbl_user ON tbl_rezepte.FIDUser = IDUser where
        tbl_user.Vorname LIKE "%'.$vname.'%" AND tbl_user.Nachname LIKE "%'.$nname.'%"
        ORDER BY tbl_user.Nachname, tbl_user.Vorname';
    
        $rezQuery = makeStatement($query);
        $result = $rezQuery->fetchAll();

        foreach($result as $rezept){
            $beschreibung = $rezept["Beschreibung"] ?? "Keine Beschreibung";
            echo ("
					<li>
						<p>{$rezept["Vorname"]} {$rezept["Nachname"]} ({$rezept["Emailadresse"]}):</p>
						<p>{$rezept["Titel"]}: {$beschreibung}</p>
					</li>
				");
        }
        ?>
	</ul>
    

 

    
    