<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once'conf.php';

function getUserDataByEmail($email, $mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT id, username, vorname, nachname, beschreibung, profilbild, website FROM members WHERE email = ?")) 
	{
		$stmt->bind_param('s', $email);
        $stmt->execute();   // Execute the prepared query.
        $stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($id, $username, $vorname, $nachname, $beschreibung ,$profilbild, $website);
			$stmt->fetch();
			$res = ["id"=>$id,
					"email"=>$email,
					"username"=>$username,
					"vorname"=>$vorname,
					"nachname"=>$nachname,
					"beschreibung"=>$beschreibung,
					"profilbild"=>$profilbild,
					"website"=>$website];

			if(empty(res['id']))
			{
				//Nutzer nicht vorhanden
				return false;
			}
			else
			{
				return $res;
			}
		}
		else
		{
			//DB Fehler
			return false;
		}
	}else
	{
		//DB Fehler
		return false;
	}
}

function getUserDataByUsername($username, $mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT id, email, vorname, nachname, beschreibung, profilbild, website FROM members WHERE username = ?")) 
	{
		$stmt->bind_param('s', $username);
        $stmt->execute();   // Execute the prepared query.
        $stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($id, $email, $vorname, $nachname, $beschreibung ,$profilbild, $website);
			$stmt->fetch();
			$res = ["id"=>$id,
					"email"=>$email,
					"username"=>$username,
					"vorname"=>$vorname,
					"nachname"=>$nachname,
					"beschreibung"=>$beschreibung,
					"profilbild"=>$profilbild,
					"website"=>$website];
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

function getUserDataByUsernameGET($mysqli)
{
	if(isset($_GET['username']))
	{
		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);

		if ($stmt = $mysqli->prepare("SELECT id, email, vorname, nachname, beschreibung, profilbild, website FROM members WHERE username = ?")) 
		{
			$stmt->bind_param('s', $username);
			$stmt->execute();   // Execute the prepared query.
			$stmt->store_result();

			if ($stmt->num_rows == 1) 
			{
				$stmt->bind_result($id, $email, $vorname, $nachname, $beschreibung ,$profilbild, $website);
				$stmt->fetch();
				$res = ["id"=>$id,
						"email"=>$email,
						"username"=>$username,
						"vorname"=>$vorname,
						"nachname"=>$nachname,
						"beschreibung"=>$beschreibung,
						"profilbild"=>$profilbild, 
						"website"=>$website];
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
	}else
	{
		return false;
	}
}

?>