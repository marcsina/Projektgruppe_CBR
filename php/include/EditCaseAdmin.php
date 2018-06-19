<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

include_once 'conn.php';
include_once 'conf.php';

function updateCaseToDB($connection)
{
	if (isset($_POST['caseID'], $_POST['id'], $_POST['value'])) 
	{
		
		$caseID = filter_input(INPUT_POST, 'caseID');
		$id = json_decode($_POST['id']);
		$value = json_decode($_POST['value']);
		for($i = 0, $groesse = count($id); $i < $groesse; $i++)
	    {
			$n1 = $value[$i];
			$n2 = $id[$i];
			$sql = "UPDATE Cases_Kategorie_Values SET value = ('$n1') WHERE caseid = ('$caseID') AND kategorieid = ('$n2') ;";

			if(mysqli_query($connection, $sql))
			{
				echo "Hat funktioniert";
			}
			else	
			{
				echo "SQL Befehl fehlerhaft";
			}
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