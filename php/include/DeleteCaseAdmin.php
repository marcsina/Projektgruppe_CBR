<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

include_once 'conn.php';
include_once 'conf.php';

function updateCaseToDB($connection)
{
	if (isset($_POST['CaseID'])) 
	{
		
		$caseID = filter_input(INPUT_POST, 'CaseID');
		
		$sql ="DELETE FROM Cases WHERE id =('$caseID')";

		if(mysqli_query($connection, $sql))
		{
			echo "Case gelöscht";
		}
		else	
		{
			echo "SQL Befehl 1 fehlerhaft";
		}
		$sql = "DELETE FROM Cases_Kategorie_Values WHERE caseid =('$caseID')";

		if(mysqli_query($connection, $sql))
		{
			echo "Values gelöscht";
		}
		else	
		{
			echo "SQL Befehl 2 fehlerhaft";
		}
		
	}
	else
	{
		echo "Felder nicht gesetzt";
	}

	closeConnection($connection);
}

updateCaseToDB($mysqli);

//Verbindung schliessen.
function closeConnection($connection)
{
  mysqli_close($connection);
}

?>