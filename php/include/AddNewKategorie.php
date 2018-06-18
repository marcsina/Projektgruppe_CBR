<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

include_once 'conn.php';
include_once 'conf.php';

function addCategoryToDB($connection)
{
if (isset($_POST['katName'], $_POST['keywords'])) 
{
	
	$katName = filter_input(INPUT_POST, 'katName');
	$keywords = json_decode($_POST['keywords']);

	$sql = "INSERT INTO CBR_ICF_Kategorie (DE) VALUES ('$katName');";


	if (mysqli_query($connection,$sql)) 
    {
	    echo "Kategorie erfolgreich der Datenbank hinzugefügt";
        $sql = "SELECT id from CBR_ICF_Kategorie WHERE DE = '$katName' LIMIT 1";
        $result = mysqli_query($connection,$sql);
		
		while($row = $result->fetch_assoc()) 
		{
			$katid = (int)$row["id"];
			echo $katid;
		}
        for($i = 0, $groesse = count($keywords); $i < $groesse; $i++)
	    {
            $numero1 = $keywords[$i];

            $sql = "INSERT INTO CBR_Keyword_DE (name,ICFkat) VALUES('$numero1','$katid');";
            if (mysqli_query($connection,$sql)) 
            {			
                echo "Kein Problem beim Hinzufügen der Werte";
            }
            else 
            {
                echo "Hinzufügen von Werten gab einen Fehler";
            }
	    }
    }
	
	else 
	{
		echo "Irgendwie 'n error beim hinzufügen der DB";
	}
}else 
{
	echo "Fehlerhafte Eingabe";
}
closeConnection($connection);
}

addCategoryToDB($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}

?>