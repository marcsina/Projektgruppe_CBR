<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

include_once 'conn.php';
include_once 'conf.php';

function editCaseToDB($connection)
{
	if (isset($_POST['symptomname'], $_POST['ICFid'])) 
	{
		
		$name = json_decode($_POST['symptomname']);
		$ICFid = filter_input(INPUT_POST, 'ICFid');
		echo "Hallo";
		$sql = "DELETE FROM `CBR_Keyword_DE` WHERE ICFkat = $ICFid";

		if(mysqli_query($connection,$sql))
		{
			echo "Geloescht";
			for($i = 0, $groesse = count($name); $i < $groesse; $i++)
			{
				$n1 = $name[$i];
				echo "$n1";
				$sql = "INSERT INTO `CBR_Keyword_DE`(`name`, `ICFkat`) VALUES ('$n1',$ICFid)";

				if(mysqli_query($connection, $sql))
				{
					echo "Hat funktioniert";
				}
				else	
				{
					echo "SQL Befehl fehlerhaft";
				}
			}
			
		}else	
		{
			echo "SQL Befehl fehlerhaft";
		}
	}
	else	
	{
		echo "SQL Befehl fehlerhaft";
	}

	closeConnection($connection);
}

editCaseToDB($mysqli);

//Verbindung schliessen.
function closeConnection($connection)
{
  mysqli_close($connection);
}

?>