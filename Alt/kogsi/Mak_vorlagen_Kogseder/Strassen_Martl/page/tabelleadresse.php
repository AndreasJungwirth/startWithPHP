<?php

// Anzeige aller Adressen einfache TABLE ausgabe
echo '<h1>Adressen</h1>';

$query = 'select plz_nr as "PLZ", 
        ort_name as "Ort",
        str_name as "Strasse"
        from strasse_ort_plz natural join ort_plz natural join strasse natural join ort natural join plz';

makeTable($query);

echo '<h2>Alle Personen mit Vollständiger Adresse anzeigen</h2>';

echo '<br>';

$query= 'select 
concat(per_vname,\' \',per_nname) as "Person",
plz_nr as "PLZ", 
ort_name as "Ort",
str_name as "Strasse"
from strasse_ort_plz natural join ort_plz natural join strasse natural join ort natural join plz
natural join person_strasse_ort_plz natural join person;';
    makeTable($query);
