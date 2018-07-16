<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once'conf.php';

function getUserDataByEmail($email, $mysqli)
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
					"email"=>$email,
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

//untested
function getUserDataByUsername($username, $mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT id, email, vorname, nachname, beschreibung, profilbild FROM members WHERE username = ?")) 
	{
		$stmt->bind_param('s', $username);
        $stmt->execute();   // Execute the prepared query.
        $stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($id, $email, $vorname, $nachname, $beschreibung ,$profilbild);
			$stmt->fetch();
			$res = ["id"=>$id,
					"email"=>$email,
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

//untested
function getUserDataByUsernameGET($mysqli)
{
	if(isset($_GET['username']))
	{
		$username = $_GET['username'];

		if ($stmt = $mysqli->prepare("SELECT id, email, vorname, nachname, beschreibung, profilbild FROM members WHERE username = ?")) 
		{
			$stmt->bind_param('s', $username);
			$stmt->execute();   // Execute the prepared query.
			$stmt->store_result();

			if ($stmt->num_rows == 1) 
			{
				$stmt->bind_result($id, $email, $vorname, $nachname, $beschreibung ,$profilbild);
				$stmt->fetch();
				$res = ["id"=>$id,
						"email"=>$email,
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
	}else
	{
		return false;
	}
}

?>