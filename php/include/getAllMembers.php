<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getAllMembers($mysqli)
{
	$sqlStmt = "SELECT id, username FROM members;";
    $result = mysqli_query($mysqli,$sqlStmt);
	$data = array();
    if ($result = $mysqli->query($sqlStmt))
    {
        while ($row = $result->fetch_assoc())
        {
			$id= $row["id"];
			$username = $row["username"];

			array_push($data,array("id"=>$id, "username"=>$username)); 
        }
        // Objekt freigeben
        $result->free();
    }
	return $data;
}

?>