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
    $sqlStmt = "SELECT * FROM CBR_ICF_Kategorie ORDER BY id;";

        $result =  mysqli_query($connection,$sqlStmt);
        $data = array();
        if ($result = $connection->query($sqlStmt))
        {
            while ($row = $result->fetch_assoc())
            {
                $id = $row["id"];
                $DE = $row["DE"];

                array_push($data,array("ID"=> $id,"DE"=>$DE));
            }

            // Objekt freigeben
            $result->free();
        }


        // Ausgabe
        foreach ($data as $d)
        {
            $id = $d["ID"];
            $DE = $d["DE"];

            echo utf8_decode("$id,$DE");
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