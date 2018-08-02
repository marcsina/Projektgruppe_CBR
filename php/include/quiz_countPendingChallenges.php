<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');



function getNumberPendingChallenges($mysqli, $userid)
{
	$numberChallenges = 0;
	

    $sqlStmt = "SELECT COUNT(User_ID_2) AS Challenges FROM PENDING_CHALLENGE WHERE User_ID_2 = $userid;";
    $result = mysqli_query($mysqli,$sqlStmt);
    if ($result = $mysqli->query($sqlStmt))
    {
        while ($row = $result->fetch_assoc())
        {
            $numberChallenges = $row["Challenges"];
        }
        // Objekt freigeben
        $result->free();
		return $numberChallenges;
    }
}
?>