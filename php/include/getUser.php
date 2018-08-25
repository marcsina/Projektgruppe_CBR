<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

if(isset($_POST['email']))
{
	$email = filter_input(INPUT_POST, 'email');
	

	$sqlStmt = "SELECT id, username, vorname, nachname, beschreibung, profilbild FROM members WHERE email = '$email';";

	$result =  mysqli_query($mysqli,$sqlStmt);

	$data = array();

	if ($result = $mysqli->query($sqlStmt)) 
	{
		while ($row = $result->fetch_assoc()) 
		{
			$id = $row["id"];
			$username = $row["username"];
			$vorname = $row["vorname"];
			$nachname = $row["nachname"];
			$beschreibung = $row["beschreibung"];
			$profilbild = $row["profilbild"];

			array_push($data,array("id"=>$id,"username"=>$username,"vorname"=>$vorname,"nachname"=>$nachname,"beschreibung"=>$beschreibung,"profilbild"=>$profilbild));  
		}
            
		// Objekt freigeben
		$result->free();
	}
        
  
	// Ausgabe
	foreach ($data as $d)
	{
		$id = $d["id"];
		$username = $d["username"];	
		$vorname = $d["vorname"];	
		$nachname = $d["nachname"];	
		$beschreibung = $d["beschreibung"];	
		$profilbild = $d["profilbild"];	
            
		echo utf8_decode("$id;separator;$username;separator;$vorname;separator;$nachname;separator;$beschreibung;separator;$profilbild");
	}
	mysqli_close($mysqli);
}
        

?>