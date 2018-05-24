<?php

//Datenbankverbindung aufbauen
$mysqli = new mysqli("localhost", "medausbild", "dpDtTC2AwzzUbFXu", "CBR");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset("utf8");


?>