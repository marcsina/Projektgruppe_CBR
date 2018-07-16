<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once'conf.php';

function getUserDataByEmail2($email, $mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT id, username, vorname, nachname, beschreibung, profilbild FROM members WHERE email = ?")) 
	{
		$stmt->bind_param('s', $email);
        $stmt->execute();   // Execute the prepared query.
        $stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($id, $username, $vorname, $nachname, $beschreibung ,$profilbild);
			$stmt->fetch();
			$res = ["id"=>$id,
					"username"=>$username,
					"vorname"=>$vorname,
					"nachname"=>$nachname,
					"beschreibung"=>$beschreibung,
					"profilbild"=>$profilbild];
			return $res;
		}
		else
		{
			return false;
		}
	}else
	{
		return false;
	}
}

function getUserDataByEmail($email, $mysqli)
{
	$sqlStmt = "SELECT id, username, vorname, nachname, beschreibung, profilbild FROM members WHERE email = '$email';";

	$result =  mysqli_query($mysqli,$sqlStmt);

	$data = array();
	try
	{
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
			return $email;
		}
	}catch(Exception $e)
	{
		$res = "Exception ".$e;
		return $res;
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