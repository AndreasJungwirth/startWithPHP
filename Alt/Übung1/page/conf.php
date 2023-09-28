<?php
//Verbindung zur Datenbank
$server = 'localhost:3306';
$user = 'root';
$pwd = 'root';
$db = 'adresse';

try{
$con = new PDO('mysql:hsot='.$server.';dbname='.$db.';charset=utf8',$user, $pwd);
// Exception-Handling für PDO muss expliziet eingeschaltet werden
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
echo 'Error - Verbindung: '.$e->getCode().': '.$e->getMessage().'<br>';
}