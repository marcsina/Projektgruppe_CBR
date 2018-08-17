<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");

include_once 'conn.php';
include_once 'conf.php';

function addCaseToDB($connection)
{
if (isset($_POST['caseName'], $_POST['name'], $_POST['id'], $_POST['value']))
{

	$caseName = filter_input(INPUT_POST, 'caseName');
	$name = json_decode($_POST['name']);
	$id = json_decode($_POST['id']);
	$value = json_decode($_POST['value']);

	$sql = "INSERT INTO Cases (name) VALUES ('$caseName');";


	if (mysqli_query($connection,$sql))
    {
	    echo "Case erfolgreich der Datenbank hinzugefügt";
        $sql = "SELECT id from Cases WHERE name = '$caseName' LIMIT 1";
        $result = mysqli_query($connection,$sql);

		while($row = $result->fetch_assoc())
		{
			$caseid = (int)$row["id"];
			echo $caseid;
		}
        for($i = 0, $groesse = count($id); $i < $groesse; $i++)
	    {
            $numero1 = $id[$i];
            $numero2 = $value[$i];
            $numero2 = $numero2/100;

            $sql = "INSERT INTO Cases_Kategorie_Values (caseid,kategorieid,value, wij) VALUES('$caseid', '$numero1', '$numero2', '0');";
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

addCaseToDB($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}



function debug_to_console( $data )
{
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "
<script>console.log('Debug Objects: " . $output . "');</script>";
}

?>