<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getMain($connection)
{
    getCategories($connection);
}



function getCategories($connection)
{
    $sqlStmt = "SELECT * FROM Cases ORDER BY id;";

        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                $id = $row["id"];
                $name = $row["name"];
				$text = $row["text"];

                array_push($data,array("ID"=> $id,"name"=>$name));
            }

            // Objekt freigeben
            $result->free();
        }


        // Ausgabe
        foreach ($data as $d)
        {
            $id = $d["ID"];
            $name = $d["name"];

            echo utf8_decode("$id,$name");
            echo ";";
        }

		closeConnection($connection);


}

getCategories($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>