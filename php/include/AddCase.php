<?php
header('Content-Type: text/html; charset=ISO-8859-1');


include_once 'conn.php';
include_once 'conf.php';

if (isset($_POST['krankheit'], $_POST['beschreibung'], $_POST['hiddenkat'])) {
	
	$name = filter_input(INPUT_POST, 'krankheit');
	$text = filter_input(INPUT_POST, 'beschreibung');
	$symptome = filter_input(INPUT_POST, 'hiddenkat'); 

	$sql = "INSERT INTO Cases (name, text) VALUES ('$name', '$text')";

	if ($mysqli->query($sql)) {
		echo "Case erfolgreich der Datenbank hinzugef�gt";

		$sql = "SELECT id from Cases WHERE name = '$name' LIMIT 1";
		$result = $mysqli->query($sql);
		while($row = $result->fetch_assoc()) {
			$caseid = (int)$row["id"];
			echo $caseid;
		}

		$ersterSplit = explode(';', $symptome);		

		for ($x = 0; $x < count($ersterSplit); $x++) {			
			$zweiterSplit = explode('|', $ersterSplit[$x]);

			$katid = $zweiterSplit[0];
			$wert = $zweiterSplit[1];
			$sql = "INSERT INTO Cases_Kategorie_Values (caseid,kategorieid,value, wij) VALUES($caseid, $katid, $wert, 0);";
			if ($mysqli->query($sql)) {			
				echo "Kein Problem beim Hinzuf�gen der Werte";
			}
			else {
				echo "Hinzuf�gen von Werten gab einen Fehler";
			}
		}
	}
	else {
		echo "Irgendwie 'n error beim hinzuf�gen der DB";
	}
}
else {
	echo "Fehlerhafte Eingabe";
}



?>