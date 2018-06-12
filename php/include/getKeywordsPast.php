<?php
header('Content-Type: text/html; charset=ISO-8859-1');
header("Access-Control-Allow-Origin: *");
//Verbindung aufbauen
include_once('conn.php');

function getMain($connection)
{
    getKeywordsCBR($connection);
}



function getKeywordsCBR($connection)
{
    $sqlStmt = "SELECT Word FROM Cases_Past;";

        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                //$id = $row["id"];
                $word = $row["Word"];



                array_push($data,array("Word"=> $word));
		//array_push($data,array("name"=>$name,"katid"=>$katid));
            }

            // Objekt freigeben
            $result->free();
        }


        // Ausgabe
        foreach ($data as $d)
        {
            //$id = $d["ID"];
            $word = $d["Word"];


            echo utf8_decode("$word");
            echo ";";
        }

		closeConnection($connection);


}

getKeywordsCBR($mysqli);

//Verbindung schliessen.
function closeConnection($connection){
  mysqli_close($connection);
}
?>