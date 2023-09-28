<?php
// Aufbau Datenbank Verbindung
$server = 'localhost:3306'; // 3307 = MariaDB, 3306 oder keine Angabe = MySQL
$user = 'root';
$pwd = '90001';
$db = 'rezept';

try {
    $con = new PDO('mysql:host='.$server.';dbname='.$db.';charset=utf8',
    $user, $pwd);
    // Exception-Handling für PDO muss explizit eingeschaltet werden:
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    echo 'Error - Verbindung: '.$e->getCode().': '.$e->getMessage().'<br>';
}

