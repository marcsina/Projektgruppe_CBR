<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getAllFriends($mysqli, $currentUser)
{
	
	$resultarray = array();
	if($stmt = $mysqli->prepare("SELECT `USER_ID1`, members.username FROM `Follower`, members WHERE `USER_ID2` = ? AND `USER_ID1` = members.id;"))
	{
		$stmt->bind_param('i', $currentUser);
        $stmt->execute();
        $stmt->store_result();
		$dataid1 = array();

		$stmt->bind_result($id1, $username);

		while ($stmt->fetch())
        {
			array_push($dataid1,array("id1"=>$id1, "username"=>$username));
        }

		if($stmt = $mysqli->prepare("SELECT `USER_ID2` FROM `Follower` WHERE `USER_ID1` = ?;"))
		{
			$stmt->bind_param('i', $currentUser);
			$stmt->execute();
			$stmt->store_result();
			$dataid2 = array();
			
			$stmt->bind_result($id2);

			while ($stmt->fetch())
			{
				array_push($dataid2,array("id2"=>$id2));
			}

			foreach($dataid1 as &$user) {
				foreach($dataid2 as &$user2) {
					if($user['id1'] == $user2['id2']) {
						array_push($resultarray,array("id"=>$user['id1'], "username"=>$user['username']));	
						
					}
				}
			}
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

	return $resultarray;
}

?>

