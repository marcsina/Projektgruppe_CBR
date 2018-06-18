<?php
header('Content-Type: text/html; charset=ISO-8859-1');


include_once 'conn.php';
include_once 'conf.php';


// Anzahl Fragen herausfinden und Zufallsnummer bestimmen
$numb_fragen;
$randomNumber;
$sql="SELECT count(*) as total from Quiz_Fragetexte";
$result = $mysqli->query($sql);
		while($row = $result->fetch_assoc()) {
			$numb_fragen = (int)$row["total"];
		}
$randomNumber = rand(0,$numb_fragen-1);

// Frage anhand der Zufallsnummer aus der Datenbank laden
$numb_fragen = 1;
$sql="SELECT text FROM Quiz_Fragetexte ORDER BY id LIMIT 1 OFFSET $randomNumber";
$result = $mysqli->query($sql);
		while($row = $result->fetch_assoc()) {
			$frage = $row["text"];
			echo utf8_decode($frage);
		}
?>