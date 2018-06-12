<?php
header('Content-Type: text/html; charset=ISO-8859-1');


include_once 'conn.php';
include_once 'conf.php';

if (isset($_POST['krankheit'], $_POST['beschreibung'])) {
	
	$name = filter_input(INPUT_POST, 'krankheit');
	$text = filter_input(INPUT_POST, 'beschreibung');

	$sql = "INSERT INTO Cases (name, text) VALUES ('$name', '$text')";

	if ($mysqli->query($sql)) {
		echo "Case erfolgreich der Datenbank hinzugefügt";
	}
	else {
		echo "Irgendwie 'n error beim hinzufügen der DB";
	}
}
else {
	echo "Fehlerhafte Eingabe";
}



?>