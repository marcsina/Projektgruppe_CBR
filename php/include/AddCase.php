<?php
header('Content-Type: text/html; charset=ISO-8859-1');


include_once 'conn.php';
include_once 'conf.php';

if (isset($_POST['krankheit'], $_POST['beschreibung'], $_POST['hiddenkat'])) {
	
	$name = filter_input(INPUT_POST, 'krankheit');
	$text = filter_input(INPUT_POST, 'beschreibung');
	$symptome = filter_input(INPUT_POST, 'hiddenkat'); 

	echo "Hier sind $name";
	echo "Hier sind $symptome";


	$sql = "INSERT INTO Cases (name, text) VALUES ('$name', '$text')";

	/*if ($mysqli->query($sql)) {
		echo "Case erfolgreich der Datenbank hinzugefügt";

		

		$sql = "SELECT id from Cases WHERE name = '$name' LIMIT 1";
		$result = $mysqli->query($sql);
		$caseid = mysqli_fetch_object($result);

		$ersterSplit = explode(';', $symptome);
		/*for ($x = 0; $x < count ($ersterSplit), $x++) {
			$zweiterSplit = explode('|', $ersterSplit[$x]);
			$katid = $zweiterSplit[0];
			$wert = $zweiterSplit[1];
			$sql = "INSERT INTO Cases_Kategorie_Values (caseid,kategorieid,value, wij) VALUES($caseid, $katid, $wert, 0);"
			$mysqli->query($sql);
		}
	}
	else {
		echo "Irgendwie 'n error beim hinzufügen der DB";
	}*/
}
else {
	echo "Fehlerhafte Eingabe";
}



?>