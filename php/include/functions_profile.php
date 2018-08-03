<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once'conf.php';
include 'conn.php';

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

function getCountOfForumPostByUserID($id, $mysqli)
{
	if ($stmt = $mysqli->prepare("SELECT COUNT(id) FROM Forum_Beitrag WHERE user = ?")) 
	{
		$stmt->bind_param('i', $id);
		$stmt->execute();   // Execute the prepared query.
		$stmt->store_result();

		if ($stmt->num_rows == 1) 
		{
			$stmt->bind_result($count);
			$stmt->fetch();
			
			return $count;
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

function checkIfFriendsOrOwnProfile($id1, $id2, $mysqli)
{
	if($id1 == $id2)
	{
		return true;
	}
	if($stmt = $mysqli->prepare("SELECT * FROM friends_member WHERE userID_1 = ? AND userID_2 = ?"))
	{
		$stmt->bind_param('ii', $id1, $id2);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($userID_1, $userID_2);
        $stmt->fetch();

		if($stmt->num_rows == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else 
	{
		return false;	
	}
}

function addFriendByUserID($id1, $id2, $mysqli)
{
	if(checkIfFriendsOrOwnProfile($id1, $id2, $mysqli))
	{
		return false;
	}
	//mit sich selbst befrundet
	/*if($id1 == $id2)
	{
		return false;
	}
	//schon mit einander befreundet
	else if($stmt = $mysqli->prepare("SELECT * FROM friends_member WHERE userID_1 = ? AND userID_2 = ?"))
	{
		$stmt->bind_param('ii', $id1, $id2);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($userID_1, $userID_2);
        $stmt->fetch();

		if($stmt->num_rows == 1)
		{
			return false;
		}		
	}*/
	//nicht mit einander befreundet --> Eintrag wird erstellt
	if ($stmt = $mysqli->prepare("INSERT INTO friends_member (userID_1, userID_2) VALUES (?,?)")) 
	{
		$stmt->bind_param('ii', $id1,$id2);
		if($stmt->execute())   // Execute the prepared query.
		{
			echo "success";
			return true;
		}
		else 
		{
			echo "failure1";
			return false;
		}
	}
	else
	{
		echo "failure2";
		return false;
	}	
}

function deleteFriendByUserID($id1, $id2, $mysqli)
{
	if ($stmt = $mysqli->prepare("DELETE FROM friends_member WHERE userID_1 = ? AND userID_2 = ?")) 
	{
		$stmt->bind_param('ii', $id1,$id2);
		if($stmt->execute())   // Execute the prepared query.
		{
			echo "success";
			return true;
		}
		else 
		{
			echo "failure1";
			return false;
		}
	}
	else
	{
		echo "failure2";
		return false;
	}	
}

function editProfile($mysqli, $firstName, $lastName, $email, $website, $pwd, $confirmpwd)
{

}
/*
//entgegennahme der form_POSTS
if( isset($_POST['editProfile'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['confirmpwd'], $_POST['website']))
{
	//Unnötiges abfangen
	$p1 = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
	$p2 = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
	$p4 = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$p5 = filter_input(INPUT_POST, 'confirmpwd', FILTER_SANITIZE_STRING);
	$p6 = filter_input(INPUT_POST, 'website', FILTER_SANITIZE_URL);

	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
        // keine gültige E-Mail
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

}
*/
if(isset($_POST['addFriend'], $_POST['id1'], $_POST['id2']))
{
	//Unnötiges abfangen
	$p1 = filter_input(INPUT_POST, 'id1', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'id2', FILTER_SANITIZE_NUMBER_INT);
	//aufruf der eigentlichen methode
	addFriendByUserID($p1, $p2, $mysqli);
}

if(isset($_POST['deleteFriend'], $_POST['id1'], $_POST['id2']))
{
	//Unnötiges abfangen
	$p1 = filter_input(INPUT_POST, 'id1', FILTER_SANITIZE_NUMBER_INT);
	$p2 = filter_input(INPUT_POST, 'id2', FILTER_SANITIZE_NUMBER_INT);
	//aufruf der eigentlichen methode
	deleteFriendByUserID($p1, $p2, $mysqli);
}
?>